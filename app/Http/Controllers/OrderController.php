<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Branch;
use Illuminate\Http\Request;
use FPDF;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersBranchId = auth()->user()->branch_id;

        // Only display the orders made within the same branch as the users
        $orders = Order::where('branch_id', $usersBranchId)->get();
        $page_title = 'Orders';
        return view('order.index', compact('orders', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the user's assigned branch by its ID
        $usersBranchId = auth()->user()->branch_id;
        $branches = Branch::where('id', $usersBranchId)->get();

        $order_no = $this->uniqueOrderNo();
        $page_title = 'New Order';
        $categories = Category::all();
        return view('order.create', compact('order_no', 'page_title', 'branches', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usersBranchId = auth()->user()->branch_id;

        // Validate request to make sure the fields are provided in correct data type
        $request->validate([
            'order_no' => 'required',
            'branch_id' => 'required|exists:branches,id|in:' . $usersBranchId,
            'paid_amount' => 'required|numeric',
            'total_amount' => 'required',
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'order_quantity' => 'required',
            'unit_price' => 'required',
        ]);

        // Forms a delivery date two weeks after the order was made
        $delivery_date = now()->addWeeks(2)->format('Y-m-d');

        // Create new order
        $order = Order::create([
            'order_no' => $request->order_no,
            'branch_id' => $usersBranchId,
            'paid_amount' => $request->paid_amount,
            'total_amount' => $request->total_amount,
            'delivery_date' => $delivery_date,
        ]);

        // Create order details
        for ($i = 0; $i < count($request->category_id); $i++) {

            OrderDetails::create([
                'order_id' => $order->id,
                'category_id' => $request->category_id[$i],
                'product_id' => $request->product_id[$i],
                'order_quantity' => $request->order_quantity[$i],
                'unit_price' => $request->unit_price[$i]
            ]);
        }

        // Redirect to order homepage
        return redirect()->route('order.index')->with('success', "Order '{$order->order_no}' successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Displays order details
        $order = Order::findOrFail($id);
        $page_title = 'View Order';
        return view('order.show', compact('order', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Users can only modify the orders within the same branch as them
        $usersBranchId = auth()->user()->branch_id;
        $branches = Branch::where('id', $usersBranchId)->get();

        // Find order by ID or throw error if not found
        $order = Order::findOrFail($id);
        $page_title = 'Edit Order';
        $categories = Category::all();
        $products = Product::all();

        return view('order.edit', compact('order', 'page_title', 'branches', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usersBranchId = auth()->user()->branch_id;

        $order = Order::findOrFail($id);
        $request->validate([
            'order_no' => 'required',
            'branch_id' => 'required|exists:branches,id|in:' . $usersBranchId,
            'paid_amount' => 'required|numeric',
            'total_amount' => 'required',
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'order_quantity' => 'required',
            'unit_price' => 'required',
        ]);

        // Update changes made to the order with validated input
        $order->update([
            'order_no' => $request->order_no,
            'branch_id' => $request->branch_id,
            'paid_amount' => $request->paid_amount,
            'total_amount' => $request->total_amount,
        ]);

        // Delete old order detail before updating
        foreach ($order->orderDetails as $item) {
            $item->delete();
        }
        for ($i = 0; $i < count($request->category_id); $i++) {

            OrderDetails::create([
                'order_id' => $order->id,
                'category_id' => $request->category_id[$i],
                'product_id' => $request->product_id[$i],
                'order_quantity' => $request->order_quantity[$i],
                'unit_price' => $request->unit_price[$i]
            ]);
        }

        // Redirect to order homepage
        return redirect()->route('order.index')->with('success', "Order '{$order->order_no}' successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete order using its ID
        $order = Order::findOrFail($id);
        foreach ($order->orderDetails as $item) {
            $item->delete();
        }

        // Delete order from database
        $order->delete();

        // Redirect to previous page
        return back()->with('success', "Order '{$order->order_no}' successfully deleted.");
    }

    public function uniqueOrderNo()
    {
        // Generate unique order number
        $order = Order::latest()->first();
        if ($order) {
            $name = $order->order_no;
            $number = explode('_', $name);
            $order_no = 'ORD_' . str_pad((int)$number[1] + 1, 3, "0", STR_PAD_LEFT);
        } else {
            $order_no = 'ORD_001';
        }
        return $order_no;
    }

    // Displays product associated with the selected category
    public function getProduct($id)
    {
        $products = Product::where('category_id', $id)->get();
        return response()->json($products);
    }
    public function generateInvoice($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);
        $user = auth()->user(); // Get the logged-in user

        $pdf = new FPDF();
        $pdf->AddPage();

        

        // Company details (on the left)
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Candy Atlas Corporation', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Candy Atlas Sheffield', 0, 1, 'L');
        $pdf->Cell(0, 10, '5 Park Lane ', 0, 1, 'L');
        $pdf->Cell(0, 10, ' S2 1OP', 0, 1, 'L');

        // User's name (added below the address for a more professional look)
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Employee: ' . $user->name, 0, 1, 'L');

        // Invoice title
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $pdf->Ln(10);

        // Invoice details (Order Number, Paid Amount, Expected Delivery)
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, 'Order Number:', 1, 0);
        $pdf->Cell(60, 10, $order->order_no, 1, 1);

        $pdf->Cell(60, 10, 'Paid Amount:', 1, 0);
        $pdf->Cell(60, 10, '£' . number_format($order->paid_amount, 2), 1, 1);

        $pdf->Cell(60, 10, 'Expected Delivery:', 1, 0);
        $pdf->Cell(60, 10, \DateTime::createFromFormat('Y-m-d', $order->delivery_date)->format('d F Y'), 1, 1);

        // Table for ordered items
        if ($order->orderDetails && $order->orderDetails->isNotEmpty()) {
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'Product', 1, 0);
            $pdf->Cell(40, 10, 'Quantity', 1, 0);
            $pdf->Cell(40, 10, 'Unit Price', 1, 0);
            $pdf->Cell(40, 10, 'Total', 1, 1);

            $pdf->SetFont('Arial', '', 12);
            foreach ($order->orderDetails as $orderDetail) {
                $productName = $orderDetail->product ? $orderDetail->product->name : 'N/A';
                $pdf->Cell(40, 10, $productName, 1, 0);
                $pdf->Cell(40, 10, $orderDetail->order_quantity, 1, 0);
                $pdf->Cell(40, 10, '£' . number_format($orderDetail->unit_price, 2), 1, 0);
                $pdf->Cell(40, 10, '£' . number_format($orderDetail->order_quantity * $orderDetail->unit_price, 2), 1, 1);
            }
        } else {
            $pdf->Cell(0, 10, 'No items found for this order.', 0, 1, 'C');
        }

        $pdf->Ln(10);

        // Footer
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'For any inquiries, contact us at: contact@candyatlas.com', 0, 1, 'C');

        $pdf->Output();
        exit;
    }
}

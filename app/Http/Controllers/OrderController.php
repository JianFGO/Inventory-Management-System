<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Branch;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $page_title = 'All Orders';
        return view('order.index', compact('orders', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order_no = $this->uniqueOrderNo();
        $page_title = 'New Order';
        $branches = Branch::all();
        $categories = Category::all();
        return view('order.create', compact('order_no', 'page_title', 'branches', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request to make sure the fields are provided in correct data type
        $request->validate([
            'order_no' => 'required',
            'branch_id' => 'required',
            'paid_amount' => 'required',
            'total_amount' => 'required',
            'category_id' => 'required',
            'product_id' => 'required',
            'order_quantity' => 'required',
            'unit_price' => 'required',
        ]);

        // Forms a delivery date two weeks after the order was made
        $delivery_date = now()->addWeeks(2)->format('Y-m-d');

        // Create new order
        $order = Order::create([
            'order_no' => $request->order_no,
            'branch_id' => $request->branch_id,
            'paid_amount' => $request->paid_amount,
            'total_amount' => $request->total_amount,
            'delivery_date' => $delivery_date,
        ]);

        //Create order details
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
        return redirect()->route('order.index')->with('success', 'Order successfully created.');
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
        // Find order by ID or throw error if not found
        $order = Order::findOrFail($id);

        $page_title = 'Edit Order';
        $branches = Branch::all();
        $categories = Category::all();
        $products = Product::all();
        return view('order.edit', compact('order', 'page_title', 'branches', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'order_no' => 'required',
            'branch_id' => 'required',
            'paid_amount' => 'required',
            'total_amount' => 'required',
            'category_id' => 'required',
            'product_id' => 'required',
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
        return redirect()->route('order.index')->with('success', 'Order successfully updated.');
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
        return back()->with('success', 'Order successfully deleted.');
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

    // Displays product assoicated with the selected category
    public function getProduct($id)
    {
        $products = Product::where('category_id', $id)->get();
        return response()->json($products);
    }
}

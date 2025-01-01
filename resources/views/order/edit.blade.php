@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Edit Order');

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h1 class="form-heading">{{ $page_title }}</h1>
                    </div>

                    {{-- Form for updating order --}}
                    <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                    {{-- Display an error message if 'category_id' field is invalid --}}
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    {{-- Display an error message if 'product_id' field is invalid --}}
                                    @error('product_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    {{-- Display Order Number --}}
                                    <div class="form-group">
                                        <label for="order_no">Order No</label>
                                        <input type="text" name="order_no" id="order_no" class="form-control"
                                            value="{{ $order->order_no }}" readonly>
                                    </div>
                                </div>

                                {{-- Edit Branch --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id">Branch</label>
                                        <select class="form-control" name="branch_id" id="branch_id">
                                            @foreach ($branches as $branch)
                                                @if ($branch->id == $order->branch_id)
                                                    <option selected value="{{ $branch->id }}">{{ $branch->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        {{-- Display an error message if 'branch_id' field is invalid --}}
                                        @error('branch_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Edit Paid Amount --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paid_amount">Paid Amount</label>
                                        <input type="text" name="paid_amount" id="paid_amount" class="form-control"
                                            value="{{ $order->paid_amount }}">
                                    </div>
                                </div>

                                {{-- Edit products --}}
                                <div class="col-12">
                                    <table class="table table-responsive table-striped">

                                        {{-- Table headers --}}
                                        <thead>
                                            <th id="category-header" class="text-center">Category</th>
                                            <th id="product-header" class="text-center">Product</th>
                                            <th id="quantity-header" class="text-center">Quantity</th>
                                            <th id="unit-price-header" class="text-center">Unit Price</th>
                                            <th id="total-price-header" class="text-center">Total Price</th>
                                            <th aria-label="Add Product Row" class="text-center">

                                                {{-- Add product button --}}
                                                <button onclick="addProduct()" type="button" class="btn btn-success"
                                                    aria-label="Add Product Row"><i class="fas fa-plus"></i></button>
                                            </th>
                                        </thead>
                                        <tbody class="tbody">
                                            @foreach ($order->orderDetails as $item)
                                                <tr class="tr">

                                                    {{-- Edit category selection --}}
                                                    <td>
                                                        <select class="form-control category table-input"
                                                            aria-labelledby="category-header" name="category_id[]"
                                                            id="category_1">
                                                            @foreach ($categories as $category)
                                                                @if ($item->category_id == $category->id)
                                                                    <option selected value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @else
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    {{-- Edit product selection --}}
                                                    <td>
                                                        <select class="form-control product table-input"
                                                            aria-labelledby="product-header" name="product_id[]"
                                                            id="product_1">
                                                            @foreach ($products as $product)
                                                                @if ($item->product_id == $product->id)
                                                                    <option selected value="{{ $product->id }}">
                                                                        {{ $product->name }}</option>
                                                                @else
                                                                    <option value="{{ $product->id }}">
                                                                        {{ $product->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    {{-- Edit order quantity --}}
                                                    <td><input class="form-control table-input"
                                                            aria-labelledby="quantity-header" type="text"
                                                            name="order_quantity[]" id="quantity_1"
                                                            placeholder="Enter Quantity" onkeyup="calculateTotal(event)"
                                                            value="{{ $item->order_quantity }}"></td>

                                                    {{-- Edit unit price --}}
                                                    <td><input class="form-control table-input"
                                                            aria-labelledby="unit-price-header" type="text"
                                                            name="unit_price[]" id="price_1"
                                                            placeholder="Enter Unit Price" onkeyup="calculateTotal(event)"
                                                            value="{{ $item->unit_price }}"></td>

                                                    {{-- Displays Total price of selected product --}}
                                                    <td><input class="form-control total table-input"
                                                            aria-labelledby="total-price-header" type="text"
                                                            id="total_1" placeholder="Total Price"
                                                            value="{{ $item->order_quantity * $item->unit_price }}"
                                                            disabled></td>

                                                    {{-- Remove product button --}}
                                                    <td><button type="button" onclick="removeProduct(event)"
                                                            class="btn btn-danger" aria-label="Remove Product Row"><i
                                                                class="fas fa-minus"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                            {{-- Total price of the order --}}
                                            <th colspan="4" id="total-price">Total</th>
                                            <th aria-label="Total Price"><input class="form-control"
                                                    aria-labelledby="total-price-header" type="text"
                                                    name="total_amount" id="total" placeholder="Item(s) Total"
                                                    value="{{ $order->total_amount }}" readonly></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            {{-- Submit button for form --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // CSRF token protection
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add product to order
        let count = 2;

        function addProduct() {
            const tr = `
        <tr class="tr">
            <td>
                <select class="form-control category" aria-labelledby="category-header" name="category_id[]" id="category_${count}">
                    <option selected>Select Category</option>
                    @foreach ($categories as $category)
                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control" aria-labelledby="product-header" name="product_id[]" id="product_${count}">
                    <option selected>Select Product</option>
                </select>
            </td>
            <td><input class="form-control" aria-labelledby="quantity-header" type="text" name="order_quantity[]" id="quantity_${count}" placeholder="Enter Quantity" onkeyup="calculateTotal(event)" ></td>
            <td><input class="form-control" aria-labelledby="unit-price-header" type="text" name="unit_price[]" id="price_${count}" placeholder="Enter Unit Price" onkeyup="calculateTotal(event)"></td>
            <td><input class="form-control total" aria-labelledby="total-price-header" type="text" id="total_${count}" placeholder="Total Price" disabled></td>
            <td><button type="button" aria-label="Remove Product Row" onclick="removeProduct(event)" class="btn btn-danger"><i class="fas fa-minus"></i></button></td>
            </tr>
        `;
            $('.tbody').append(tr);
            count++;
        }
        // Remove a product
        function removeProduct(event) {
            let totalAmount = 0;
            if ($('.tr').length > 1) {
                $(event.target).closest('.tr').remove();

                // Calculates the sum of all products
                $('.total').each(function() {
                    const value = parseFloat($(this).val());
                    if ($(this).val() != '') {
                        totalAmount += value;
                    }
                })
                $('#total').val(totalAmount);
            }
        }

        function calculateTotal(event) {
            // Calculate total price for one product
            let totalAmount = 0;

            const id = $(event.target).attr('id');
            const num = id.split('_');
            const quantity = parseFloat($('#quantity_' + num[1]).val());
            const price = parseFloat($('#price_' + num[1]).val());
            const total = quantity * price;
            $('#total_' + num[1]).val(total);

            // Calculate the sum of all products
            $('.total').each(function() {
                const value = parseFloat($(this).val());
                if ($(this).val() != '') {
                    totalAmount += value;
                }
            })
            $('#total').val(totalAmount);
        }

        // Functionality to display products assoicated with the selected category
        $(document).on('change', '.category', function() {
            const id = $(this).val();
            const dataId = $(this).attr('id');
            const num = dataId.split('_');

            // AJAX request to get products
            $.ajax({
                type: "get",
                url: "{{ route('product.get', '') }}" + "/" + id,
                dataType: "json",
                success: function(data) {
                    let html = '<option selected>Select Product</option>';
                    data.forEach(product => {
                        html += `<option value="${product.id}">${product.name}</option>`;
                    });

                    // Log HTML in console
                    console.log(html);

                    // Update product dropdown
                    $('#product_' + num[1]).html(html);
                }
            });
        })
    </script>
@endsection

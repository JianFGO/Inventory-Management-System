@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'New Order')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h1 class="form-heading">{{ $page_title }}</h1>
                    </div>

                    {{-- Form for creating new order --}}
                    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    {{-- Generate Order Number --}}
                                    <div class="form-group">
                                        <label for="order_no">Order No</label>
                                        <input type="text" name="order_no" id="order_no" class="form-control" readonly
                                            value="{{ $order_no }}">
                                    </div>

                                    {{-- Display an error message if 'order no' field is empty --}}
                                    @error('order_no')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    {{-- Branch Selection --}}
                                    <div class="form-group">
                                        <label for="branch_id">Branch</label>
                                        <select class="form-control" name="branch_id" id="branch_id">
                                            <option selected>Select Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Display an error message if 'branch' field is empty --}}
                                    @error('branch_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    {{-- Display Paid Amount --}}
                                    <div class="form-group">
                                        <label for="paid_amount">Paid Amount</label>
                                        <input type="text" name="paid_amount" id="paid_amount" class="form-control">
                                    </div>

                                    {{-- Display an error message if 'paid amount' field is invalid --}}
                                    @error('paid_amount')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Table to add products to order --}}
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
                                            <tr class="tr">

                                                {{-- Category Selection --}}
                                                <td>
                                                    <select class="form-control category" aria-labelledby="category-header"
                                                        name="category_id[]" id="category_1">
                                                        <option selected>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                {{-- Product Selection --}}
                                                <td>
                                                    <select class="form-control" aria-labelledby="product-header"
                                                        name="product_id[]" id="product_1">
                                                        <option selected>Select Product</option>
                                                    </select>
                                                </td>

                                                {{-- Input for order quantity --}}
                                                <td><input class="form-control" aria-labelledby="quantity-header"
                                                        type="text" name="order_quantity[]" id="quantity_1"
                                                        placeholder="Enter Quantity" onkeyup="calculateTotal(event)"></td>

                                                {{-- Input for unit price --}}
                                                <td><input class="form-control" aria-labelledby="unit-price-header"
                                                        type="text" name="unit_price[]" id="price_1"
                                                        placeholder="Enter Unit Price" onkeyup="calculateTotal(event)"></td>

                                                {{-- Displays total price of selected product --}}
                                                <td><input class="form-control total" aria-labelledby="total-price-header"
                                                        type="text" id="total_1" placeholder="Total Price" disabled>
                                                </td>

                                                {{-- Remove product button --}}
                                                <td><button type="button" onclick="removeProduct(event)"
                                                        class="btn btn-danger" aria-label="Remove Product Row"><i
                                                            class="fas fa-minus"></i></button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            {{-- Total price of the order --}}
                                            <th colspan="4" id="total-price">Total</th>
                                            <th aria-label="Total Price"><input class="form-control"
                                                    aria-labelledby="total-price-header" type="text" name="total_amount"
                                                    id="total" placeholder="Item(s) Total" readonly>
                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            {{-- Submit button for form --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

        // Remove a product from the order
        function removeProduct(event) {
            if ($('.tr').length > 1) {
                $(event.target).closest('.tr').remove();
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

        // Functionality to display products associated with the selected category
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

@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Order Details')

@section('content')
    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h1 class="form-heading">{{ $page_title }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            {{-- View Order Number --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order_no">Order No</label>
                                    <input type="text" name="order_no" id="order_no" class="form-control"
                                        value="{{ $order->order_no }}" disabled>
                                </div>
                            </div>

                            {{-- View Branch --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="branch_id">Branch</label>
                                    <input type="text" name="branch_id" id="branch_id" class="form-control"
                                        value="{{ $order->branch->name }}" disabled>
                                </div>
                            </div>

                            {{-- View Paid Amount --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paid_amount">Paid Amount (£)</label>
                                    <input type="text" name="paid_amount" id="paid_amount" class="form-control"
                                        value="{{ $order->paid_amount }}">
                                </div>
                            </div>

                            {{-- View the products included in the order --}}
                            <div class="col-12">
                                <table class="table table-responsive table-striped">
                                    {{-- Table headers --}}
                                    <thead>
                                        <th id="category-header" class="text-center">Category</th>
                                        <th id="product-header" class="text-center">Product</th>
                                        <th id="quantity-header" class="text-center">Quantity (pieces)</th>
                                        <th id="unit-price-header" class="text-center">Unit Price (£)</th>
                                        <th id="total-price-header" class="text-center">Total Price (£)</th>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach ($order->orderDetails as $item)
                                            <tr class="tr">

                                                {{-- View Category --}}
                                                <td>
                                                    <input type="text" aria-labelledby="category-header" id="category_id"
                                                        class="form-control table-input" value="{{ $item->category->name }}"
                                                        disabled>
                                                </td>

                                                {{-- View Product --}}
                                                <td>
                                                    <input type="text" aria-labelledby="product-header" id="product"
                                                        class="form-control table-input" value="{{ $item->product->name }}"
                                                        disabled>
                                                </td>

                                                {{-- View Order Quantity --}}
                                                <td><input type="text" aria-labelledby="quantity-header" id="quantity"
                                                        class="form-control table-input" value="{{ $item->order_quantity }}"
                                                        disabled>
                                                </td>

                                                {{-- View Unit Price --}}
                                                <td><input type="text" aria-labelledby="unit-price-header"
                                                        id="unit_price" class="form-control table-input"
                                                        value="{{ $item->unit_price }}" disabled></td>

                                                {{-- View the Total Price for product --}}
                                                <td><input type="text" aria-labelledby="total-price-header"
                                                        id="total_price" class="form-control table-input"
                                                        value="{{ $item->unit_price * $item->order_quantity }}" disabled>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        {{-- View Total Price for the order  --}}
                                        <th colspan="4">Total</th>
                                        <th aria-label="Total Price"><input class="form-control"
                                                aria-labelledby="total-price-header" type="text" name="total_amount"
                                                id="total" placeholder="Item(s) Total"
                                                value="{{ $order->total_amount }}" disabled>
                                        </th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

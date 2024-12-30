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
                        <h4>{{ $page_title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            {{-- View Order Number --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Order No</label>
                                    <input type="text" name="order_no" id="order_no" class="form-control"
                                        value="{{ $order->order_no }}" disabled>
                                </div>
                            </div>

                            {{-- View Branch --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Branch</label>
                                    <input type="text" name="order_no" id="order_no" class="form-control"
                                        value="{{ $order->branch->name }}" disabled>
                                </div>
                            </div>

                            {{-- View Paid Amount --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Paid Amount</label>
                                    <input type="text" name="paid_amount" id="paid_amount" class="form-control"
                                        value="{{ $order->paid_amount }}">
                                </div>
                            </div>

                            {{-- View the products included in the order --}}
                            <div class="col-12">
                                <table class="table table-responsive table-striped">
                                    {{-- Table headers --}}
                                    <thead>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Total Price</th>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach ($order->orderDetails as $item)
                                            <tr class="tr">

                                                {{-- View Category --}}
                                                <td>
                                                    <input type="text" id="order_no" class="form-control"
                                                        value="{{ $item->category->name }}" disabled>
                                                </td>

                                                {{-- View Product --}}
                                                <td>
                                                    <input type="text" id="order_no" class="form-control"
                                                        value="{{ $item->product->name }}" disabled>
                                                </td>

                                                {{-- View Order Quantity --}}
                                                <td><input type="text" id="order_no" class="form-control"
                                                        value="{{ $item->order_quantity }}" disabled></td>

                                                {{-- View Unit Price --}}
                                                <td><input type="text" id="order_no" class="form-control"
                                                        value="{{ $item->unit_price }}" disabled></td>

                                                {{-- View the Total Price for product --}}
                                                <td><input type="text" id="order_no" class="form-control"
                                                        value="{{ $item->unit_price * $item->order_quantity }}" disabled>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        {{-- View Total Price for the order  --}}
                                        <th colspan="4">Total</th>
                                        <th><input class="form-control" type="text" name="total_amount" id="total"
                                                placeholder="Item(s) Total" value="{{ $order->total_amount }}" disabled>
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

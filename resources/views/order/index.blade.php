@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'Order')

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
                        {{-- All Orders table --}}
                        <div class="table-responsive">
                            <table id="categoryTable" class="table table-striped">
                                {{-- Table headers --}}
                                <thead>
                                    <th>Order Code</th>
                                    <th>Order No</th>
                                    <th>Paid Amount</th>
                                    <th>Expected Delivery</th>
                                    <th>Action</th>
                                </thead>
                                {{-- Table content --}}
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td> {{-- Order ID --}}
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ \DateTime::createFromFormat('Y-m-d', $order->delivery_date)->format('d F Y') }}
                                            </td>
                                            <td>
                                                {{-- Edit button --}}
                                                <a class="btn btn-primary"
                                                    href="{{ route('order.edit', $order->id) }}">Edit</a>
                                                {{-- Delete button --}}
                                                <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                    data-target="#orderModal" id="{{ $order->id }}">
                                                    Delete
                                                </button>
                                                {{-- View Order Details button --}}
                                                <a class="btn btn-success" href="{{ route('order.show', $order->id) }}">View
                                                    Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: A type of pop-up box - for confirming deletion --}}
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">

                {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="orderModalLabel">Confirm Deletion</h1>
                    </div>
                    <div class="modal-body">
                        <p>This action will delete the order. Are you sure you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Enables pagination & search --}}
@section('scripts')
    <script>
        // For datatable plugin
        document.addEventListener('DOMContentLoaded', function() {
            let table = new DataTable('#categoryTable');

            // For deleting the order
            $('.delete').on('click', function() {

                // ID of the order user wants to delete
                const id = this.id;

                // Dynamic URL
                $('#deleteModal').attr('action', '{{ route('order.destroy', '') }}' + '/' + id);
            });
        });
    </script>
@endsection

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
                        <h1 class="form-heading">{{ $page_title }}</h1>
                    </div>
                    <div class="card-body">

                        {{-- All Orders table --}}
                        <div class="table-responsive">
                            <table id="orderTable" class="table table-striped">

                                {{-- Table headers --}}
                                <thead>
                                    <th>Order ID</th>
                                    <th>Order No</th>
                                    <th>Paid Amount (£)</th>
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
                                                <a class="btn btn-primary" href="{{ route('order.edit', $order->id) }}"><i
                                                        class="fas fa-edit"></i>Edit</a>

                                                {{-- Delete button --}}
                                                <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                    data-target="#orderModal" id="{{ $order->id }}"><i
                                                        class="fas fa-trash-alt"></i>
                                                    Delete
                                                </button>

                                                {{-- View Order Details button --}}
                                                <a class="btn btn-success" href="{{ route('order.show', $order->id) }}"><i
                                                        class="fas fa-eye"></i>View
                                                    Details</a>

                                                {{-- Generate Invoice button --}}
                                                <a class="btn btn-warning" href="{{ route('order.invoice', $order->id) }}"
                                                    target="_blank">
                                                    <i class="fas fa-file-invoice"></i>Invoice
                                                </a>

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
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i
                                class="fas fa-times"></i>Close</button>
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

            // Reinitialise event listeners for delete buttons
            function reinitialiseDeleteButtons() {
                $('.delete').off('click').on('click', function() {

                    // ID of the order user wants to delete
                    const id = this.id;

                    // Dynamic URL
                    $('#deleteModal').attr('action', '{{ route('order.destroy', '') }}' + '/' + id);
                });
            }

            reinitialiseDeleteButtons();

            table.on('draw', function() {
                reinitialiseDeleteButtons();
            });
        });
    </script>
@endsection

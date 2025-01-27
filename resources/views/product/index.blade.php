@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'Product')

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

                        {{-- Product table --}}
                        <div class="table-responsive">
                            <table id="productTable" class="table table-striped">

                                {{-- Table headers --}}
                                <thead>
                                    <th>Product ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price (£)</th>
                                    <th>Quantity (pieces)</th>
                                    <th>Action</th>
                                </thead>

                                {{-- Table content --}}
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td> {{-- ID --}}
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                @role('Admin|Manager')
                                                    {{-- Edit button --}}
                                                    <a class="btn btn-primary"
                                                        href="{{ route('product.edit', $product->id) }}"><i
                                                            class="fas fa-edit"></i>Edit</a>

                                                    {{-- Delete button --}}
                                                    <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                        data-target="#productModal" id="{{ $product->id }}"><i
                                                            class="fas fa-trash-alt"></i>
                                                        Delete
                                                    </button>
                                                @endrole
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
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">

                {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="productModalLabel">Confirm Deletion</h1>
                    </div>
                    <div class="modal-body">
                        <p>This action will delete the product. Are you sure you want to proceed?</p>
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
            let table = new DataTable('#productTable');

            // Reinitialise event listeners for delete buttons
            function reinitialiseDeleteButtons() {
                $('.delete').off('click').on('click', function() {

                    // ID of the product user wants to delete
                    const id = this.id;

                    // Dynamic URL
                    $('#deleteModal').attr('action', '{{ route('product.destroy', '') }}' + '/' + id);
                });
            }

            reinitialiseDeleteButtons();

            table.on('draw', function() {
                reinitialiseDeleteButtons();
            });
        });
    </script>
@endsection

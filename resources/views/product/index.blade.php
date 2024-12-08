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
                        <h4>{{ $page_title }}</h4>
                    </div>
                    <div class="card-body">

                        {{-- Product table --}}
                        <table id="productTable" class="table table-striped">

                            {{-- Table headers --}}
                            <thead>
                                <th>Product Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
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

                                            {{-- Edit button --}}
                                            <a class="btn btn-primary"
                                                href="{{ route('product.edit', $product->id) }}">Edit</a>

                                            {{-- Delete button --}}
                                            <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                data-target="#productModal" id="{{ $product->id }}">
                                                Delete
                                            </button>
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
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
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

            // For deleting the product
            $('.delete').on('click', function() {

                // ID of the product user wants to delete
                const id = this.id;

                // Dynamic URL
                $('#deleteModal').attr('action', '{{ route('product.destroy', '') }}' + '/' + id);
            });
        });
    </script>
@endsection

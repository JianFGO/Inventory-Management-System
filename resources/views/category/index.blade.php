@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'Category')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h4 class="form-heading">{{ $page_title }}</h4>
                    </div>
                    <div class="card-body">

                        {{-- Categories table --}}
                        <div class="table-responsive">
                            <table id="categoryTable" class="table table-striped">

                                {{-- Table headers --}}
                                <thead>
                                    <th>Category ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </thead>

                                {{-- Table content --}}
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td> {{-- ID --}}
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @role('Admin|Manager')
                                                    {{-- Edit button --}}
                                                    <a class="btn btn-primary"
                                                        href="{{ route('category.edit', $category->id) }}">Edit</a>

                                                    {{-- Delete button --}}
                                                    <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                        data-target="#categoryModal" id="{{ $category->id }}">
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
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">

                {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="categoryModalLabel">Confirm Deletion</h1>
                    </div>
                    <div class="modal-body">
                        <p>This action will delete the category. Are you sure you want to proceed?</p>
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

            // Reinitialise event listeners for delete buttons
            function reinitialiseDeleteButtons() {
                $('.delete').off('click').on('click', function() {

                    // ID of the category user wants to delete
                    const id = this.id;

                    // Dynamic URL
                    $('#deleteModal').attr('action', '{{ route('category.destroy', '') }}' + '/' + id);
                });
            }

            reinitialiseDeleteButtons();

            table.on('draw', function() {
                reinitialiseDeleteButtons();
            });
        });
    </script>
@endsection

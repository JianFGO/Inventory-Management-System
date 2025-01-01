@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'User')

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

                        {{-- Employee table --}}
                        <div class="table-responsive">
                            <table id="userTable" class="table table-striped">

                                {{-- Table headers --}}
                                <thead>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Branch</th>
                                    <th>Action</th>
                                </thead>

                                {{-- Table content --}}
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td> {{-- ID --}}
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->getRoleNames()->first() ?? 'No Role Assigned' }}</td>
                                            <td>{{ $user->branch->name }}</td>
                                            <td>

                                                {{-- Edit button --}}
                                                <a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}"><i
                                                        class="fas fa-edit"></i>Edit</a>

                                                {{-- Delete button --}}
                                                <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                    data-target="#userModal" id="{{ $user->id }}"><i
                                                        class="fas fa-trash-alt"></i>
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
    </div>

    {{-- Modal: A type of pop-up box - for confirming deletion --}}
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">

                {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="userModalLabel">Confirm Deletion</h1>
                    </div>
                    <div class="modal-body">
                        <p>This action will delete the user. Are you sure you want to proceed?</p>
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
            let table = new DataTable('#userTable');

            // Reinitialise event listeners for delete buttons
            function reinitialiseDeleteButtons() {
                $('.delete').off('click').on('click', function() {

                    // ID of the user that admin wants to delete
                    const id = this.id;

                    // Dynamic URL
                    $('#deleteModal').attr('action', '{{ route('user.destroy', '') }}' + '/' + id);
                });
            }

            reinitialiseDeleteButtons();

            table.on('draw', function() {
                reinitialiseDeleteButtons();
            });
        });
    </script>
@endsection

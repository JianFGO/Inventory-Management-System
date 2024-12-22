@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'Users')

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
                            <table id="employeesTable" class="table table-striped">

                                {{-- Table headers --}}
                                <thead>
                                    <th>User Code</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Branch</th>
                                    <th>Action</th>
                                </thead>

                                {{-- Table content --}}
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td> {{-- ID --}}
                                            <td>{{ $employee->full_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->username }}</td>
                                            <td>{{ $employee->password }}</td>
                                            <td>{{ $employee->role }}</td>
                                            <td>{{ $employee->branch->name }}</td>
                                            <td>

                                                {{-- Edit button --}}
                                                <a class="btn btn-primary"
                                                    href="{{ route('employees.edit', $employee->id) }}">Edit</a>

                                                {{-- Delete button --}}
                                                <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                    data-target="#employeeModal" id="{{ $employee->id }}">
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
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">

                {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="employeeModalLabel">Confirm Deletion</h1>
                    </div>
                    <div class="modal-body">
                        <p>This action will delete the user. Are you sure you want to proceed?</p>
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
            let table = new DataTable('#employeeTable');
            // For deleting the selected employee
            $('.delete').on('click', function() {

                // ID of the employee, admin wants to delete
                const id = this.id;

                // Dynamic URL
                $('#deleteModal').attr('action', '{{ route('employees.destroy', '') }}' + '/' + id);
            });
        });
    </script>
@endsection

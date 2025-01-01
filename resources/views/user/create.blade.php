@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Add User')

@section('content')
    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h1 class="form-heading">{{ $page_title }}</h1>
                    </div>

                    {{-- Form for adding creating new user details --}}
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        <div class="card-body">

                            {{-- Full Name input --}}
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            {{-- Display an error message if 'full name' field is invalid --}}
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Email input --}}
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            {{-- Display an error message if 'email' field is invalid --}}
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Password input --}}
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            {{-- Display an error message if 'password' field is invalid --}}
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Role selection --}}
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="" disabled selected>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Display an error message if 'role' field is invalid --}}
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Branch selection --}}
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="form-control" name="branch_id" id="branch_id">
                                    <option value="" disabled selected>Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Display an error message if 'branch_id' field is invalid --}}
                            @error('branch_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

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

@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Edit User');

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h4>{{ $page_title }}</h4>
                    </div>

                    {{-- Form for updating user details --}}
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            {{-- Full Name input --}}
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                            {{-- Display an error message if 'full name' field is invalid --}}
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Email input --}}
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                            {{-- Display an error message if 'email' field is invalid --}}
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Role selection --}}
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="" disabled>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->getRoleNames()->first() === $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Display an error message if 'role' field is invalid --}}
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Branch selection --}}
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control" name="branch_id" id="branch_id">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $branch->id == $user->branch_id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                    @endforeach
                                </select>
                            </div>
                            {{-- Display an error message if 'branch' field is invalid --}}
                            @error('branch_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Submit button for form --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

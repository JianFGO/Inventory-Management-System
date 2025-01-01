@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Add Category')

@section('content')
    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h1 class="form-heading">{{ $page_title }}</h1>
                    </div>

                    {{-- Form for adding new category --}}
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        <div class="card-body">

                            {{-- Name input --}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            {{-- Display an error message if 'name' field is invalid --}}
                            @error('name')
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

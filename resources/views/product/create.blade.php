@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Add Product')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h4>{{ $page_title }}</h4>
                    </div>

                    {{-- Form for adding new product --}}
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        <div class="card-body">

                            {{-- Name input --}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            {{-- Display an error message if 'name' field is invalid --}}
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Category selection --}}
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Branch selection --}}
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control" name="branch_id" id="branch_id">
                                    <option value="" disabled selected>Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('branch_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Price input --}}
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" id="price" min="0" step="0.01"
                                    class="form-control">
                            </div>
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Quantity input --}}
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control">
                            </div>
                            @error('quantity')
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

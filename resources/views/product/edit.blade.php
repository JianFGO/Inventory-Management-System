@extends('layouts.master');

{{-- Browser tab title --}}
@section('title', 'Edit Product');

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h4>{{ $page_title }}</h4>
                    </div>

                    {{-- Form for updating product --}}
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                        {{-- CSRF token: Protects form from cross-site request forgery attacks --}}
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            {{-- Name input --}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $product->name }}">
                            </div>

                            {{-- Display an error message if 'name' field is invalid --}}
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Category selection --}}
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
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
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $branch->id == $product->branch_id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                    @endforeach
                                </select>
                            </div>
                            @error('branch_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Price input --}}
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" id="price" class="form-control"
                                    value="{{ $product->price }}">
                            </div>
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- Quantity input --}}
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="form-control"
                                    value="{{ $product->quantity }}">
                            </div>
                            @error('quantity')
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

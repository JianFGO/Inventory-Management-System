@extends('layouts.master')

@section('title', 'Category')

@section('content')
    <h1>Category</h1>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $page_title }}</h4>
                    </div>
                    <div class="card-body">
                        {{-- Categories table --}}
                        <table id="myTable" class="table table-striped">
                            {{-- Table headers --}}
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            {{-- Table content --}}
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $loop->index + 1 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // For datatable plugin
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection

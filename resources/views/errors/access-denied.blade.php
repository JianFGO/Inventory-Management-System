@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'Access Denied')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Page title --}}
                    <div class="card-header">
                        <h4>Access Denied</h4>
                    </div>
                    <div class="card-body">

                        {{-- Message --}}
                        <div class="alert alert-danger text-center">
                            <h5>You don't have the required permissions to view this page.</h5>
                        </div>

                        {{-- Return Button --}}
                        <div class="text-center">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                Return to Dashboard
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

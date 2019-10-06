@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Customers overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right mb-3">
                    <a href="{{ route($prefix.'customers.create') }}"><span class="fas fa-user-plus"></span> Add</a>
                </div>
            </div>
            @include('admin-mailer::customers._table')
        </div>
    </div>

@endsection

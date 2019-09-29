@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Show the details of <strong>{{ $customer->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right">
                <a href="{{ route($prefix.'customers.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'customers.create') }}"><span class="fas fa-user-plus"></span> Add</a>
            </div>
            {{ dump($customer) }}
        </div>
    </div>

@endsection
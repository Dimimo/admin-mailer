@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
        </div>
        <div class="card-body">
            This is the index page
            <h4>Routes</h4>
            <h5>Customers</h5>
            <ul>
                <li><a href="{{ route($prefix . 'customers.index') }}">Index</a></li>
            </ul>
        </div>
    </div>

@endsection

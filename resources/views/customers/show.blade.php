@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Show the details of <strong>{{ $customer->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'customers.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}"><span class="fas fa-edit"></span> Edit</a>
            </div>
            {{ dump($customer) }}
        </div>
    </div>

@endsection
@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">
                Show all Campaigns connect to the <strong>{{ $list->name }}</strong> list
            </h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'lists.index') }}">Overview</a><br>
                <a href="{{ route('admin-mailer.lists.customers', [$list->id]) }}">Customers</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $list->name }}</h4>
                    <div class="card-text">
                        {!! $list->description !!}
                    </div>
                    <h5 class="card-title pt-3">All Campaigns connected to this List:</h5>
                    @include('admin-mailer::campaigns._table')
                </div>
            </div>
        </div>
    </div>

@endsection
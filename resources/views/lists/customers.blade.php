@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">
                Show all customers connect to the <strong>{{ $list->name }}</strong> list
            </h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'lists.index') }}">Overview</a><br>
                <a href="{{ route('admin-mailer.lists.campaigns', [$list->id]) }}">Campaigns</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $list->name }}</h4>
                    <div class="card-text">
                        {!! $list->description !!}
                    </div>
                    <h5 class="card-title pt-3">All customers connected to this Campaign:</h5>
                    @include('admin-mailer::customers._table')
                </div>
            </div>
        </div>
    </div>

@endsection
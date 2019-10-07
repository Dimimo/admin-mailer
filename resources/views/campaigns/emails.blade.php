@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Show all emails in the campaign <strong>{{ $campaign->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'campaigns.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'campaigns.lists') }}"><span class="fas fa-list-ul"></span> Lists</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ $campaign->name }}<br>
                        <small class="text-muted">
                            reaches {{ count($campaign->uuid_customers) }} customers
                            <a href="{{ route($prefix.'campaigns.customers', [$campaign->id]) }}">
                                <span class="fas fa-eye fa-spin green" title="View all customers"></span>
                            </a>
                        </small>
                    </h4>
                    <div class="card-text">
                        {!! $campaign->description !!}
                    </div>
                        <h5 class="card-title pt-3">
                            All emails connected to this Campaign:
                            <a href="{{ route($prefix.'emails.create', [$campaign->id]) }}" class="float-right">
                                <small><span class="fas fa-plus"></span> Add an email to this Campaign</small>
                            </a>
                        </h5>
                        @include('admin-mailer::emails._table')
                    </div>
            </div>
        </div>
    </div>

@endsection
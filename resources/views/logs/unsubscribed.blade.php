@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Logging and Tracking overview</h4>
            <h5>Users that have unsubscribed on <a
                        href="{{ route($prefix.'emails.show', [$email->id]) }}"><strong>{{ $email->title }}</strong></a>
            </h5>
            <h6>Part of the <a
                        href="{{ route($prefix.'campaigns.show', [$email->campaign->id]) }}"><strong>{{ $email->campaign->name }}</strong></a>
                Campaign</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right mb-3">
                    <a href="{{ route($prefix.'logs.index') }}"><span class="fas fa-list"></span> Back to overview</a>
                </div>
            </div>
            @include('admin-mailer::customers._table')
        </div>
    </div>

@endsection

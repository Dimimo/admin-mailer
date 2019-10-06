@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Show the details of the campaign <strong>{{ $campaign->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'campaigns.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'campaigns.lists') }}"><span class="fas fa-list-ul"></span> Lists</a>
            </div>
            @include('admin-mailer::campaigns._card')
        </div>
    </div>

@endsection
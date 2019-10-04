@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">
                Show all customers connect to the <strong>{{ $campaign->name }}</strong> campaign
            </h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right">
                <a href="{{ route($prefix.'campaigns.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'campaigns.lists') }}"><span class="fas fa-list-ul"></span> Lists</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $campaign->name }}</h4>
                    <div class="card-text">
                        {!! $campaign->description !!}
                    </div>
                    <div class="box-rounded-grey my-3">
                        <h5 class="card-title pt-3">All customers connected to this Campaign:</h5>
                        @include('admin-mailer::customers._table')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
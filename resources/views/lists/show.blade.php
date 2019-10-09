@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Show the details of the list <strong>{{ $list->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'lists.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'lists.edit', [$list->id]) }}"><span class="fas fa-edit"></span> Edit</a>
            </div>
            <h4>
                This list has {{ number_format($list->customers_count) }} subscribers
                <a href="{{ route($prefix.'lists.customers', [$list->id]) }}">
                    <span class="fas fa-eye fa-spin green" title="View all customers"></span>
                </a>

            </h4>
            <h5>Description / Strategy</h5>
            <p>
                {!! $list->description !!}
            </p>

            <h5>Linked to a city?</h5>
            <p class="text-muted">
                @if ($list->city)
                    {{ $list->city->name }}
                @else
                    Nationwide
                @endif
            </p>

            <h5>Linked to {{ count($list->campaigns) }} campaigns:</h5>
            <ul>
                @foreach ($list->campaigns as $campaign)
                    <li><a href="{{ route($prefix.'campaigns.show', [$campaign->id]) }}">{{ $campaign->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
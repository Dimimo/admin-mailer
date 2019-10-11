@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Logging and Tracking overview</h4>
            <h5>Users that have read <a href="{{ route($prefix.'emails.show', [$email->id]) }}"><strong>{{ $email->title }}</strong></a></h5>
            <h6>Part of the <a href="{{ route($prefix.'campaigns.show', [$email->campaign->id]) }}"><strong>{{ $email->campaign->name }}</strong></a> Campaign</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right mb-3">
                    <a href="{{ route($prefix.'logs.index') }}"><span class="fas fa-list"></span> Back to overview</a>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Opened</th>
                    <th>Name or organisation</th>
                    <th>Location</th>
                    <th><span class="fa fa-eye" title="Still accepts email?"></span></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->read_datetime->format('d-m-y H:i') }}</td>
                        <td>
                            <a href="{{ route($prefix.'customers.show', [$log->customer->id]) }}">
                                {{ $log->customer->name }}
                            </a>
                        </td>
                        <td>
                            @if ($log->customer->city)
                                {{ $log->customer->city->name }}
                            @else
                                unknown or irrelevant
                            @endif
                        </td>
                        <td>
                            @if ($log->customer->accepts_mail)
                                <span class="fas fa-envelope-open green" title="Accepts emails"></span>
                            @else
                                <span class="fas fa-envelope orange" title="Has unsubscribed"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

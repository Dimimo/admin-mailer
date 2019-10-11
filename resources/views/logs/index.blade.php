@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Logging and Tracking overview</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Campaign</th>
                    <th><span class="fas fa-users" title="Reach"></span></th>
                    <th><span class="fas fa-eye" title="Has read"></span></th>
                    <th><span class="fa fa-unlink" title="Unsubscribed"></span></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($emails as $email)
                    <tr>
                        <td>{{ $email->send_datetime->format('d-m-y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin-mailer.emails.show', [$email->id]) }}" title="{{ $email->title }}">
                                {{ Illuminate\Support\Str::limit($email->title, 25) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin-mailer.campaigns.show', [$email->campaign->id]) }}"
                               title="{{ $email->campaign->name }}">
                                {{ Illuminate\Support\Str::limit($email->campaign->name, 25) }}
                            </a>
                        </td>
                        <td title="View the Customers connected to this email Campaign">
                            <a href="{{ route($prefix.'campaigns.customers', [$email->campaign->id]) }}">
                                <strong>{{ count($email->campaign->uuid_customers) }}</strong>
                            </a>
                        </td>
                        <td>
                            @if ($email->logs->count() > 0)
                                <a href="{{ route($prefix.'logs.read', [$email->id]) }}">
                                    {{ $email->logs()->opened()->count() }}
                                </a>
                            @else
                                0
                            @endif
                        </td>
                        <td>
                            <a href="{{ route($prefix.'logs.unsubscribed', [$email->id]) }}">
                                {{ $email->unsubscribed->count() }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td rowspan="5" class="bigger-120 red">
                            No Logs yet because no emails where send out
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

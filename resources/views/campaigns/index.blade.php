@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">campaigns overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right">
                    <a href="{{ route($prefix.'campaigns.create') }}"><span class="fas fa-user-plus"></span> Add</a><br>
                    <a href="{{ route($prefix.'campaigns.lists') }}"><span class="fas fa-list-ul"></span> Lists</a>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Updated</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th><span class="fas fa-list-ul" title="Number of lists connected to this campaign"></span></th>
                    <th><span class="fas fa-mail-bulk" title="Number of emails in the campaign"></span></th>
                    <th><span class="fas fa-users" title="Number of customers included in this campaign"></span></th>
                    <th><span class="fas fa-user-cog" title="Owner of this campaign"></span></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin-mailer.campaigns.show', [$campaign->id]) }}"
                               title="{{ $campaign->name }}">
                                {{ Illuminate\Support\Str::limit($campaign->name, 25) }}
                            </a>
                        </td>
                        <td class="text-wrap">{!! wordwrap($campaign->description, 50, '<br>') !!}</td>
                        <td>{{ $campaign->lists_count }}</td>
                        <td>
                            <a href="{{ route($prefix.'campaigns.emails', [$campaign->id]) }}">
                                {{ $campaign->emails_count }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route($prefix.'campaigns.customers', [$campaign->id]) }}">
                                <strong>{{ count($campaign->uuid_customers) }}</strong>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('user.profile.show', [$campaign->owner->slug]) }}">
                                <span class="fas fa-user-cog" title="{{ $campaign->owner->username }}"></span>
                            </a>
                        </td>
                        <td class="align-right">
                            <div class="row justify-content-end">
                                <a href="{{ route($prefix.'campaigns.edit', [$campaign->id]) }}"
                                   class="btn btn-link col-auto green">
                                    <span class="fas fa-edit"></span>
                                </a>
                                <form action="{{ route($prefix.'campaigns.destroy', [$campaign->id]) }}"
                                      class="col-auto ml-n3 pr-1"
                                      onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link" title="Delete this campaign">
                                        <span class="fas fa-trash-alt red"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


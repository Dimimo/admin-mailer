@<table class="table table-hover">
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
    @forelse ($campaigns as $campaign)
        <tr>
            <td>{{ $campaign->updated_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('admin-mailer.campaigns.show', [$campaign->id]) }}"
                   title="{{ $campaign->name }}">
                    {{ Illuminate\Support\Str::limit($campaign->name, 25) }}
                </a>
            </td>
            <td class="text-wrap">{!! wordwrap($campaign->description, 50, '<br>') !!}</td>
            <td title="Show the lists to this Campaign">
                <a href="{{ route('admin-mailer.campaigns.show', [$campaign->id]) }}">
                    {{ $campaign->lists_count }}
                </a>
            </td>
            <td title="Show the emails to this Campaign">
                <a href="{{ route($prefix.'campaigns.emails', [$campaign->id]) }}">
                    {{ $campaign->emails_count }}
                </a>
            </td>
            <td title="Show the customers connected to this Campaign">
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
                    @if ($campaign->emails()->count() === 0)
                        <form action="{{ route($prefix.'campaigns.destroy', [$campaign->id]) }}"
                              class="col-auto ml-n3 pr-1"
                              onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" class="btn btn-link" title="Delete this campaign">
                                <span class="fas fa-trash-alt red"></span>
                            </button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td rowspan="8" class="bigger-120 red">
                No Campaigns yet
                <a href="{{ route($prefix.'campaigns.create') }}">
                    <span class="fas fa-user-plus"></span> Create one
                </a>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
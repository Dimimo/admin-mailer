<div class="card">
    <div class="card-body">
        <h4 class="card-title">
            {{ $campaign->name }}<br>
            <small class="text-muted">(reaches {{ count($campaign->uuid_customers) }} customers)</small>
        </h4>
        <div class="card-text">
            {!! $campaign->description !!}
        </div>
        <h5 class="card-title pt-3">Selected email lists:</h5>
        <div class="list-group">
            @forelse ($campaign->lists as $list)
                <a href="{{ route($prefix.'lists.show', [$list->id]) }}"
                   class="list-group-item list-group-item-action mb-2">
                    {{ $list->name }}<br>
                    <small class="text-muted">{!! $list->description !!}</small>
                </a>

            @empty
                <div class="text-danger bigger-120">There are no lists in this campaign</div>
            @endforelse
        </div>
    </div>
    <div class="card-footer bg-light">
        <span class="text-muted">Maintained by
            <a href="{{ route('user.profile.show', [$campaign->owner->slug]) }}">{{ $campaign->owner->username }}</a>
        </span>
        <a href="{{ route($prefix.'campaigns.edit', [$campaign->id]) }}">
            <span class="float-right fas fa-edit green"></span>
        </a>
    </div>
</div>
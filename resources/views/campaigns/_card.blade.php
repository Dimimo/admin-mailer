<div class="card">
    <div class="card-body">
        <h4 class="card-title">
            {{ $campaign->name }}<br>
            <small class="text-muted">
                Reaches {{ count($campaign->uuid_customers) }} customers
                <a href="{{ route($prefix.'campaigns.customers', [$campaign->id]) }}">
                    <span class="fas fa-eye fa-spin green" title="View all customers"></span>
                </a>
            </small>
        </h4>
        <div class="card-text">
            {!! $campaign->description !!}
        </div>
        <div class="box-rounded-grey my-3">
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
        <div class="box-rounded-grey my-3">
            <h5 class="card-title pt-3">Emails in the campaign</h5>
            <div class="list-group">
                @forelse ($campaign->emails as $email)
                    <a href="{{ route($prefix.'emails.show', [$email->id]) }}"
                       class="list-group-item list-group-item-action mb-2">
                        <span class="text-muted">{{ $email->updated_at->format('d/m/y') }}</span>
                        @if($email->draft)
                            <span class="fas fa-lock-open orange mx-2" title="This email is a draft"></span>
                        @else
                            <span class="fas fa-lock green mx-2" title="This email has been send"></span>
                        @endif
                        {{ $email->title }}
                    </a>
                @empty
                    <div class="text-danger bigger-120">There are no emails yet,
                        <a href="{{ route($prefix.'emails.create', [$campaign->id]) }}">
                            <span class="fas fa-mail-bulk"></span> create one
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="card-footer bg-light">
        <span class="text-muted">Maintained by
            <a href="{{ route('user.profile.show', [$campaign->owner->slug]) }}">{{ $campaign->owner->username }}</a>
        </span>
        <a href="{{ route($prefix.'campaigns.edit', [$campaign->id]) }}" title="Update this campaign">
            <span class="float-right fas fa-edit green"></span>
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">
            {{ $email->title }}<br>
            <small class="text-muted">Reaches {{ count($email->campaign->uuid_customers) }} customers</small>
        </h4>
        <div class="box-rounded-grey my-2">
            <div class="card-text">
                {!! $email->body !!}
            </div>
        </div>
        <h5 class="card-title pt-3">Selected email lists:</h5>
        <div class="list-group">
            @forelse ($email->campaign->lists as $list)
                <a href="{{ route($prefix.'lists.show', [$list->id]) }}"
                   class="list-group-item list-group-item-action mb-2">
                    {{ $list->name }}<br>
                    <small class="text-muted">{!! $list->description !!}</small>
                </a>

            @empty
                <div class="text-danger bigger-120">There are no lists in this email</div>
            @endforelse
        </div>
    </div>
    <div class="card-footer bg-light">
        <span class="text-muted">Maintained by
            <a href="{{ route('user.profile.show', [$email->owner->slug]) }}">{{ $email->owner->username }}</a>
        </span>
        @if ($email->draft)
        <a href="{{ route($prefix.'emails.edit', [$email->id]) }}">
            <span class="float-right fas fa-edit green"></span>
        </a>
        @else
            <a href="{{ route($prefix.'emails.copy', [$email->id]) }}"
               title="copy the content and create a new email">
                <span class="float-right far fa-copy"></span>
            </a>
        @endif
    </div>
</div>
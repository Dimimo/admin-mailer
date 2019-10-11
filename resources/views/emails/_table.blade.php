<table class="table table-hover">
    <thead>
    <tr>
        <th>Created</th>
        <th>Title</th>
        <th>Words</th>
        <th>Send?</th>
        <th>Send at</th>
        <th>Campaign</th>
        <th><span class="fas fa-users" title="Number of customers reached"></span></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse ($emails as $email)
        <tr>
            <td>{{ $email->created_at->format('d/m/y') }}</td>
            <td>
                <a href="{{ route('admin-mailer.emails.show', [$email->id]) }}" title="{{ $email->title }}">
                    {{ Illuminate\Support\Str::limit($email->title, 25) }}
                </a>
            </td>
            <td>{{ str_word_count(strip_tags($email->body)) }}</td>
            <td>
                @if($email->draft)
                    <span class="fas fa-lock-open orange ml-2" title="This email is a draft"></span>
                @else
                    <span class="fas fa-lock green ml-2" title="This email has been send"></span>
                @endif
            </td>
            <td>
                @if($email->completed())
                    {{ $email->send_datetime ? $email->send_datetime->format('d/m/y H:i') : '' }}
                @else
                    <a href="{{ route($prefix.'mailer.send', [$email->id]) }}">
                        Proceed...
                    </a>
                @endif
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
            <td class="align-right">
                <div class="row justify-content-end">
                    @if (!$email->send_datetime)
                        <a href="{{ route($prefix.'emails.edit', [$email->id]) }}"
                           class="btn btn-link col-auto green">
                            <span class="fas fa-edit"></span>
                        </a>
                        <form action="{{ route($prefix.'emails.destroy', [$email->id]) }}"
                              class="col-auto ml-n3 pr-1"
                              onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" class="btn btn-link" title="Delete this email">
                                <span class="fas fa-trash-alt red"></span>
                            </button>
                        </form>
                    @endif
                    <a href="{{ route($prefix.'emails.copy', [$email->id]) }}"
                       class="btn btn-link col-auto grey" title="copy the content and create a new email">
                        <span class="far fa-copy"></span>
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8"><span class="bigger-120 red">There are no emails yet!</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
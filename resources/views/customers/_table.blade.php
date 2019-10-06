<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>City</th>
        <th>List</th>
        <th><span class="fas fa-at" title="Accepts mail?"></span></th>
        <th><span class="fas fa-link" title="Has a known website?"></span></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($customers as $customer)
        <tr class="bg-light">
            <td>
                <a href="{{ route('admin-mailer.customers.show', [$customer->id]) }}" title="{{ $customer->name }}">
                    {{ Illuminate\Support\Str::limit($customer->name, 25) }}
                </a>
            </td>
            <td title="{{ $customer->email }}">{{ Illuminate\Support\Str::limit($customer->email, 30) }}</td>
            <td>{{ $customer->city ? $customer->city->name : null }}</td>
            <td>
                @if ($customer->list)
                    <span class="fas fa-check-circle green"></span>
                    <a href="{{ route('admin-mailer.lists.show', [$customer->list->id]) }}" title="{{ $customer->list->name }}">
                        {{ Illuminate\Support\Str::limit($customer->list->name, 20) }}</a>
                @else
                    <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}" class="btn btn-link col-auto green">
                        <span class="fas fa-exclamation-circle red ml-3"></span> Not listed, fix this
                    </a>
                @endif
            </td>
            <td>
                @if ($customer->accepts_mail)
                    <span class="fas fa-envelope-open green" title="Accepts emails"></span>
                @else
                    <span class="fas fa-envelope orange" title="Has unsubscribed"></span>
                @endif
            </td>
            <td>
                @if ($customer->url)
                    <span class="fas fa-check green"></span>
                @endif
            </td>
            <td class="align-right">
                <div class="row justify-content-end">
                    <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}"
                       class="btn btn-link col-auto green">
                        <span class="fas fa-edit"></span>
                    </a>
                    <form action="{{ route($prefix.'customers.destroy', [$customer->id]) }}"
                          class="col-auto ml-n3 pr-1"
                          onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" class="btn btn-link" title="Delete this customer">
                            <span class="fas fa-trash-alt red"></span>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
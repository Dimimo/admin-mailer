@if ($customer->list)
    <span class="fas fa-check-circle green"></span>
    <a href="{{ route('admin-mailer.lists.show', [$customer->list->id]) }}" title="{{ $customer->list->name }}">
        {{ Illuminate\Support\Str::limit($customer->list->name, 20) }}</a>
@else
    <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}" class="btn btn-link col-auto green">
        <span class="fas fa-exclamation-circle red ml-3"></span> Not listed, fix this
    </a>
@endif
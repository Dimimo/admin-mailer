<a class="text-nowrap" href="{{ route('admin-mailer.customers.show', [$customer->id]) }}" title="{{ $customer->name }}">
    {{ Illuminate\Support\Str::limit($customer->name, 25) }}
</a>
<a class="text-nowrap" href="{{ route('admin-mailer.customers.show', [$customer->id]) }}" title="{{ $customer->customer_name }}">
    {{ Illuminate\Support\Str::limit($customer->customer_name, 23) }}
</a>
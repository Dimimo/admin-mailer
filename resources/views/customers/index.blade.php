@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Customers overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right">
                    <a href="{{ route($prefix.'customers.create') }}"><span class="fas fa-user-plus"></span> Add</a>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Listed?</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>
                            <a href="{{ route('admin-mailer.customers.show', [$customer->id]) }}">{{ $customer->name }}</a>
                        </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->city ? $customer->city->name : null }}</td>
                        <td>
                            @if ($customer->list)
                                <span class="fas fa-check-circle green"></span>
                                <a href="{{ route('admin-mailer.lists.show', [$customer->list->id]) }}">{{ $customer->list->name }}</a>
                            @else
                                <span class="fas fa-exclamation-circle red ml-3"></span>
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
        </div>
    </div>

@endsection

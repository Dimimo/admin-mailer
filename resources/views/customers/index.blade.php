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
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td class="align-right">
                            <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}" class="green"><span class="fas fa-edit"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

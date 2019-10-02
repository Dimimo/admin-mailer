@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Lists overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right">
                    <a href="{{ route($prefix.'lists.create') }}"><span class="fas fa-user-plus"></span> Add</a>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Description</th>
                    <th><span class="fas fa-users" title="Number of customers in the list"></span></th>
                    <th><span class="fas fa-bullhorn" title="Number of campaigns using this list"></span></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $list)
                    <tr>
                        <td><a href="{{ route('admin-mailer.lists.show', [$list->id]) }}">{{ $list->name }}</a></td>
                        <td>{{ $list->city ? $list->city->name : 'nationwide' }}</td>
                        <td>{!! $list->description !!}</td>
                        <td>{{ $list->customers_count }}</td>
                        <td>{{ $list->campaigns_count }}</td>
                        <td class="align-right">
                            <div class="row justify-content-end">
                                <a href="{{ route($prefix.'lists.edit', [$list->id]) }}" class="btn btn-link col-auto green">
                                    <span class="fas fa-edit"></span>
                                </a>
                                <form action="{{ route($prefix.'lists.destroy', [$list->id]) }}" class="col-auto ml-n3 pr-1"
                                      onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link" title="Delete this list">
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

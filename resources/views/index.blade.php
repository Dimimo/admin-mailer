@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <h5 class="center">Customers</h5>
                    <div class="list-group">
                        <a href="{{ route($prefix . 'customers.index') }}" class="list-group-item list-group-item-action">Index</a>
                        <a href="{{ route($prefix.'customers.create') }}" class="list-group-item list-group-item-action">Add
                            new</a>
                    </div>
                </div>
                <div class="col-2">
                    <h5 class="center">Lists</h5>
                    <div class="list-group">
                        <a href="{{ route($prefix . 'lists.index') }}" class="list-group-item list-group-item-action">Index</a>
                        <a href="{{ route($prefix . 'lists.create') }}" class="list-group-item list-group-item-action">Add
                            new</a>
                    </div>
                </div>
                <div class="col-2">
                    <h5 class="center">Campaigns</h5>
                    <div class="list-group">
                        <a href="{{ route($prefix . 'campaigns.index') }}" class="list-group-item list-group-item-action">Index</a>
                        <a href="{{ route($prefix . 'campaigns.create') }}" class="list-group-item list-group-item-action">Add
                            new</a>
                        <a href="{{ route($prefix.'campaigns.lists') }}" class="list-group-item list-group-item-action">Lists</a>
                    </div>
                </div>
                <div class="col-2">
                    <h5 class="center">Emails</h5>
                    <div class="list-group">
                        <a href="{{ route($prefix . 'emails.index') }}" class="list-group-item list-group-item-action">Index</a>
                        <a href="{{ route($prefix . 'emails.create') }}" class="list-group-item list-group-item-action">Add
                            new</a>
                    </div>
                </div>
                <div class="col-2">
                    <h5 class="center">Mailer</h5>
                    <div class="list-group">
                        <a href="{{ route($prefix . 'mailer.index') }}" class="list-group-item list-group-item-action">Index</a>
                    </div>
                </div>
                <div class="col-2">
                    <h5 class="center">Logs/Tracking</h5>
                    <div class="list-group">
                        <a href="{{ route($prefix . 'logs.index') }}" class="list-group-item list-group-item-action">Index</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

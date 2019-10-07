@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')
    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">campaigns overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8"><h5>All Campaigns table overview</h5></div>
                <div class="col-4 align-right mb-3">
                    <a href="{{ route($prefix.'campaigns.create') }}">
                        <span class="fas fa-user-plus"></span> Add
                    </a><br>
                    <a href="{{ route($prefix.'campaigns.lists') }}">
                        <span class="fas fa-list-ul"></span> Campaign Lists overview
                    </a>
                </div>
            </div>
            @include('admin-mailer::campaigns._table')
        </div>
    </div>

@endsection


@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Update the list <strong>{{ $list->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 offset-10 align-right">
                    <a href="{{ route($prefix.'lists.index') }}"><span class="fas fa-list-ul"></span> Overview</a>
                </div>
            </div>
            <div class="p-3">
                @include('admin-mailer::lists._form')
            </div>
        </div>
    </div>

@endsection
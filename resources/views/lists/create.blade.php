@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Create a new list</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 offset-10 align-right mb-3">
                    <a href="{{ route($prefix.'lists.index') }}"><span class="fas fa-list-ul"></span> Overview</a>
                </div>
            </div>
            <div class="p-3">
                @include('admin-mailer::lists._form')
            </div>
        </div>
    </div>

@endsection

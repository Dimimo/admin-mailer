@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Emails overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview of all emails</h5></div>
                <div class="col-2 align-right mb-3">
                    <a href="{{ route($prefix.'emails.create') }}"><span class="fas fa-mail-bulk"></span> Add</a>
                </div>
            </div>
            @include('admin-mailer::emails._table')
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Update the Email <strong>{{ $email->title }}</strong></h4>
            <h5>For the <a href="{{ route('admin-mailer.campaigns.show', [$email->campaign->id]) }}">
                    {{ $email->campaign->name }}</a> Campaign</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 offset-10 align-right mb-3">
                    <a href="{{ route($prefix.'emails.index') }}"><span class="fas fa-list-ul"></span> Overview</a>
                </div>
            </div>
            <div class="p-3">
                @include('admin-mailer::emails._form')
            </div>
        </div>
    </div>

@endsection

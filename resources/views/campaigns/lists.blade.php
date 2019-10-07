@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Overview of campaigns and their email lists</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 offset-10 align-right mb-3">
                    <a href="{{ route($prefix.'campaigns.index') }}"><span class="fas fa-list-ul"></span> Overview</a>
                </div>
            </div>
            <div class="py-5">
                <div class="card-group">
                    @foreach ($campaigns as $campaign)
                        @include('admin-mailer::campaigns._card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection


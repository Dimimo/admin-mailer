@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="jumbotron align-center">
        <h4 class="display-4">Your are unsubscribed</h4>
        <p class="lead">
            You won't receive any more messages from our website on <i>{{ $customer->email }}</i>.<br>
            If you unsubscribed by error, you can still re-subscribe with this link:<br>
            <a href="{{ route($prefix . 'subscribe', ['u' => $customer->uuid]) }}">
                {{ route($prefix . 'subscribe', ['u' => $customer->uuid]) }}
            </a>
        </p>
        <hr class="my-4">
        <p>You could also <a href="{{ route('user.register') }}">create a log in</a> and list your
            <a class="call-modal" href="#" data-modal-size="modal-lg"
               data-modal-url="/ajax/modal_factory/home.modals.sites_modal">business</a> and/or
            <a class="call-modal" href="#" data-modal-size="modal-lg"
               data-modal-url="/ajax/modal_factory/home.modals.city-services_modal">city service</a>for free.</p>
        <div class="d-flex justify-content-center">
            <div class="px-5">
                <a class="btn btn-primary btn-lg" href="{{ route('user.register') }}" role="button">Register</a>
            </div>
            <div class="px-5">
                <a class="btn btn-success btn-lg" href="{{ route('home') }}" role="button">Home page</a>
            </div>
        </div>
    </div>

@endsection

@push('js')
    @include('common.js.modal_factory')
@endpush

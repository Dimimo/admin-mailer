@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Show the details of the email <strong>{{ $email->title }}</strong></h4>
            <h5>For the <a href="{{ route('admin-mailer.campaigns.show', [$email->campaign->id]) }}">
                    {{ $email->campaign->name }}</a> Campaign</h5>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'emails.index') }}">Overview</a><br>
                @if ($email->draft)
                    <a href="{{ route($prefix.'emails.edit', [$email->id]) }}">
                        <span class="fas fa-edit"></span> Edit
                    </a>
                @else
                    <a href="{{ route($prefix.'emails.copy', [$email->id]) }}"
                       title="copy the content and create a new email">
                        <span class="far fa-copy"></span> Copy
                    </a>
                @endif
            </div>
            @if ($email->draft)
                <div class="box-rounded-grey p-3 m-5">
                    <a href="{{ route($prefix.'emails.send_copy', [$email->id]) }}" id="send_test">
                        <span class="fas fa-shipping-fast green"></span> Send a test email to your inbox
                    </a>
                    <div id="send_mail" style="display: none;" class="p-3 bigger-140">
                        <a href="{{ route($prefix.'mailer.send', [$email->id]) }}">
                            <span class="fab fa-themeisle green"></span> Send this email to the customers
                        </a>
                    </div>
                </div>
            @else
                <div class="box-rounded-info p-3 m-5 center">
                    <h5>This mail has been send on {{ $email->send_datetime->format('d-m-Y H:i') }}</h5>
                    <a href="{{ route($prefix.'emails.copy', [$email->id]) }}"
                       class="btn btn-link col-auto" title="copy the content and create a new email">
                        <span class="far fa-copy"></span> You may copy the email's content to create a new email
                    </a>
                </div>
            @endif
            @include('admin-mailer::emails._card')
        </div>
    </div>
    <div id="snackbar"></div>

@endsection

@include('admin-mailer::js.send_test_mail')

@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4>Send the email <strong>{{ $email->title }}</strong></h4>
            <h5 class="text-muted">
                Part of the <strong><a href="{{ route('admin-mailer.campaigns.show', [$email->campaign->id]) }}">
                        {{ $email->campaign->name }}</a></strong> Campaign
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 offset-10 align-right mb-3">
                    <a href="{{ route($prefix.'emails.index') }}">
                        <span class="fas fa-list-ul"></span> Emails overview
                    </a>
                </div>
            </div>
            <div class="box-rounded-white m-5 p-5 center">
                <h3>
                    This is it.<br>
                    Send this email to {{ count($customers) }} customers.
                </h3>
                @if ($already_send !== 0 || count($customers) !== $already_send)
                    <h6>
                        <i>{{ $already_send }} customers already received the email but the process got interrupted.<br>
                            The remaining customers will be receiving this email in this new attempt.</i>
                    </h6>
                @endif
                <h6>
                    If this process was interrupted, it will ignore the users that already have received the
                    email. You'll see customers who have unsubscribed. This was necessary for statistical reasons.
                    Of course they don't get an email. A bogus log entry is created instead.
                </h6>
                <h4>After sending, just relax, enjoy the show.</h4>
                <div class="box-rounded-info my-5 align-left">
                    <strong>Title:</strong> {{ $email->title }}
                    <div class="pt-2"><strong>Message:</strong><br>
                        {!! $email->body !!}
                    </div>
                </div>
                <a href="{{ route($prefix.'emails.send_copy', [$email->id]) }}" type="button" id="send_test"
                   class="btn btn-block btn-success dark-green mb-3">
                    <span class="fas fa-exclamation-circle"></span> You can still send a test email to your inbox
                </a>
                <a href="{{ route($prefix.'emails.edit', [$email->id]) }}" id="send_edit"
                   class="btn btn-link mb-3" style="display:none;">
                    Not happy? You can still edit the email here and come back!
                </a>
                <button id="start_sending" class="btn btn-block btn-danger" type="button">Start Sending the email to all
                    customers
                </button>
            </div>
            <div class="box-rounded-white m-5 p-5" id="show_results" style="display: none;">
                <h5 id="ol_title">
                    Sending <strong>
                        <span id="counter_display">{{ count($customers) }}</span>
                    </strong> emails ... progress follows ...
                </h5>
                <div class="progress m-3" style="height: 20px;">
                    <div class="progress-bar progress-bar-animated" role="progressbar" aria-valuenow="0"
                         aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%
                    </div>
                </div>
                <ol id="ol_list" class="list-group"></ol>
            </div>
        </div>
    </div>
    <div id="snackbar"></div>

@endsection

@include('admin-mailer::js.send_test_mail')

@push('js')
    <script>
        let $customers = {!! $customers !!};
        const $total = $customers.length;
        const $email_id = {{ $email->id }};
        const token = $('meta[name="csrf-token"]').attr('content');
        const button = $('button#start_sending');
        let $counter = 0;
        let $progress = 0;
        button.on('click', function (e) {
            e.preventDefault();
            button
                .attr('disabled', 'disabled')
                .removeClass('btn-danger')
                .addClass('btn-primary')
                .text('... sending emails in progress ...');
            $('a#send_test').fadeOut();
            $('a#send_edit').fadeOut();
            $('div#show_results').show();
            ajaxRecursive();
        });

        function ajaxRecursive() {
            if ($customers.length === 0) {
                $('#ol_title').addClass('dark-green')
                    .html('<span class="fas fa-check-circle green"></span> All emails has been send!');
                button.text('... sending emails DONE ...');
                $('.progress-bar').addClass('bg-success');
                return;
            }
            let $id = $customers.shift();
            $.ajax({
                url: '{{ route('admin-mailer.mailer.sending') }}',
                type: 'POST',
                cache: false,
                data: {'email_id': $email_id, 'id': $id, '_token': token},
                dataType: 'json',
                success: function (resp) {
                    const $ol = $('ol#ol_list');
                    $counter++;
                    if (resp.status === 'warning') {
                        $ol.prepend(
                            '<li id="'
                            + $counter
                            + '" class="list-group-item bg-light">'
                            + '<span class="badge badge-primary badge-pill">'
                            + $counter
                            + '</span> '
                            + '<span class="fas fa-exclamation-circle orange"></span> '
                            + resp.message
                            + '</li>'
                        );
                    } else {
                        $ol.prepend(
                            '<li id="'
                            + $counter
                            + '" class="list-group-item">'
                            + '<span class="badge badge-primary badge-pill">'
                            + $counter
                            + '</span> '
                            + '<span class="fas fa-check-circle green"></span> '
                            + resp.message
                            + '</li>'
                        );
                    }

                    $('li').filter(function () {
                        return parseInt($(this).attr('id')) < ($counter - 10) && $(this).hasClass('bg-light') === false;
                    }).remove();
                    $('span#counter_display').text($customers.length);
                    $progress = Math.floor($counter / $total * 100);
                    $('.progress-bar').css('width', $progress + '%').attr('aria-valuenow', $progress).text($progress + '%');
                    ajaxRecursive();
                }
            });
        }

    </script>
@endpush

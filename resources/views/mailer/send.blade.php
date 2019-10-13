@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4>Send the email <strong>{{ $email->title }}</strong></h4>
            <h5 class="text-muted">Part of the <strong><a
                            href="{{ route('admin-mailer.campaigns.show', [$email->campaign->id]) }}">{{ $email->campaign->name }}</a></strong>
                Campaign</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 offset-10 align-right mb-3">
                    <a href="{{ route($prefix.'emails.index') }}"><span class="fas fa-list-ul"></span> Emails
                        overview</a>
                </div>
            </div>
            <div class="box-rounded-white m-5 p-5 center">
                <h3>
                    This is it.<br>
                    Send this email to {{ count($customers) }} customers.
                </h3>
                <h4>After sending, just relax, enjoy the show and <span class="red">DON'T refresh the page</span></h4>
                <h5>
                    If this process was interrupted before, it could be the process goes very fast at first. It also
                    means that the emails has been send out already. Untill the process slows down again.
                </h5>
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
                <h5 id="ol_title">Sending {{ count($customers) }} emails ... progress follows ...</h5>
                <ol id="ol_list" class="list-group"></ol>
            </div>
        </div>
    </div>
    <div id="snackbar"></div>

@endsection

@include('admin-mailer::js.send_test_mail')

@push('js')
    <script>
        let $customers = {{ $customers }};
        const $total = $customers.length;
        const $email_id = {{ $email->id }};
        const token = $('meta[name="csrf-token"]').attr('content');
        let $counter = 0;
        $('button#start_sending').on('click', function (e) {
            const button = $('button#start_sending');
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
                $('button#start_sending').text('... sending emails DONE ...');
                $('ol#ol_list').append(
                    '<li class="list-group-item">'
                    + '<span class="fas fa-check-circle green"></span> '
                    + '<span class="bigger-140 green">It\'s done! All messages have been send!</span>'
                    + '</li>'
                );
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
                        $ol.append(
                            '<li class="list-group-item bg-light">'
                            + '<span class="badge badge-primary badge-pill">'
                            + $counter
                            + '</span> '
                            + '<span class="fas fa-exclamation-circle green"></span> '
                            + resp.message
                            + '</li>'
                        );
                    } else {
                        $ol.append(
                            '<li class="list-group-item">'
                            + '<span class="badge badge-primary badge-pill">'
                            + $counter
                            + '</span> '
                            + '<span class="fas fa-check-circle green"></span> '
                            + resp.message
                            + '</li>'
                        );
                    }

                    ajaxRecursive();
                }
            });
        }

    </script>
@endpush

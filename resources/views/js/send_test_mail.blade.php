@push('js')
    <script>
        $('#send_test').on('click', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            $(this).html('<span class="fas fa-sync fa-spin fa-2x fa-fw dark-grey"></span>');
            $.ajax({
                url,
                cache: false,
                dataType: "json",
            })
                .done(function (resp) {
                    snackbar(resp.message, resp.type);
                    $('#send_test').hide();
                    $('#send_mail').fadeIn();
                    $('#send_edit').fadeIn();
                });
        });
    </script>
    @include('common.js.snackbar')
@endpush
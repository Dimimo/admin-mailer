<form action="{{ $customer->id? route($prefix.'customers.update', [$customer->id]) : route($prefix.'customers.store') }}"
      method="post">
    {{ csrf_field() }}
    @if ($customer->id) @method('PUT') @endif
    <label for="uuid"></label>
    <input type="text" hidden id="uuid" name="uuid"
           value="{{  old('uuid', $customer->uuid) }}">
    <div class="form-group row">
        <label for="name" class="col-2 col-form-label align-right">Name/Company</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('name')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                   type="text" id="name" name="name" placeholder="(required)" minlength="4"
                   maxlength="80" value="{{ old('name', $customer->name) }}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('name') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Name is valid
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-2 col-form-label align-right">Email</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('email')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                   type="email" id="email" name="email" placeholder="(required)"
                   value="{{ old('email', $customer->email) }}">
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('email') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Email is valid
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="real_name" class="col-2 col-form-label align-right">Real name</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('real_name')) is-invalid @endif"
                   type="text" id="real_name" name="real_name" placeholder="(optional)" maxlength="80"
                   value="{{ old('real_name', $customer->real_name) }}" aria-describedby="realNameHelp">
            @if ($errors->has('real_name'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('real_name') }}
                </div>
            @endif
            <small id="realNameHelp" class="form-text text-muted">
                The real name, if known, is used in the email recipient header. If we don't
                know, the name of the company is used.
            </small>
        </div>
    </div>
    <div class="form-group row">
        <label for="city_id" class="col-2 col-form-label align-right">City (optional)</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('city_id')) is-invalid @endif"
                   type="text" id="city_id" name="city_id" placeholder="(start typing)"
                   value="{{ old('city_id', $customer->city_id) }}">
            @if ($errors->has('city_id'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('city_id') }}
                </div>
            @endif
        </div>
    </div>
    {{-- Check if the business id has been added, if not make it possible to choose from a dropdown --}}
    @if (old('site_id', $customer->site))
        <div class="form-group row">
            <label for="site_name" class="col-2 col-form-label align-right">Business</label>
            <div class="col-10">
                <input class="form-control @if ($errors->has('site_id')) is-invalid @endif"
                       type="text" id="site_name" name="site_name"
                       value="{{ \App\Models\Site::find(old('site_id', $customer->site_id))->name }}">
                <label for="site_it"></label>
                <input type="hidden" id="site_id" name="site_id" value="{{ old('site_id', $customer->site_id) }}">
                @if ($errors->has('site_id'))
                    <div class="invalid-feedback">
                        <span class="fas fa-exclamation-circle"></span> {{ $errors->first('site_id') }}
                    </div>
                @elseif (count($errors) > 0)
                    <div class="valid-feedback">
                        <span class="fas fa-check-circle"></span> This business is correcly added
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="form-group row">
            <label for="form_input_site" class="col-2 col-form-label align-right">Business</label>
            <div class="col-10">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="form_input_spinner" style="display: none;">
                            <span class="fas fa-sync fa-spin fa-fw spinner"></span>
                        </div>
                    </div>
                    <input class="form-control" type="text" id="form_input_site" name="form_input_site"
                           placeholder="(optional - start typing)"
                           value="{{ old('form_input_site') }}" aria-describedby="siteHelp">
                </div>
                <small id="siteHelp" class="form-text text-muted">
                    If this person has an existing business listed on this website, start typing and
                    choose the person's business from the dropdown list.
                </small>
            </div>
        </div>
        <div class="row mb-5">
            <div class="offset-2 col-auto">
                <div id="transfer_results" style="display: none;">
                    <label for="site_id"></label>
                    <select name="site_id" id="site_id" class="custom-select"></select>
                    <br/>
                </div>
                <div id="transfer_no_results" class="red" style="display: none;">There are no results,
                    please try again.
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <label for="mailer_list_id" class="col-2 align-right mt-2">Mailer list</label>
        <div class="col-auto">
            <select name="mailer_list_id" id="mailer_list_id"
                    class="custom-select @if ($errors->has('mailer_list_id')) is-invalid @elseif (count($errors) > 0) is-valid @endif">
                <option value="">Choose a mailing list</option>
                @foreach($lists as $list)
                    <option value="{{ $list->id }}"
                            @if (old('mailer_list_id', $customer->mailer_list_id) == $list->id) selected @endif
                            title="{{ $list->description }}">{{ $list->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('mailer_list_id'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('mailer_list_id') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> List choice is valid
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-2 pt-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="accepts_mail"
                       name="accepts_mail" aria-describedby="acceptsEmailHelp" value="1" checked>
                <label class="custom-control-label align-right" for="accepts_mail">
                    Send emails to this user?
                </label>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    If you uncheck this box, this customer will not receive any emails, even if they are
                    in a list.<br>
                    If a customer chooses to <strong>unsubscribe</strong>, this value becomes unchecked.
                </small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-2 p-4">
            <button class="btn btn-block btn-primary" type="submit">
                @if ($customer->id) Update {{ $customer->name }} @else Create @endif
            </button>
        </div>
    </div>
</form>

@include('common.push.autocomplete_city', ['field' => 'city_id'])

{{-- If the site_id dropdown is needed, so is the jquer --}}
@if (!old('site_id', $customer->site_id))
    @push('js')
        <script>
            //find the sites based on the search string and build the dropdown list
            $('input#form_input_site').on('keyup', function (e) {
                e.preventDefault();
                let site = this.value;
                if (site.length > 2) {
                    //console.log(site);
                    const token = $('input[name=_token]').val();
                    $('#form_input_spinner').show();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.users.transfer.find_sites') }}',
                        cache: false,
                        data: {'sites': site, '_token': token},
                        dataType: 'json',
                        success: function (data) {
                            let options = $('#site_id');
                            if (data.length !== 0) {
                                $('#transfer_no_results').hide();
                                $('#transfer_results').show();
                                options.html('').append('<option value=""> -- select -- </option>');
                                $.each(data, function (i, el) {
                                    options.append('<option value="' + el.id + '" class="site_name_selected">' + el.name + ' (' + el.city.name + ' in ' + el.city.province.name + ')</option>');
                                });
                            } else {
                                $('#transfer_results').hide();
                                $('#transfer_no_results').show();
                            }
                            $('#form_input_spinner').hide();
                        }
                    });
                }
            });
        </script>
    @endpush
@endif


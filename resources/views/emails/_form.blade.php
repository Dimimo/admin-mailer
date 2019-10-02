<form action="{{ $email->id? route($prefix.'emails.update', [$email->id]) : route($prefix.'emails.store') }}"
      method="post">
    {{ csrf_field() }}
    @if ($email->id) @method('PUT') @endif

    <div class="row">
        <label for="mailer_campaign_id" class="col-2 col-form-label align-right">Create in Campaign</label>
        <div class="col-auto">
            <select class="custom-select @if ($errors->has('mailer_campaign_id')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                    name="mailer_campaign_id" id="mailer_campaign_id" aria-describedby="campaignHelp"
                    @if ($email->send_datetime) disabled="disabled" @endif>
                <option value="">-- select a campaign --</option>
                @foreach ($campaigns as $campaign)
                    <option value="{{ $campaign->id }}"
                            @if ($campaign->optionEmail($campaign->id, $email)) selected @endif >
                        {{ $campaign->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('mailer_campaign_id'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('mailer_campaign_id') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Campaign selection is valid
                </div>
            @endif
            @if ($email->send_datetime)
                <input type="hidden" name="mailer_campaign_id" value="{{ $email->mailer_campaign_id }}">
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="offset-2 col-10">
            <small id="listSelection" class="text-muted">
                Every email is linked to a Campaign. While a campaign can have multiple emails, an email belongs to only
                one Campaign.<br>
                If you want to use the same email in other campaign, please use the <strong>copy function</strong> on
                the <a href="{{ route($prefix.'emails.index') }}">overview page</a>.<br>
                @if ($email->send_datetime)
                    <span class="red">
                        This email has been send already on {{ $email->send_datetime->format('Y-m-d \a\t H:i') }} and
                        can't be changed anymore.
                    </span>
                    <br>
                @endif
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="offset-2 col-10">
            <div class="box-rounded-grey p-2">
                <h5>Available options:</h5>
                <ul>
                    <li><strong>**name**</strong> the name of the company or person</li>
                    <li><strong>**realname**</strong> the real name of the company or person, if it's not known, the
                        <strong>name</strong> is used instead
                    </li>
                    <li><strong>**email**</strong> the email of the company or person</li>
                </ul>
                <p>
                    You can use these variables in both the title and the email content.<br>
                    For example <i>Attention to **name**</i> becomes <i>Attention to Manila Hotel</i>
                </p>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-2 col-form-label align-right">Title</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('title')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                   type="text" id="title" name="title" placeholder="(required)" minlength="4"
                   maxlength="80" value="{{ old('title', $email->title) }}">
            @if ($errors->has('title'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('title') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Title is valid
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="body" class="col-2 col-form-label align-right">Email content</label>
        <div class="col-10">
            <textarea
                    class="form-control @if ($errors->has('body')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                    id="body" name="body">
                {!! old('body', $email->body) !!}
            </textarea>
            @if ($errors->has('body'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('body') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Email content is valid
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-2 p-4">
            <button class="btn btn-block btn-primary" type="submit">
                @if ($email->id) Update {{ $email->name }} @else Create @endif
            </button>
        </div>
    </div>
</form>

@include('common.push.summernote',['summernote_id' => 'body', 'summernote_url' => 'upload/articles/image', 'page_templates' => false])


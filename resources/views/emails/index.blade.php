@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h3><span class="far fa-envelope blue"></span> Administration mailer</h3>
            <h4 class="text-muted">Emails overview</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h5>Table overview</h5></div>
                <div class="col-2 align-right">
                    <a href="{{ route($prefix.'emails.create') }}"><span class="fas fa-user-plus"></span> Add</a>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Campaign</th>
                    <th>Size</th>
                    <th>Send?</th>
                    <th>Send at</th>
                    <th><span class="fas fa-bullhorn grey" title="Campaign using this email"></span></th>
                    <th><span class="fas fa-user-cog grey" title="Owner of this email"></span></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($emails as $email)
                    <tr>
                        <td>
                            <a href="{{ route('admin-mailer.emails.show', [$email->id]) }}" title="{{ $email->title }}">
                                {{ Illuminate\Support\Str::limit($email->title, 30) }}
                            </a>
                        </td>
                        <td>{{ $email->city ? $email->city->name : 'nationwide' }}</td>
                        <td>{{ str_word_count(strip_tags($email->body)) }} words</td>
                        <td>
                            @if($email->draft)
                                <span class="fas fa-lock-open orange ml-2" title="This email is a draft"></span>
                            @else
                                <span class="fas fa-lock green ml-2" title="This email has been send"></span>
                            @endif
                        </td>
                        <td>{{ $email->send_datetime ? $email->send_datetime->format('Y-m-d H:i') : 'draft' }}</td>
                        <td>
                            <a href="{{ route('admin-mailer.campaigns.show', [$email->campaign->id]) }}"
                               title="{{ $email->campaign->name }}">
                                <span class="fas fa-bullhorn green"></span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('user.profile.show', [$email->owner->slug]) }}">
                                <span class="fas fa-user-cog" title="{{ $email->owner->username }}"></span>
                            </a>
                        </td>
                        <td class="align-right">
                            <div class="row justify-content-end">
                                <a href="{{ route($prefix.'emails.copy', [$email->id]) }}"
                                   class="btn btn-link col-auto grey" title="copy the content and create a new email">
                                    <span class="far fa-copy"></span>
                                </a>
                                <a href="{{ route($prefix.'emails.edit', [$email->id]) }}"
                                   class="btn btn-link col-auto green">
                                    <span class="fas fa-edit"></span>
                                </a>
                                <form action="{{ route($prefix.'emails.destroy', [$email->id]) }}"
                                      class="col-auto ml-n3 pr-1"
                                      onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link" title="Delete this email">
                                        <span class="fas fa-trash-alt red"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"><span class="bigger-120 red">There are no emails yet!</span></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

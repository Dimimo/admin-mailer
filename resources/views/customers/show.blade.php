@extends('layouts.app')

@section('content')

    @include('admin-mailer::header')

    <div class="card">
        <div class="card-header bg-light align-center">
            <h4 class="text-muted">Show the details of <strong>{{ $customer->name }}</strong></h4>
        </div>
        <div class="card-body">
            <div class="col-2 offset-10 align-right mb-3">
                <a href="{{ route($prefix.'customers.index') }}">Overview</a><br>
                <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}"><span class="fas fa-edit"></span> Edit</a>
            </div>

            <div class="row">
                <div class="col">
                    <h5>Email:</h5>
                    <p class="text-muted">{{ $customer->email }}</p>

                    <h5>Listed in:</h5>
                    <p class="text-muted">
                        <a href="{{ route('admin-mailer.lists.show', [$customer->list->id]) }}">
                            {{ $customer->list->name }}
                        </a>
                    </p>

                    <h5>Real name:</h5>
                    <p class="text-muted">{{ $customer->real_name ? $customer->real_name : 'unknown' }}</p>

                    <h5>City of residence:</h5>
                    <p class="text-muted">
                        @if ($customer->city)
                            {{ $customer->city->name }}
                        @else
                            Not known or irrelevant
                        @endif
                    </p>
                </div>
                <div class="col">
                    <h5>Has a known account?</h5>
                    <p class="text-muted">
                        @if ($customer->user_id)
                            <a href="{{ route('user.profile.show', [$customer->user->slug]) }}">{{ $costumer->user->name }}</a>
                        @else
                            No
                        @endif
                    </p>

                    <h5>Accepts Mail:</h5>
                    <p class="text-muted">{{ $customer->accepts_mail ? 'Yes' : 'No' }}</p>

                    <h5>Reads mail?</h5>
                    <p class="text-muted">{{ $customer->reads_mail ? 'Yes' : 'No (although we can\'t ever be sure)' }}</p>

                    <h5>Website:</h5>
                    <p class="text-muted">
                        @if ($customer->url)
                            <a href="{{ $customer->url }}" target="_blank">{{ $customer->url }}</a>
                        @else
                            unknown
                        @endif
                    </p>
                </div>
                <div class="col">
                    <h5>Facebook:</h5>
                    <p class="text-muted">
                        @if ($customer->facebook)
                            <a href="{{ $customer->facebook }}" target="_blank">{{ $customer->facebook }}</a>
                        @else
                            unknown
                        @endif
                    </p>
                    <h5>Wikipedia:</h5>
                    <p class="text-muted">
                        @if ($customer->url)
                            <a href="{{ $customer->wikipedia }}" target="_blank">{{ $customer->wikipedia }}</a>
                        @else
                            unknown
                        @endif
                    </p>

                    <h5>Business site on this website?</h5>
                    <p class="text-muted">
                        @if($customer->site_id)
                            <a href="{{ route('sites.show', [$customer->site->city->province->slug, $customer->site->city->slug, $customer->site->slug]) }}">
                                {{ $customer->site->name }}
                            </a>
                        @else
                            No
                        @endif
                    </p>

                    <h5>City Service on this website?</h5>
                    <p class="text-muted">
                        @if($customer->service_id)
                            <a href="{{ route('service.show', [$customer->service->city->province->slug,
                                                                $customer->service->city->slug,
                                                                $customer->service->id,
                                                                $customer->service->slug]) }}">
                                {{ $customer->site->name }}
                            </a>
                        @else
                            No
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
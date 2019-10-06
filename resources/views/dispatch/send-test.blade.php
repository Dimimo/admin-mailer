@extends('admin-mailer::dispatch.layout')

@section('content')

    @include('admin-mailer::header')
    {!! $email->body !!}
@endsection
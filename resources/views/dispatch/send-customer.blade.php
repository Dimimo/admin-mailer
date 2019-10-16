@extends('admin-mailer::dispatch.layout')

@section('content')

    {!! $email->body !!}
@endsection
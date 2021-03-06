@extends('app')

@section('title'){{ 'Prijava' }}@stop
@section('description'){{ 'OPG Sarac - prijava' }}@stop

@section('content')
<h4>Prijava</h4>
<form action='{{ route("auth.login") }}' method='POST' autocomplete='off'>
    <input type='email' name='email' placeholder='Email' value='{{ Request::old("email") ?: '' }}' class='{{ $errors->has("email") ? "has-error" : "" }}' autofocus>
    <input type='password' name='password' placeholder='Password' class='{{ $errors->has("password") ? "has-error" : "" }}'>
    {{ csrf_field() }}
    <input type='submit' value='Prijava'>
</form>
@include('partials.errors')
<p>Nemate račun? <a href='{{ route("auth.register") }}'>Registrirajte</a> se.</p>
@stop

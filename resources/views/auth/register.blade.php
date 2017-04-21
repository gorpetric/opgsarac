@extends('app')

@section('title'){{ 'Registracija' }}@stop
@section('description'){{ 'OPG Sarac - registracija' }}@stop

@section('content')
<h4>Registracija</h4>
<form action='{{ route("auth.register") }}' method='POST' autocomplete='off'>
    <input type='email' name='email' placeholder='Email' value='{{ Request::old("email") ?: '' }}' class='{{ $errors->has("email") ? "has-error" : "" }}' autofocus><br>
    <input type='text' name='first_name' placeholder='Ime' value='{{ Request::old("first_name") ?: '' }}' class='{{ $errors->has("first_name") ? "has-error" : "" }}'><br>
    <input type='text' name='last_name' placeholder='Prezime' value='{{ Request::old("last_name") ?: '' }}' class='{{ $errors->has("last_name") ? "has-error" : "" }}'><br>
    <input type='password' name='password' placeholder='Password' class='{{ $errors->has("password") ? "has-error" : "" }}'><br>
    <input type='password' name='password_repeat' placeholder='Password ponovo' class='{{ $errors->has("password_repeat") ? "has-error" : "" }}'><br>
    {{ csrf_field() }}
    <input type='submit' value='Registracija'>
</form>
@include('partials.errors')
<p>Već imate račun? <a href='{{ route("auth.login") }}'>Prijavite</a> se.</p>
@stop

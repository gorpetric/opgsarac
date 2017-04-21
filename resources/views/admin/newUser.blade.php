@extends('app')

@section('title'){{ 'Admin - new user' }}@stop
@section('description'){{ 'OPG Sarac - admin - dodavanje novog člana' }}@stop

@section('content')
<section class='admin'>
    <h3>Admin - new user</h3>
    <div class='admin__new-user'>
        <form action='{{ route("admin.newUser") }}' method='POST' autocomplete='off'>
            <input type='text' name='first_name' placeholder='First name' value='{{ Request::old("first_name") ?: '' }}' class='{{ $errors->has("first_name") ? "has-error" : "" }}' autofocus><br>
            <input type='text' name='last_name' placeholder='Last name' value='{{ Request::old("last_name") ?: '' }}' class='{{ $errors->has("last_name") ? "has-error" : "" }}'><br>
            <input type='email' name="email" placeholder='Email' value='{{ Request::old("email") ?: '' }}' class='{{ $errors->has("email") ? "has-error" : "" }}'><br>
            <input type='password' name='password' placeholder='Password' class='{{ $errors->has("password") ? "has-error" : "" }}'><br>
            {{ csrf_field() }}
            <input type='submit' value='Create'>
        </form>
        @include('partials.errors')
    </div>
</section>
@stop

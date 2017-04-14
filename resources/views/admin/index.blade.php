@extends('app')

@section('title'){{ 'Admin' }}@stop
@section('description'){{ 'OPG Sarac - admin panel' }}@stop

@section('content')
<section class='admin'>
    <h3>Admin</h3>
    <a href='{{ route("admin.newUser") }}'>New user</a>
    <div class='admin__users'>
        <hr>
        @foreach($users as $user)
        <form action='{{ route("admin.updateRoles", $user) }}' method='POST' autocomplete='off'>
            <p>
                {{ $user->getFullName() }}
                ({{ $user->email }})
                <span style='color:green'>|</span>
                <label for='role_normal'>Normal</label>
                <input type='checkbox' name='role_normal' id='role_normal' {{ $user->hasRole('Normal') ? 'checked' : '' }}>
                <label for='role_moderator'>Moderator</label>
                <input type='checkbox' name='role_moderator' id='role_moderator' {{ $user->hasRole('Moderator') ? 'checked' : '' }}>
                <label for='role_admin'>Admin</label>
                <input type='checkbox' name='role_admin' id='role_admin' {{ $user->hasRole('Admin') ? 'checked' : '' }}>
                {{ csrf_field() }}
                <input type='submit' value='Update roles'>
                <span style='color:green'>|</span>
                <a class='delete-link' data-swal-text='huuh?' href='{{ route("admin.deleteUser", $user) }}'><i style='color:red;border:1px solid red' class='fa fa-remove'></i></a>
            </p>
        </form>
        @endforeach
    </div>
</section>
@stop

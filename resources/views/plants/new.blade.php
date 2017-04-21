@extends('app')

@section('title'){{ 'Biljke - nova' }}@stop
@section('description'){{ 'OPG Sarac - dodavanje nove biljke' }}@stop

@section('content')
<section class='plants'>
    <h4>Dodaj novu biljku</h4>
    <form action='{{ route("plants.new") }}' method='POST' autocomplete='off' enctype='multipart/form-data'>
        <label for='name'>Ime</label>
        <input type='text' name='name' id='name' value='{{ Request::old("name") ?: '' }}' class='{{ $errors->has("name") ? "has-error" : "" }}' autofocus><br>
        <label for='description'>Opis</label>
        <textarea name='description' rows='8' id='description' class='{{ $errors->has("description") ? "has-error" : "" }}'>{{ Request::old('description') ?: '' }}</textarea><br>
        <label for='image'>Slika</label>
        <input type='file' name='image' id='image' class='{{ $errors->has("image") ? "has-error" : "" }}'><br>
        {{ csrf_field() }}
        <input type='submit' value='Dodaj biljku'>
    </form>
    @include('partials.errors')
</section>
@stop

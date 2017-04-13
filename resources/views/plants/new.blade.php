@extends('app')

@section('title'){{ 'Biljke - nova' }}@stop
@section('description'){{ 'OPG Sarac - dodavanje nove biljke' }}@stop

@section('content')
<section class='plants'>
    <h4>Dodaj novu biljku</h4>
    <form action="{{ route('plants.new') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <label for="name">Ime</label>
        <input type="text" name='name' id='name' value="{{ Request::old('name') ?: '' }}" autofocus><br>
        <label for="description">Opis</label>
        <textarea name='description' rows='8' id='description'>{{ Request::old('description') ?: '' }}</textarea><br>
        <label for="image">Slika</label>
        <input type="file" name="image" id="image"><br>
        <input type="submit" value="Dodaj biljku">
        {{ csrf_field() }}
    </form>
    @include('partials.errors')
</section>
@stop

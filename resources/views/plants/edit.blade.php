@extends('app')

@section('title'){{ 'Biljke - uredi' }}@stop
@section('description'){{ 'OPG Sarac - uređivanje postojeće biljke' }}@stop

@section('content')
<section class='plants'>
    <h4>Uredi biljku</h4>
    <form action='{{ route("plants.edit", $plant) }}' method='POST' autocomplete='off' enctype='multipart/form-data'>
        <label for='name'>Ime</label>
        <input type='text' name='name' id='name' value='{{ Request::old("name") ?: $plant->name }}' autofocus><br>
        <label for='description'>Opis</label>
        <textarea name='description' rows='8' id='description'>{{ Request::old('description') ?: $plant->description }}</textarea><br>
        Stara slika: <img style='width:100px' src='{{ asset($plant->image) }}'><br>
        <label for='image'>Nova slika</label>
        <input type='file' name='image' id='image'><br>
        {{ csrf_field() }}
        <input type='submit' value='Uredi biljku'>
    </form>
    @include('partials.errors')
</section>
@stop

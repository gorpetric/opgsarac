@extends('app')

@section('title'){{ 'Proizvodi - novi' }}@stop
@section('description'){{ 'OPG Sarac - kreiranje novog proizvoda' }}@stop

@section('content')
<section class='products'>
    <h3>Dodaj novi proizvod</h3>
    <form action='{{ route("products.new") }}' method='POST' autocomplete='off' enctype='multipart/form-data'>
        <label for='name'>Ime</label>
        <input type='text' name='name' id='name' placeholder='Ime novog proizvoda' value='{{ Request::old("name") ?: '' }}' class='{{ $errors->has("name") ? "has-error" : "" }}' autofocus><br>
        <label for='description'>Opis</label>
        <textarea name='description' rows='8' id='description' placeholder='Opis proizvoda' class='{{ $errors->has("description") ? "has-error" : "" }}'>{{ Request::old('description') ?: '' }}</textarea><br>
        <label for='image'>Slika</label>
        <input type='file' name='image' id='image' class='{{ $errors->has("image") ? "has-error" : "" }}'><br>
        <p><small>Ovo bude glavna slika proizvoda. Dodatne slike možete dodati na stranici proizvoda kada se kreira.</small></p>
        {{ csrf_field() }}
        <input type='submit' value='Dodaj prizvod'>
    </form>
    <p>Pakiranja za proizvod možete dodati kada se proizvod kreira, kod uređivanja proizvoda.</p>
    @include('partials.errors')
</section>
@stop

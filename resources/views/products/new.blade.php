@extends('app')

@section('title'){{ 'Proizvodi - novi' }}@stop
@section('description'){{ 'OPG Sarac - kreiranje novog proizvoda' }}@stop

@section('content')
<section class="products">
    <h3>Dodaj novi proizvod</h3>
    <form action="{{ route('products.new') }}" method='POST' autocomplete='off' enctype="multipart/form-data">
        <label for="name">Ime</label>
        <input type="text" name='name' id='name' placeholder='Ime novog proizvoda' value="{{ Request::old('name') ?: '' }}" autofocus><br>
        <label for="description">Opis</label>
        <textarea name='description' rows='8' id='description' placeholder='Opis proizvoda (u opis dodati i podatke o pakiranju i cijenama)'>{{ Request::old('description') ?: '' }}</textarea><br>
        <label for="image">Slika</label>
        <input type="file" name="image" id="image"><br>
        <p><small>Ovo bude glavna slika proizvoda. Dodatne slike možete dodati na stranici proizvoda kada se kreira.</small></p>
        <input type="submit" value="Dodaj prizvod">
        {{ csrf_field() }}
    </form>
    @include('partials.errors')
</section>
@stop

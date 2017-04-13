@extends('app')

@section('title'){{ 'Proizvodi - uredi' }}@stop
@section('description'){{ 'OPG Sarac - uređivanje postojećeg proizvoda' }}@stop

@section('content')
<section class="products">
    <h4>Uredi proizvod</h4>
    <form action="{{ route('products.editProduct', $product) }}" method='POST' autocomplete='off' enctype="multipart/form-data">
        <label for="name">Ime</label>
        <input type="text" name='name' id='name' placeholder='Ime proizvoda' value="{{ Request::old('name') ?: $product->name }}" autofocus><br>
        <label for="description">Opis</label>
        <textarea name='description' rows='8' id='description' placeholder='Opis proizvoda (u opis dodati i podatke o pakiranju i cijenama)'>{{ Request::old('description') ?: $product->description }}</textarea><br>
        Stara slika: <img style='width:100px' src="{{ asset($product->mainImage()->name) }}"><br>
        <label for="image">Nova slika</label>
        <input type="file" name="image" id="image"><br>
        <input type="submit" value="Uredi prizvod">
        {{ csrf_field() }}
    </form>
    @include('partials.errors')
</section>
@stop

@extends('app')

@section('title'){{ 'Proizvodi - uredi' }}@stop
@section('description'){{ 'OPG Sarac - uređivanje postojećeg proizvoda' }}@stop

@section('content')
<section class='products'>
    <h4>Uredi proizvod <small><a href='{{ route("products.product", $product) }}'>{{ $product->name }}</a></small></h4>
    <form action='{{ route("products.editProduct", $product) }}' method='POST' autocomplete='off' enctype='multipart/form-data'>
        <label for='name'>Ime</label>
        <input type='text' name='name' id='name' placeholder='Ime proizvoda' value='{{ Request::old("name") ?: $product->name }}' class='{{ $errors->has("name") ? "has-error" : "" }}' autofocus><br>
        <label for='description'>Opis</label>
        <textarea name='description' rows='8' id='description' placeholder='Opis proizvoda' class='{{ $errors->has("description") ? "has-error" : "" }}'>{{ Request::old('description') ?: $product->description }}</textarea><br>
        Stara slika: <img style='width:100px' src='{{ asset($product->mainImage()->name) }}'><br>
        <label for='image'>Nova slika</label>
        <input type='file' name='image' id='image' class='{{ $errors->has("image") ? "has-error" : "" }}'><br>
        {{ csrf_field() }}
        <input type='submit' value='Uredi prizvod'>
    </form>
    <hr>
    <h4>Pakiranja</h4>
    @foreach($product->packages as $package)
        <p>{{ $package->package }} - {{ number_format($package->priceHRK, 2, ',', '.') }} HRK <small>(<a href='{{ route("products.deletePackage", [$product, $package->id]) }}' class='delete-link'>Obriši</a>)</small></p>
    @endforeach
    <form action='{{ route("products.newPackage", $product) }}' method='POST' autocomplete='off'>
        <label for='package'>Ime pakiranja</label>
        <input type='text' name='package' placeholder='Ime pakiranja' class='{{ $errors->has("package") ? "has-error" : "" }}'>
        <label for='kune'>Cijena u kunama</label>
        <input type='text' name='kune' placeholder='Cijeli dio' size=5 value='{{ Request::old("kune") ?: "0" }}' class='{{ $errors->has("kune") ? "has-error" : "" }}'> ,
        <input type='text' name='lipe' placeholder='Lipe' size=2 maxlength=2 value='{{ Request::old("lipe") ?: "00" }}' class='{{ $errors->has("lipe") ? "has-error" : "" }}'>
        <input type='submit' value='Dodaj novo pakiranje'>
        {{ csrf_field() }}
    </form>
    @include('partials.errors')
</section>
@stop

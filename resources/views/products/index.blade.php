@extends('app')

@section('title'){{ 'Proizvodi' }}@stop
@section('description'){{ 'OPG Sarac - svi proizvodi' }}@stop

@section('content')
<section class='products'>
    @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
        <p><a href='{{ route("products.new") }}'>Dodaj proizvod</a></p>
    @endif
    <h3 class='text-center'>Naši proizvodi</h3>
    <div class='products__faq'>
        <h4>Kako doći do nas?</h4>
            <p>Naše imanje i proizvode slobodno možete razgledati i kupiti kod nas.<br>Pravilo je samo da nas <a href='{{ route("contact.index") }}'>kontaktirate</a> prije svog dolaska.</p>
        <h4>Dostava na Vašu kućnu adresu</h4>
            <p>Nudimo Vam mogućnost naručivanja naših proizvoda, te slanja paketa pomoću Hrvatske pošte ili Tisak paketa.<br>Paket sa vašim prizovodima stiže na Vašu adresu!</p>
        <h4>Dodatne informacije</h4>
            <p>Za sve dodatne informacije, način plaćanja, proizvod koji želite naručiti ili neki drugi upit možete nam poslati e-mail direktno ili upotrijebiti naš <a href='{{ route("contact.index") }}'>kontakt</a> obrazac sa detaljnim opisom Vašeg upita.</p>
    </div>
    <div class='products__list'>
        @if($products->count())
            @foreach($products as $product)
                <div class='product'>
                    <a href='{{ route("products.product", $product) }}'><img src='{{ asset($product->mainImage()->name) }}'></a>
                    <h4><a href='{{ route("products.product", $product) }}'>{{ $product->name }}</a></h4>
                </div>
            @endforeach
        @else
            <p>Trenutno nema ni jednog proizvoda.</p>
        @endif
    </div>
</section>
@stop

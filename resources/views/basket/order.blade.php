@extends('app')

@section('title'){{ 'Košarica - narudžba' }}@stop
@section('description'){{ 'OPG Sarac - narudžba proizvoda iz košarice' }}@stop

@section('content')
<section id='basket'>
    <h3 class='text-center'>Košarica - narudžba</h3>
    <form action='{{ route("basket.order") }}' method='POST'>
        <input type='text' name='name' placeholder='Vaše ime i prezime' class='{{ $errors->has("name") ? "has-error" : "" }}'><br>
        <input type='email' name='email' placeholder='Vaš email (za odgovor)' class='{{ $errors->has("email") ? "has-error" : "" }}'><br>
        <div class='combinedMessage'>
            <textarea name='message' rows='4' placeholder='Dodatna poruka' class='{{ $errors->has("message") ? "has-error" : "" }}'></textarea>
            <div>
                <p>Proizvodi za narudžbu:</p>
                @foreach($basketItems as $item)
                    <a href='{{ route("products.product", $item["productPackage"]->product) }}'>{{ $item['productPackage']->product->name }}</a> -
                    {{ $item['productPackage']->package }} -
                    {{ $item['quantity'] }} x
                    {{ number_format($item['productPackage']->priceHRK, 2, ',', '.') }} =
                    {{ number_format($item['productPackage']->priceHRK * $item['quantity'], 2, ',', '.') }} HRK
                    <br>
                @endforeach()
                <p>Ukupno: {{ $total }} HRK</p>
            </div>
        </div>
        {!! Recaptcha::render() !!}
        {{ csrf_field() }}
        <input type='submit' value='Pošalji upit'>
    </form>
    @include('partials.errors')
</section>
@stop

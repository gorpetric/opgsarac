@extends('app')

@section('title'){{ 'Košarica' }}@stop
@section('description'){{ 'OPG Sarac - košarica s proizvodima za kupnju' }}@stop

@section('content')
<section id='basket'>
    <h3 class='text-center'>Košarica</h3>
    @if(!count($basketItems))
        <p class='text-center'>Vaša košarica je prazna.</p>
    @else
        @foreach($basketItems as $item)
            <form action='{{ route("basket.updateProductPackage", $item["productPackage"]->id) }}' method='POST' autocomplete='off'>
                <a href='{{ route("products.product", $item["productPackage"]->product) }}'>{{ $item['productPackage']->product->name }}</a> -
                {{ $item['productPackage']->package }} -
                <input type='text' name='{{ "quantity" . $item["productPackage"]->id }}' size=2 maxlength=2 value='{{ Request::old("quantity" . $item["productPackage"]->id) ?: $item["quantity"] }}' class='{{ $errors->has("quantity" . $item["productPackage"]->id) ? "has-error" : "" }}'> kom.
                <input type='submit' value='Osvježi'>
                {{ csrf_field() }}
                <small>{{ $item['quantity'] }} * {{ number_format($item['productPackage']->priceHRK, 2, ',', '.') }} = {{ number_format($item['productPackage']->priceHRK * $item['quantity'], 2, ',', '.') }} HRK</small>
                <a class='delete-link' href='{{ route("basket.removeProductPackage", $item["productPackage"]->id) }}'><small>(Obriši)</small></a>
            </form>
            <hr>
        @endforeach
        <p>Ukupno: {{ number_format($total, 2, ',', '.') }} HRK</p>
        <p><a href='{{ route("basket.order") }}'>Nastavi</a></p>
        @include('partials.errors')
    @endif
</section>
@stop

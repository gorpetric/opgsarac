@extends('app')

@section('title'){{ 'Proizvodi - ' . $product->name }}@stop
@section('description'){{ 'OPG Sarac - proizvod - ' . $product->name }}@stop

@section('content')
<section class='products'>
    @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
        <div class='product__actions'>
            <a title='Uredi proizvod' href='{{ route("products.editProduct", $product) }}'><i class='fa fa-edit'></i></a>
            <a title='Obriši proizvod' class='delete-link' href='{{ route("products.deleteProduct", $product) }}' data-swal-text='Proizvod i svi vezani podaci (slike) će biti trajno izgubljeni'><i class='fa fa-remove'></i></a>
        </div>
    @endif
    <div class='products__product'>
        <div class='products__product-image'>
            <a data-lightbox='product' href='{{ asset($product->mainImage()->name) }}'><img src='{{ asset($product->mainImage()->name) }}'></a>
        </div>
        <div class='products__product-info'>
            <h3>{{ $product->name }}</h3>
            <p>{!! nl2br(e($product->description)) !!}</p>
        </div>
        <div class='products__product-packages'>
            @foreach($product->packages as $package)
                <form action='{{ route("basket.addProductPackage", $package) }}' method='POST' autocomplete='off'>
                    {{ $package->package }} - {{ number_format($package->priceHRK, 2, ',', '.') }} HRK
                    <input type='text' name='{{ "quantity" . $package->id }}' size=2 maxlength=2 value='{{ Request::old("quantity" . $package->id) ?: "1" }}' class='{{ $errors->has("quantity" . $package->id) ? "has-error" : "" }}'>
                    <input type='submit' value='Dodaj u košaricu'>
                    {{ csrf_field() }}
                </form>
            @endforeach
        </div>
    </div>
    @if($product->otherImages()->count())
        <hr>
        <div class='products__otherImages'>
            @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
                @foreach($product->otherImages() as $otherImage)
                    <div class='products__otherImages-otherImage'>
                        <a data-lightbox='product' target='_blank' href='{{ asset($otherImage->name) }}'><img src='{{ asset($otherImage->name) }}'></a>
                        <a class='delete-link' href='{{ route("products.deleteOtherImage", [$product, $otherImage->id]) }}'><i class='fa fa-remove'></i></a>
                    </div>
                @endforeach
            @else
                @foreach($product->otherImages() as $otherImage)
                    <div class='products__otherImages-otherImage'>
                        <a data-lightbox='product' target='_blank' href='{{ asset($otherImage->name) }}'><img src='{{ asset($otherImage->name) }}'></a>
                    </div>
                @endforeach
            @endif
        </div>
    @endif
    @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
        <hr>
        <form action='{{ route("products.newOtherImage", $product) }}' method='POST' autocomplete='off' enctype='multipart/form-data'>
            <label for='image'>Odaberi sliku</label>
            <input type='file' name='image' id='image' class='{{ $errors->has("image") ? "has-error" : "" }}'>
            {{ csrf_field() }}
            <input type='submit' value='Dodaj sliku'>
        </form>
    @endif

    @include('partials.errors')
</section>
@stop

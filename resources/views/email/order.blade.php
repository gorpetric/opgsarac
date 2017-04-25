<p>
Ovo je automatska poruka generirana od stranice <a href='http://opgsarac.hr'>opgsarac.hr</a><br>
NEMOJTE odgovarati na ovu poruku!<br>
Odgovorite na email ponuđen ispod.
</p>
<hr>
<p>
Ime i prezime: <strong>{{ $request['name'] }}</strong><br>
EMAIL: <strong>{{ $request['email'] }}</strong><br>
</p>
<hr>
@if($request['message'] !== null)
<p>---------- Poruka ----------</p>
{!! nl2br(e($request['message'])) !!}
<p>---------- Poruka ----------</p>
<hr>
@endif
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

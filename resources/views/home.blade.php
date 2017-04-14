@extends('app')

@section('title'){{ 'O nama' }}@stop

@section('content')
{!! Auth::check() ? '<p>Dobrodošli, <strong>'.Auth::user()->getFullName().'</strong></p><hr>' : ''  !!}
<h3 class='text-center'>Ovdje možete saznati čime se bavi naše gospodarsto</h3>
<p class='text-center home-info'>Naše proizvode možete kupiti na lokalnoj tržnici u Čakovcu i na našoj kućnoj adresi. Našu aktualnu ponudu možete vidjeti <a href="{{ route('products.index') }}">ovdje</a>.</p>
<img class='home01' src='{{ asset("img/home01.jpg") }}'>
<div class='home-grid'>
    <div class='item'>
        <h4>Prerada voća</h4>
        <img src='{{ asset("img/home02.jpg") }}' alt='Prerada voća'>
        <p>U izradi prerađevina koristimo voće isključivo iz vlastitog uzgoja, a količina proizvoda je ograničena sezonskim urodom jer nastojimo proizvesti što kvalitetnji domaći proizvod.</p>
    </div>
    <div class='item'>
        <h4>Uzgoj voća</h4>
        <img src='{{ asset("img/home03.jpg") }}' alt='Uzgoj voća'>
        <p>Uzgoj voća na našem imanju odvija se u čistom okruženju prirode, udaljeno od prometnica, tradicionalnim načinom obrade tla bez uporabe bilo kakvih kemijskih preparata.</p>
    </div>
</div>
@stop

@extends('app')

@section('title'){{ 'Kontakt' }}@stop
@section('description'){{ 'OPG Sarac - stranica sa kontakt podacima' }}@stop

@section('content')
<section id='contact'>
    <h4 class='text-center'>Kontaktirajte nas!</h4>
    <div class='contact__upper'>
        <div class='contact__info'>
            <p><span>Adresa: </span>Slavka Kolara 43, 40 000 Čakovec</p>
            <p><span>Mail: </span>opgsarac.ck@gmail.com</p>
            <p><span>Tel: </span>091 / 912 - 0385</p>
            <p><a target='_blank' href='https://www.facebook.com/opgsarac'><img src='{{ asset("img/facebook.png") }}'></a></p>
            @include('partials.errors')
        </div>
        <div class='contact__form'>
            <form action='{{ route("contact.index") }}' method='POST' autocomplete='off'>
                <input type='text' name='name' placeholder='Vaše ime i prezime'><br>
                <input type='email' name='email' placeholder='Vaš email (za odgovor)'><br>
                <input type='text' name='title' placeholder='Naslov'><br>
                <textarea name='message' rows='8' placeholder='Poruka'></textarea><br>
                {!! Recaptcha::render() !!}
                {{ csrf_field() }}
                <input type='submit' value='Pošalji'>
            </form>
        </div>
    </div>
    <div class="contact__map">
        <iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2751.6603073027077!2d16.446662715819684!3d46.395962078807074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4768ad9717b6d093%3A0x3bec4a2c6a56f9de!2sUl.+Slavka+Kolara+43%2C+40000%2C+%C4%8Cakovec%2C+Croatia!5e0!3m2!1sen!2sus!4v1468488236059' width='100%' height='300' frameborder='0' style='border:0' allowfullscreen></iframe>
    </div>
</section>
@stop

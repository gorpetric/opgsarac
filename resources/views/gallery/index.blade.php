@extends('app')

@section('title'){{ 'Galerija' }}@stop
@section('description'){{ 'OPG Sarac - galerija sa slikama' }}@stop

@section('content')
<section id='gallery'>
    @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
        <form action='{{ Route("gallery.newImage") }}' method='POST' autocomplete='off' enctype='multipart/form-data'>
            <label for='image'>Odaberi sliku</label>
            <input type='file' name='image' id='image'>
            {{ csrf_field() }}
            <input type='submit' value='Dodaj'>
        </form>
        @include('partials.errors')
    @endif
    @if($images->count())
        <div class='gallery__images'>
        @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
            @foreach($images as $image)
                <div class='gallery__image'>
                    <a target='_blank' href='{{ asset($image->path) }}' data-lightbox='gallery'>
                        <img src='{{ asset($image->path) }}'>
                    </a>
                    <a class='delete-link' href='{{ route("gallery.deleteImage", $image) }}' title='Obriši sliku iznad' data-swal-text='Sliku više nije moguće povratiti'>
                        <i class='fa fa-remove'></i>
                    </a>
                </div>
            @endforeach
        @else
            @foreach($images as $image)
                <div class='gallery__image'>
                    <a target='_blank' href='{{ asset($image->path) }}' data-lightbox='gallery'>
                        <img src='{{ asset($image->path) }}'>
                    </a>
                </div>
            @endforeach
        @endif
        </div>
    @else
        <p>Trenutno nema ni jedne slike.</p>
    @endif
</section>
@stop

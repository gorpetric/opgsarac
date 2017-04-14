@extends('app')

@section('title'){{ 'Biljke' }}@stop
@section('description'){{ 'OPG Sarac - biljke koje raste na našem gospodarstvu' }}@stop

@section('content')
<section class='plants'>
    @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
        <p><a href='{{ route("plants.new") }}'>Dodaj biljku</a></p>
    @endif
    <h4 class='text-center'>Nešto o biljkama koje rastu na našem gospodarstvu</h4>
    @if($plants->count())
        <div class='plants'>
        @if(Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Moderator']))
            @foreach($plants as $plant)
                <div class='plant'>
                    <p class='plant__name'>{{ $plant->name }}</p>
                    <p class='plant__description'>{!! nl2br(e($plant->description)) !!}</p>
                    <img class='plant__image' src='{{ asset($plant->image) }}'>
                    <div class='actions'>
                        <a title='Uredi podatke biljke iznad' href='{{ route("plants.edit", $plant) }}'><i class='fa fa-edit'></i></a>
                        <a title='Obriši biljku iznad' class='delete-link' href='{{ route("plants.deletePlant", $plant) }}' data-swal-text='Akcija je nepovratna'><i class='fa fa-remove'></i></a>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($plants as $plant)
                <div class='plant'>
                    <p class='plant__name'>{{ $plant->name }}</p>
                    <p class='plant__description'>{!! nl2br(e($plant->description)) !!}</p>
                    <img class='plant__image' src='{{ asset($plant->image) }}'>
                </div>
            @endforeach
        @endif
        </div>
    @else
    <p>Trenutno nema ni jedne biljke.</p>
    @endif
</section>
@stop

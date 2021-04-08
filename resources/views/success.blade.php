@extends('layouts.app')

@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                Jugador ganador: {{$winnerPlayer}} <br>
                Diferencia de puntuacion: {{$point}}
            </div>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary btn-block rounded-pill" href="{{route('home.index')}}">Volver a jugar</a>
        </div>
    </div>
</section>
@endsection

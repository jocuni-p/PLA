@extends('layout')

@section('subtitle', 'Consulta de pelicula')

@section('content')
<div class='row animated fadeIn slow'>
    <div class='column col-8'>
        <div class="card m-auto">
            <div class="card-body">
                <h2 class="card-title">título película</h2>
                <hr>
                <h5 class="card-subtitle mb-2 text-muted">Dirección: </h5>
                <h5 class="card-subtitle mb-2 text-muted">Año: </h5>
                <hr>
                <p class="card-text">sinopsis</p>
            </div> 
        </div>
        <br>
        <a href="" class="btn btn-outline-primary btn-block">Mantenimiento</a>
        <a href="/peliculas" class="btn btn-outline-primary btn-block">Volver a listado</a>
    </div>
    <div class='column col-4'>
        <img src='{{asset("img/sinportada.jpg")}}'>
    </div>
</div>
@endsection



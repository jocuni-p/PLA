@extends('layout')

@section('subtitle', 'Consulta de pelicula')

@section('content')
<div class='row animated fadeIn slow'>
    @if ($pelicula)
        <div class='column col-8'>
            <div class="card m-auto">
                <div class="card-body">
                    <h2 class="card-title">{{ $pelicula->titulo ?? null }}</h2>
                    <hr>
                    <h5 class="card-subtitle mb-2 text-muted">Dirección: {{ $pelicula->direccion ?? null }}</h5>
                    <h5 class="card-subtitle mb-2 text-muted">Año: {{ $pelicula->anio ?? null }}</h5>
                    <hr>
                    <p class="card-text">{{ $pelicula->sinopsis ?? null }}</p>
                </div>
            </div>
            <br>
			@auth
            <a href="{{ route('mantenimiento.pelicula', [$pelicula->id]) }}" class="btn btn-outline-primary btn-block">Editar</a>
			@endauth
			<a href="{{ route('consulta.peliculas') }}" class="btn btn-outline-primary btn-block">Volver a listado</a>
        </div>
        <div class='column col-4'>
            <img src='{{ asset("img/" . ($pelicula->img ?? "sinportada.jpg")) }}'>
        </div>
    @else
        <div class="col-12 text-center">
            <h3>Película no existe</h3>
            <a href="{{ route('consulta.peliculas') }}" class="btn btn-outline-primary mt-3">Volver a listado</a>
        </div>
    @endif
</div>
@endsection





@extends('layout')

@section('subtitle', 'Consulta de todas las peliculas')

@section('content')
<div class='row animated fadeIn slow'>
    <form action="" class="d-flex justify-content-center">
        <div class="m-3">
            <label class="form-label">Buscar por título:</label>
            <input autofocus type="search" class="form-control" id="filtro"  name="filtro" value="">
        </div>
    </form>
</div>
<hr>
<div class="row row-cols-4 d-flex justify-content-evenly">
    @forelse ($peliculas as $pelicula)
        <div class="card m-2 mb-5">
            <img class="card-img-top" src='{{ asset("img/" . ($pelicula->img ?? "sinportada.jpg")) }}'>
            <div class="card-body">
                <h4 class="card-title">{{ $pelicula->titulo }}</h4>
                <p class="card-text"><b>Dirección: </b>{{ $pelicula->direccion }}</p>
                <p class="card-text"><small class="text-muted"><b>Año: </b>{{ $pelicula->anio }}</small></p>
                <a href="{{ route('consulta.pelicula', [$pelicula->id]) }}" class="btn btn-outline-primary btn-block">Ver más...</a>
				@auth
				<a href="{{ route('mantenimiento.pelicula', [$pelicula->id]) }}" class="btn btn-outline-primary btn-block">Editar</a>
				@endauth
			</div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No hay películas</p>
        </div>
    @endforelse
</div>
@endsection



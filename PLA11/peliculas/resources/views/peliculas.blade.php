
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
	@foreach ($peliculas as $pelicula)
		<div class="card m-2 mb-5">
			<img class="card-img-top" src='{{asset("img/sinportada.jpg")}}'>
			<div class="card-body">
				<h4 class="card-title">{{$pelicula->titulo}}  </h4>
				<p class="card-text"></p>
				<p class="card-text"><b>Direccion: </b>{{$pelicula->direccion}}</p>
				<p class="card-text">
				<small class="text-muted"><b>Año: </b>{{$pelicula->anio}}</small>
				</p>
				<!-- Pendiente de hacerlo dinamico, para que vaya a la imagen correcta -->
				<a href="{{route('ruta.pelicula', [3])}}" class="btn btn-outline-primary btn-block">Ver más...</a>
				<a href="{{route('ruta.pelicula-mto', [3])}}" class="btn btn-outline-primary btn-block">Editar</a>
			</div>
		</div>
	@endforeach
</div>
@endsection



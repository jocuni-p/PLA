
@extends('layout')

@section('subtitle', 'Consulta de todos los vehículos')

@section('content')
{{-- DE MOMENTO, ESTE FORM DE FILTRO NO APLICA --}}
<!--div class='row animated fadeIn slow'>
    <form action="" class="d-flex justify-content-center">
        <div class="m-3">
            <label class="form-label">Buscar por título:</label>
            <input autofocus type="search" class="form-control" id="filtro"  name="filtro" value="">
        </div>
    </form>
</div-->
<hr>
<div class="row row-cols-4 d-flex justify-content-evenly">
    @forelse ($autos as $auto)
        <div class="card m-2 mb-5">
            <img class="card-img-top" src='{{ asset("img/" . ($auto->img ?? "sinportada.jpg")) }}'>
            <div class="card-body">
                <h4 class="card-title">{{ $auto->marca }}</h4>
                <p class="card-text"><b>Modelo: </b>{{ $auto->modelo }}</p>
				<p class="card-text"><b>Precio: </b>{{ $auto->precio }}</p>
                <p class="card-text"><small class="text-muted"><b>Año: </b>{{ $auto->anio }}</small></p>
				<p class="card-text"><small class="text-muted"><b>Kilometros: </b>{{ $auto->kilometros }}</small></p>
				<p class="card-text"><small class="text-muted"><b>Combustible: </b>{{ $auto->combustible }}</small></p>
                <a href="{{ route('consulta.auto', [$auto->id]) }}" class="btn btn-outline-primary btn-block">Ver más...</a>
				@auth
				<a href="{{ route('mantenimiento.auto', [$auto->id]) }}" class="btn btn-outline-primary btn-block">Editar</a>
				@endauth
			</div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No hay vehículos</p>
        </div>
    @endforelse
</div>
@endsection



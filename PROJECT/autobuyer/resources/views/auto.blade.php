@extends('layout')

@section('subtitle', 'Consulta de vehículo')

@section('content')
<div class='row animated fadeIn slow'>
    @if ($auto)
        <div class='column col-8'>
            <div class="card m-auto">
                <div class="card-body">
                    <h2 class="card-title">{{ $auto->marca ?? null }}</h2>
                    <hr>
					<h5 class="card-subtitle mb-2 text-muted">Categoría: {{$auto->categoria ?? null}}</h5>
                    <h5 class="card-subtitle mb-2 text-muted">Modelo: {{ $auto->modelo ?? null }}</h5>
					<h5 class="card-subtitle mb-2 text-muted">Precio: {{ $auto->precio ?? null }}</h5>
					<h5 class="card-subtitle mb-2 text-muted">Año: {{ $auto->anio ?? null }}</h5>
					<h5 class="card-subtitle mb-2 text-muted">Kilometros: {{ $auto->kilometros ?? null }}</h5>
                    <h5 class="card-subtitle mb-2 text-muted">Combustible: {{ $auto->combustible ?? null }}</h5>
                </div>
            </div>
            <br>
			@auth
            <a href="{{ route('mantenimiento.auto', [$auto->id]) }}" class="btn btn-outline-primary btn-block">Editar</a>
			@endauth
			<a href="{{ route('consulta.autos') }}" class="btn btn-outline-primary btn-block">Volver a listado</a>
        </div>
        <div class='column col-4'>
            <img src='{{ asset("img/" . ($auto->img ?? "sinportada.jpg")) }}'>
        </div>
    @else
        <div class="col-12 text-center">
            <h3>Vehículo no existe</h3>
            <a href="{{ route('consulta.autos') }}" class="btn btn-outline-primary mt-3">Volver a listado</a>
        </div>
    @endif
</div>
@endsection




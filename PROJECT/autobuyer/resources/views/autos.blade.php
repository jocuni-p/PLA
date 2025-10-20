
@extends('layout')

@section('subtitle', 'Consulta de todos los vehículos')

@section('content')
{{-- DE MOMENTO, ESTE FORM DE FILTRO NO APLICA --}}
<div class='row animated fadeIn slow'>
    <form action="" class="d-flex justify-content-center">
        <div class="m-3">
            <label class="form-label">Buscar por marca:</label>
            <input autofocus type="search" class="form-control" id="filtro"  name="filtro" value="">
        </div>
		<div class="m-3">
			<label class="form-label">Categoría:</label>
			<select class="form-select" name="idcategoria" onchange="this.form.submit()">
				<option value="">Todas las categorías</option>
				@foreach ($categorias as $categoria) 
					@if (($idcategoria ?? null) == $categoria->id)
						<option selected value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
					@else 
						<option value='{{$categoria->id}}'>{{$categoria->nombre}}</option> 
					@endif 
				@endforeach 
			</select>
		</div>
    </form>
</div>
<!--hr-->
<div class="row row-cols-4 d-flex justify-content-evenly">
    @forelse ($autos as $auto)
        <div class="card auto-card m-2 mb-5">
            <img class="card-img-top auto-img" src='{{ asset("img/" . ($auto->img ?? "sinportada.jpg")) }}'>
            <div class="card-body">
				<h4 class="card-text"><b>{{ $auto->marca }}</b></h4>
                <p class="card-title"><b>{{ $auto->modelo }}</b></p>
                <div class="auto-detalles">
					<p class="card-text"><small class="text-muted"><b>Año:</b> {{ $auto->anio }}</small></p>
                	<p class="card-text"><small class="text-muted"><b>Kilómetros:</b> {{ number_format($auto->kilometros,0,',','.') }}</small></p>
                	<p class="card-text"><small class="text-muted"><b>Combustible:</b> {{ $auto->combustible }}</small></p>
                </div>
                <p class="precio-auto">{{ number_format($auto->precio,0,',','.') }} €</p>
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



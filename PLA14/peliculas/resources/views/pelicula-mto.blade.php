
@extends('layout')

@section('subtitle', 'Formulario de mantenimiento')

@section('content')
<div class='row animated fadeIn slow'>
    <div class='column col-8'>
        <div class="card m-auto">
            @if (isset($pelicula))
            <form id='formulario' action="{{ route('crud.pelicula.modificacion', [old('id') ?? $pelicula->id ?? null]) }}" method="POST" enctype="multipart/form-data">
            @csrf    
			@method('PUT')
                <div class="card-body">

					<!-- Campos: titulo, direccion, anio, sinopsis, portada -->
                    <h2 class="card-title">
                        <input name='titulo' type='text' value="{{ old('titulo') ?? $pelicula->titulo ?? '' }}" class="form-control">
                    </h2>
                    <hr>
                    <h5 class="card-subtitle mb-2 text-muted">Dirección:
                        <input name='direccion' value="{{ old('direccion') ?? $pelicula->direccion ?? '' }}" class="form-control">
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted">Año:
                        <input name='anio' type='number' min='1900' max='2100' value="{{ old('anio') ?? $pelicula->anio ?? '' }}" class="form-control">
                    </h5>
                    <hr>
                    <textarea rows='8' cols='90' name='sinopsis' class="form-control">{{ old('sinopsis') ?? $pelicula->sinopsis ?? '' }}</textarea>
                    <hr>
                    <input type="file" class="form-control" name="portada" id='portada' accept='image/*'>
                    <hr>

					<!-- Botones que se convertirán en dinámicos -->
					<button type="button" class="btn btn-warning" onclick="enviarFormulario('PUT')">Modificar película</button>
					<button type="button" class="btn btn-danger" onclick="enviarFormulario('DELETE')">Baja película</button>
				</form>
				
				<a href="{{route('consulta.peliculas')}}" class="btn btn-outline-primary btn-block" style='float:right'>Volver a listado</a>
			</div>
            @else
			<div class="card-body">
				<p>Película no existe</p>
				<a href="{{route('consulta.peliculas')}}" class="btn btn-outline-primary">Volver a listado</a>
			</div>
            @endif

			<!--  Seccion para mostrar los errores de validacion, mensajes error Eloquent o mensaje de exito   -->
			@error('titulo')
				<div class="alert alert-danger" role="alert">
					{{ $message }}
				</div>
			@enderror
			@if (session('success'))
				<div class="alert alert-success">
					<p>{{ session('success') }}</p>
				</div>
			@endif

			<br>
        </div>
    </div>

	<!--   Seccion derecha con la imagen de portada     -->
    <div class='column col-4'>
        <img src='{{ asset("img/" . ($pelicula->img ?? "sinportada.jpg")) }}' alt="previsualizar" id='previsualizar'>
    </div>
</div>
<script>
function enviarFormulario(metodo) {
    // Cambiar el valor del input oculto _method a PUT o a DELETE
    document.querySelector('[name=_method]').value = metodo;

    // Cambiar la ruta del formulario según el método para que llame al controlador correcto
    const accion = (metodo === 'PUT') 
        ? "{{ route('crud.pelicula.modificacion', [$pelicula->id]) }}" 
        : "{{ route('crud.pelicula.baja', [$pelicula->id]) }}";

    document.querySelector('#formulario').setAttribute('action', accion);

    // Confirmación antes de borrar (solo si es DELETE)
    if(metodo === 'DELETE' && !confirm('¿Seguro que desea eliminar esta película?')) {
        return; // Si cancela, no se envía
    }

    // Enviar el formulario al servidor
    document.querySelector('#formulario').submit();
}
</script>

@endsection

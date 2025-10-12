
@extends('layout')

@section('subtitle', 'Formulario de mantenimiento')

@section('content')
<div class='row animated fadeIn slow'>
    <div class='column col-8'>
        <div class="card m-auto">
            @if (isset($auto))
            <form id='formulario' action="{{ route('crud.auto.modificacion', [old('id') ?? $->id ?? null]) }}" method="POST" enctype="multipart/form-data">
            @csrf    
			@method('PUT')
                <div class="card-body">

					<!-- Campos: marca, modelo, precio, año, km, combustible, portada -->
                    <h2 class="card-title">
                        <input name='marca' type='text' value="{{ old('marca') ?? $auto->marca ?? '' }}" class="form-control">
                    </h2>
                    <hr>
                    <h5 class="card-subtitle mb-2 text-muted">Modelo:
                        <input name='direccion' value="{{ old('modelo') ?? $auto->modelo ?? '' }}" class="form-control">
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted">Precio:
                        <input name='precio' value="{{ old('precio') ?? $auto->precio ?? '' }}" class="form-control">
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted">Año:
                        <input name='anio' type='number' min='2000' max='2050' value="{{ old('anio') ?? $auto->anio ?? '' }}" class="form-control">
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted">Kilometros:
                        <input name='kilometros' value="{{ old('kilometros') ?? $auto->kilometros ?? '' }}" class="form-control">
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted">Combustible:
                        <input name='combustible' value="{{ old('combustible') ?? $auto->combustible ?? '' }}" class="form-control">
                    </h5>
                    <input type="file" class="form-control" name="portada" id='portada' accept='image/*'>
                    <hr>

					<!-- Botones que se convertirán en dinámicos -->
					<button type="button" class="btn btn-warning" onclick="enviarFormulario('PUT')">Modificar vehículo</button>
					<button type="button" class="btn btn-danger" onclick="enviarFormulario('DELETE')">Baja vehículo</button>
				</form>
				
				<a href="{{route('consulta.autos')}}" class="btn btn-outline-primary btn-block" style='float:right'>Volver a listado</a>
			</div>
            @else
			<div class="card-body">
				<p>Vehículo no existe</p>
				<a href="{{route('consulta.autos')}}" class="btn btn-outline-primary">Volver a listado</a>
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
        <img src='{{ asset("img/" . ($auto->img ?? "sinportada.jpg")) }}' alt="previsualizar" id='previsualizar'>
    </div>
</div>
<script>
function enviarFormulario(metodo) {
    // Cambiar el valor del input oculto _method a PUT o a DELETE
    document.querySelector('[name=_method]').value = metodo;

    // Cambiar la ruta del formulario según el método para que llame al controlador correcto
    const accion = (metodo === 'PUT') 
        ? "{{ route('crud.auto.modificacion', [$auto->id]) }}" 
        : "{{ route('crud.auto.baja', [$auto->id]) }}";

    document.querySelector('#formulario').setAttribute('action', accion);

    // Confirmación antes de borrar (solo si es DELETE)
    if(metodo === 'DELETE' && !confirm('¿Seguro que desea eliminar este vehículo?')) {
        return; // Si cancela, no se envía
    }

    // Enviar el formulario al servidor
    document.querySelector('#formulario').submit();
}
</script>

@endsection

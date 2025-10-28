
	
@extends('layout')

@section('content')
	<h2>Mantenimiento paciente</h2>
    <br>
	<form id='formulario' method='POST' action="{{ route('mantenimiento', [old('idpaciente') ?? $paciente->idpaciente ?? null]) }}">
		@csrf
		@method('PUT')
		<!--input type="hidden" id='idpaciente' name='idpaciente'-->
		<input type="hidden" id="idpaciente" name="idpaciente" value="{{ $paciente->idpaciente ?? old('idpaciente') }}">
        <div class="mb-3">
			<label class="form-label">NIF:</label>
            <input type="text" class="form-control" id="nif"  name="nif" value="{{ old('nif') ?? $paciente->nif ?? null }}">
        </div>
        <div class="mb-3">
			<label class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre"  name="nombre" value="{{ old('nombre') ?? $paciente->nombre ?? null }}">
        </div>
        <div class="mb-3">
			<label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos"  name="apellidos" value="{{ old('apellidos') ?? $paciente->apellidos ?? null }}">
        </div>
        <div class="mb-3">
			<label class="form-label">Fecha Ingreso:</label>
            <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso" value="{{ old('fechaingreso') ?? $paciente->fechaingreso ?? null }}">
        </div>
        <div class="mb-3">
			<label class="form-label">Fecha Alta Médica:</label>
            <input type="date" class="form-control" id="fechaalta"  name="fechaalta" value="{{ old('fechaalta') ?? $paciente->fechaalta ?? null }}">
        </div>
        <br>
		<button type="button" id="modificacion" name="modificacion" class="btn btn-primary" onclick="enviarFormulario('PUT')">Modificar paciente</button>
        <button type="button" id="baja" name="baja" class="btn btn-danger" onclick="enviarFormulario('DELETE')">Baja paciente</button>
		{{-- Mensajes de validacion de la clase validator (error y/o exito) --}}
		<h4>
			@if ($errors->any())
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li> 
				@endforeach 
			</ul> 
			@else 
				<p>{{ $mensajes ?? null }}</p> 
			@endif
		</h4>
	</form>

	<script> 
		function enviarFormulario(metodo) {
		 	document.querySelector('[name=_method').value = metodo
			document.querySelector('#formulario').submit() 
		} 
	</script>
@endsection
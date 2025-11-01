@extends('layout')

@section('content')
	<h2>Consulta de pacientes</h2>

	@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
	@endif

	
    <br>
	<form action="{{ route('consultapacientes') }}" method="get">
		<div class="mb-3">
			<label class="form-label">Pacientes a mostrar:</label>
            <select class="form-select" name="mostrar" onchange="this.form.submit()">
				<option value="5"  @selected($mostrar == 5)>5</option>
				<option value="10" @selected($mostrar == 10)>10</option>
				<option value="20" @selected($mostrar == 20)>20</option>
				<option value="50" @selected($mostrar == 50)>50</option>
            </select>
        </div>
		{{-- Filtro alfabetico --}}
		<div class="mb-3">
			<label class="form-label">Buscar por apellido:</label>
			<input type="search" class="form-control" name="filtro"
			 value="{{ $filtro ?? null }}" onkeyup="this.form.submit()">
		</div> 
    </form>
    <br>
	@empty ($pacientes)
	<h4>No hay datos</h4>
	@else
	<table id='pacientes' class="table table-striped">
		<tr><th>NIF</th><th>NOMBRE</th><th>APELLIDOS</th><th></th></tr>
		@foreach ($pacientes as $paciente)
		<tr>
			<td>{{ $paciente['nif'] }}</td>
			<td>{{ $paciente['nombre'] }}</td>
			<td>{{ $paciente['apellidos'] }}</td>
			<td>
				<form action="{{ route('consultapaciente', [$paciente['idpaciente']]) }}" method='GET'>
					<input type='submit' value='Detalle paciente'>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	@endempty
@endsection
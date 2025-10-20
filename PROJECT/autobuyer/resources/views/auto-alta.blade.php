
@extends('layout')

@section('subtitle', 'Alta de vehículo')

@section('content')
@php
	// acceder correctamente a los datos del vehiculo desde la sesion
	$auto = session('success')['auto'] ?? null;
	$form_data = session('form_data') ?? [];
@endphp
<div class='row animated fadeIn slow'>
    <div class="col-8">
		<form action="{{route('crud.auto.alta')}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="marca" value ="{{ old('marca', $form_data['marca'] ?? ($auto['marca'] ?? '')) }}">
                </div>
            </div>
			<div class="row mb-3">
				<label class="col-sm-2 col-form-label">Categoría</label>
				<div class="col-sm-10">
					<select class="form-select" name="idcategoria" aria-label="Categorias">
						@foreach ($categorias as $categoria)
							<option value="{{ $categoria->id }}"
								{{ old('idcategoria', 1) == $categoria->id ? 'selected' : '' }}>
								{{ $categoria->nombre }}
							</option>
						@endforeach
					</select>
				</div> 
			</div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Modelo</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="modelo" value ="{{ old('modelo', $form_data['modelo'] ?? ($auto['modelo'] ?? '')) }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="precio" value ="{{ old('precio', $form_data['precio'] ?? ($auto['precio'] ?? '')) }}">
                </div>
            </div>
			<div class="row mb-3">
				<label class="col-sm-2 col-form-label">Año</label>
				<div class="col-sm-10">
				<input type="number" class="form-control" name="anio" value = "{{ old('anio', $form_data['anio'] ?? ($auto['anio'] ?? '')) }}">
				</div>
			</div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kilometros</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="kilometros" value ="{{ old('kilometros', $form_data['kilometros'] ?? ($auto['kilometros'] ?? '')) }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Combustible</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="combustible" value ="{{ old('combustible', $form_data['combustible'] ?? ($auto['combustible'] ?? '')) }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Imagen</label>
                <div class="col-sm-10">
					<input type="file" name="portada" id='portada' accept='image/*' onchange='previsualizar(event)'>
				</div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Alta vehículo</button>
        </form>

		<!-- Seccion de errores y mensajes -->
		<h5> 
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul> 
						@foreach ($errors->all() as $error) 
							<li>{{ $error }}</li> 
						@endforeach
						{{-- mensaje adicional para recordar lo de la portada --}}
                		<li>Si quieres una portada, selecciona una imagen.</li> 
					</ul> 
				</div>
			@endif
		</h5>
		<h5>
			@if (session('success'))
				<div class="alert alert-success">
					<p>{{session('success')['mensaje'] ?? null}}</p>
				</div>
			@endif
		</h5>

    </div>
    <div class="col-4">
    	<!-- Siempre mostrar la imagen basada en la sesión, ignorando JavaScript después del alta -->
		@php
    		$successData = session('success');
    		$imagenMostrar = 'sinportada.jpg';

    		if ($successData && isset($successData['auto']) && isset($successData['auto']['img'])) {
       			$imagenMostrar = $successData['auto']['img'];
    		}
		@endphp    
	
		<img src="{{ asset('img/' . ($auto['img'] ?? 'sinportada.jpg')) }}"
     		alt="previsualizar" 
     		id='previsualizar'>
    </div>
	{{-- DEBUG TEMPORAL - eliminar después --}}
	<!--div style="background: #f8f9fa; padding: 10px; border: 1px solid #ccc; margin: 10px 0;">
    	<h6>DEBUG Session Data:</h6>
    	<pre>@php print_r(session()->all()) @endphp</pre>
    	<p>Vehículo: @php var_dump($auto) @endphp</p>
	</div-->
</div>
@endsection



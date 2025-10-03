
@extends('layout')

@section('subtitle', 'Alta de pelicula')

@section('content')
@php
	// acceder correctamente a los datos de la pelicula desde la sesion
	$pelicula = session('success')['pelicula'] ?? null;
	$form_data = session('form_data') ?? [];
@endphp
<div class='row animated fadeIn slow'>
    <div class="col-8">
		<form action="{{route('crud.pelicula.alta')}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Título</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" value ="{{ old('titulo', $form_data['titulo'] ?? ($pelicula['titulo'] ?? '')) }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Dirección</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="direccion" value = "{{ old('direccion', $form_data['direccion'] ?? ($pelicula['direccion'] ?? '')) }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Año</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="anio" value = "{{ old('anio', $form_data['anio'] ?? ($pelicula['anio'] ?? '')) }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Portada</label>
                <div class="col-sm-10">
					<input type="file" name="portada" id='portada' accept='image/*' onchange='previsualizar(event)'>
				</div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Sinopsis</label>
                <div class="col-sm-10">
				<textarea class="form-control" name="sinopsis" rows="5">{{ old('sinopsis', $form_data['sinopsis'] ?? ($pelicula['sinopsis'] ??'')) }}</textarea>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Alta película</button>
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

    		if ($successData && isset($successData['pelicula']) && isset($successData['pelicula']['img'])) {
       			$imagenMostrar = $successData['pelicula']['img'];
    		}
		@endphp    
	
		<img src="{{ asset('img/' . ($pelicula['img'] ?? 'sinportada.jpg')) }}"
     		alt="previsualizar" 
     		id='previsualizar'>
    </div>
	{{-- DEBUG TEMPORAL - eliminar después --}}
	<!--div style="background: #f8f9fa; padding: 10px; border: 1px solid #ccc; margin: 10px 0;">
    	<h6>DEBUG Session Data:</h6>
    	<pre>@php print_r(session()->all()) @endphp</pre>
    	<p>Película: @php var_dump($pelicula) @endphp</p>
	</div-->
</div>
@endsection



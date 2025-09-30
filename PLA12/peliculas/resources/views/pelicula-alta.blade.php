
@extends('layout')

@section('subtitle', 'Alta de pelicula')

@section('content')
<div class='row animated fadeIn slow'>
    <div class="col-8">
        <!--form action="" method='post' enctype="multipart/form-data"-->
		<form action="{{route('crud.pelicula.alta')}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Título</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" value = "{{old('titulo') ?? $pelicula->titulo ?? null}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Dirección</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="direccion" value = "{{old('direccion') ?? $pelicula->direccion ?? null}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Año</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="anio" value = "{{old('anio') ?? $pelicula->anio ?? null}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Portada</label>
                <div class="col-sm-10">
                <!--input type="file" class="form-control" name="portada" id='portada' accept='image/*'-->
				<input type="file" name="portada" id='portada' accept='image/*' onchange='previsualizar(event)'>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Sinopsis</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="sinopsis" rows="5"></textarea>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Alta película</button>
        </form>
		<h5> 
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul> 
						@foreach ($errors->all() as $error) 
							<li>{{ $error }}</li> 
						@endforeach 
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
        <!--img src='{{ asset("img/sinportada.jpg") }}' alt="previsualizar" id='previsualizar'-->
		@if (isset($pelicula))
			<img src='{{asset("img/$pelicula->img")}}' alt="previsualizar" id='previsualizar'>
		@else
			<img src='{{asset("img/sinportada.jpg")}}' alt="previsualizar" id='previsualizar'>
		@endif
    </div>
</div>
@endsection



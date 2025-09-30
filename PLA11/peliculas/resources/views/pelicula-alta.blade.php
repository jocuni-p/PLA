
@extends('layout')

@section('subtitle', 'Alta de pelicula')

@section('content')
<div class='row animated fadeIn slow'>
    <div class='column col-8'>
        <!--form action="" method='post' enctype="multipart/form-data"-->
		<form action="{{route('crud.pelicula.alta')}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Título</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Dirección</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="direccion">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Año</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="anio">
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
    </div>
    <div class='column col-4'>
        <img src='{{ asset("img/sinportada.jpg") }}' alt="previsualizar" id='previsualizar'>
    </div>
</div>
@endsection



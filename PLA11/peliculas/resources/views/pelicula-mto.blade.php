
@extends('layout')

@section('subtitle', 'Formulario de mantenimiento')

@section('content')
<div class='row animated fadeIn slow'>
    <div class='column col-8'>
        <div class="card m-auto">
            <form id='formulario' action="" method="post"  enctype="multipart/form-data">
                <div class="card-body">
                    <h2 class="card-title">
                        <input name='titulo' type='text' value="">
                    </h2>
                    <hr>
                    <h5 class="card-subtitle mb-2 text-muted">Dirección:
                        <input name='direccion' value="">
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted">Año:
                        <input name='anio' type='number' min='1900' max='2100' value="">
                    </h5>
                    <hr>
                    <textarea rows='8' cols='90' name='sinopsis'></textarea>
                    <hr>
                    <input type="file" class="form-control" name="portada" id='portada' accept='image/*'>
                    <hr>
                    <button type="button" class="btn btn-warning">Modificar película</button>
                    <button type="button" class="btn btn-danger">Baja película</button>
                    <a href="/peliculas" class="btn btn-outline-primary btn-block" style='float:right'>Volver a listado</a>
                </div>
            </form>
            <br>
        </div>
    </div>
    <div class='column col-4'>
        <img src='{{asset("img/sinportada.jpg")}}' alt="previsualizar" id='previsualizar'>
    </div>
</div>
@endsection

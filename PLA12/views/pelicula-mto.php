<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
</head>
<body>
    <main class='animated fadeIn slow'>
        <h1 class="text-center">Películas</h1>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="">Lista de películas</a>
                        <a class="nav-link" href="">Alta película</a>
                    </div>
                </div>
            </div>
        </nav>
        <h4 class='text-center'>Título de la sección</h4>
        <hr>
        <section id='contenido'>
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
                    <img src='{{asset("img/abyss.jpg")}}' alt="previsualizar" id='previsualizar'>
                </div>
            </div>
        </section>
        <hr>
        <footer>
            <p>&copy; 2023</p>
        </footer>
    </main>
</body>
</html>


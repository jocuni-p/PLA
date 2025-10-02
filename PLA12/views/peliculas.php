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
                <form action="" class="d-flex justify-content-center">
                    <div class="m-3">
                        <label class="form-label">Buscar por título:</label>
                        <input autofocus type="search" class="form-control" id="filtro"  name="filtro" value="">
                    </div>
                </form>
            </div>
            <hr>
            <div class="row row-cols-4 d-flex justify-content-evenly">
                <div class="card m-2 mb-5">
                    <img class="card-img-top" src='{{asset("img/abyss.jpg")}}'>
                    <div class="card-body">
                        <h4 class="card-title">título película</h4>
                        <p class="card-text"></p>
                        <p class="card-text">Dirección: </p>
                        <p class="card-text">
                        <small class="text-muted">Año: </small>
                        </p>
                        <a href="" class="btn btn-outline-primary btn-block">Ver más...</a>
                        <a href="" class="btn btn-outline-primary btn-block">Mantenimiento</a>
                    </div>
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



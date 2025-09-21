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
                    <form action="" method='post' enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="titulo" value = "">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Dirección</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="direccion" value = "">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Año</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="anio" value = "">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Portada</label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control" name="portada" id='portada' value = "" accept='image/*'>
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


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/hospital.css') }}">
</head>
<body>
<div class="container">
	<header>
		<h1 id="title">HOSPITAL</h1>
	</header>
    <div class='flex'>
        <nav class="navbar bg-body-secondary">
            <h3>Menu opciones:</h3>
            <br>
            <a class="navbar-brand" href="{{ route('vistas.consulta') }}">Consulta pacientes</a>
            <a class="navbar-brand" href="{{ route('vistas.alta') }}">Alta paciente</a>
            <!--a class="navbar-brand" href="{{ route('vistas.mantenimiento') }}">Baja/modificación paciente</a-->
        {{-- <a class="navbar-brand" href="#">Consulta usuarios</a> --}}

            <hr>
			{{-- De momento elimino estos enlaces que no uso
            <a class="navbar-brand" href="#">Registro usuarios</a>
            <a class="navbar-brand" href="#">Login usuario</a>
            
            <form method="POST" action="#">
				@csrf
                <a class="navbar-brand" href='#'>Logout</a>
            </form>

            <p>nombre apellidos</p>
            <img class="fotousuario" src="assets/img/sinfoto.jpg">
			--}}
        </nav>

        <section id='contenido'>
            <div>
                @yield('content')
            </div>
        </section>
    </div>
</div>
</body>
</html>

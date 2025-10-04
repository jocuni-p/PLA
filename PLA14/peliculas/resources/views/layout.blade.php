<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
	<main class='animated fadeIn slow'>
		<h1 class="text-center">Películas</h1>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-3">
			<div class="container-fluid">
				<a class="navbar-brand" href="{{route('inicio')}}">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
                </button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">

					{{-- Enlaces de navegación a la izquierda --}}
					<div class="navbar-nav me-auto">
						<a class="nav-link" href="{{ route('consulta.peliculas') }}">Lista de películas</a>
						@auth
							<a class="nav-link" href="{{ route('alta.pelicula') }}">Alta película</a>
						@endauth
					</div>

					{{-- Zona derecha: login / usuario --}}
					<!--div class="d-flex align-items-center">
						@guest
							<a class="nav-link" href="{{ route('vista.login') }}">Login</a>
							<span>SOY UN INVITADO</span>
							@endguest
						@auth
							<span class="navbar-text text-white ms-2">
								{{ Auth::user()->nombre }}
							</span>
						@endauth
                    </div-->
					<!-- A la derecha -->
					<div class="navbar-nav ms-auto">
						@guest
							<a class="nav-link" href="{{route('vista.login')}}">Login</a>
						@endguest

						@auth
							<span class="navbar-text text-white me-2">{{ Auth::user()->nombre }}</span>
							<a class="nav-link" href="{{ route('logout') }}">Logout</a>
						@endauth
					</div>
                </div>
            </div>
        </nav>
		<h4 class="text-center">
			<!--Acepto las dos formas de pasar datos $datos['pagina'] o @section('subtitle')  -->
		    @isset($pagina)
			{{ $pagina }}
		    @else
			@yield('subtitle')
		    @endisset
		</h4>
        <hr>
        <section id='contenido'>
			@yield('content')
        </section>
        <hr>
        <footer>
			<p>&copy; 2025</p>
        </footer>
    </main>
	<script src="{{ asset('js/previsualizar.js') }}"></script>
</body>
</html>

<?php
	session_start(); // inicio sesion para acceder a la var global de la session
	
	 //Recuperamos 'personas', mensajes y errores
	$personas = $_SESSION['personas'] ?? [];
	$errores = $_SESSION['errores'] ?? [];
	$msg = $_SESSION['msg'] ?? null;

	//Recuperamos valores del formulario si se han enviado
	$nif = $_SESSION['nif'] ?? null;
	$nombre = $_SESSION['nombre'] ?? null;
	$direccion = $_SESSION['direccion'] ?? null;
	
	//Ordena por clave el array de personas
	ksort($personas);

?>
<html>
<head>
	<title>PLA03</title>
	<meta charset='UTF-8'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<main>
		<!--FORMULARIO ALTAPERSONA-->
		<h1 class='centrar'>PLA03: MANTENIMIENTO PERSONAS</h1>
		<br>
		<form method='post' action='servicios/alta_persona.php'>
		  <div class="row mb-3">
		    <label for="nif" class="col-sm-2 col-form-label">Nif</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="nif" name='nif' value="<?= $nif ?? null; ?>">
		    </div>
		  </div>
		  <div class="row mb-3">
		    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre ?? null; ?>">
		    </div>
		  </div>
		  <div class="row mb-3">
		    <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $direccion ?? null; ?>">
		    </div>
		  </div>
		  <label for="nombre" class="col-sm-2 col-form-label"></label>
		  <button type="submit" class="btn btn-success" name='alta'>Alta persona</button>
		  <span><?php echo $msg ?? null; ?></span>
		  <br></br>
		    <!-- Muestra los errores de alta_persona -->
			<?php if (!empty($errores)): ?>
				<?php foreach ($errores as $e): ?>
					<li><?= $e ?></li>
				<?php endforeach; ?>
			<?php endif; ?>
		</form><br>
		<!--TABLA CON LA LISTA DE PERSONAS-->
		<table class="table table-striped">
			<tr class='table-dark'>
				<th scope="col">NIF</th>
				<th scope="col">Nombre</th>
				<th scope="col">Dirección</th>
				<th scope="col"></th>
			</tr>
			<?php 
				foreach ($personas as $nif => $datos): // itera el array 'personas'
			?>
				<tr>
					<td class='nif'><?= $nif; ?></td>
					<td><input type='text' value='<?= $datos['nombre'] ?>' class='nombre'></td>
					<td><input type='text' value='<?= $datos['direccion'] ?>' class='direccion'></td>
					<td>
						<!--BOTON DE BAJA PERSONA-->
						<form method='post' action='servicios/baja_persona.php'>
							<input type='hidden' name='nifBaja' value= '<?= $nif ?>'>
							<button type="submit" class="btn btn-warning" name='bajaPersona'>Baja</button>
						</form>
						<!--BOTON MODIFICAR PERSONA tiene asociado un evento 'onclick' de JavaScrpit-->
						<button onclick="trasladarDatos(event)" type="button" class="btn btn-primary modificar" name='modiPersona'>Modificar</button>
					</td>
				</tr>
			<?php endforeach; ?>  
		</table>
		<!--BOTON BAJAPERSONAS -->
		<form method='post' action='servicios/baja_personas.php' id='formularioBaja'>
			<input type='hidden' id='baja' name='baja'></input>
			<button type="submit" class="btn btn-danger" id='baja' name='baja'>Baja personas</button>
		</form>
		<!--FORMULARIO OCULTO PARA LA MODIFICACION -->
		<form method='post' action='servicios/modificacion_persona.php' id='formularioModi'>
			<input type='hidden' name='nifModi' id='nifModi'>
			<input type='hidden' name='nombreModi' id='nombreModi'>
			<input type='hidden' name="direccionModi" id='direccionModi'>
			<input type='hidden' name='modificar'>
		</form>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src='js/scripts.js'></script>
</body>
</html>
<?php
	// DEBUGGER
	echo '<pre>';  // Formatea la salida para mejor legibilidad
	print_r($_SESSION);
	echo '</pre>';
?>
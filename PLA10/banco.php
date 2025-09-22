<?php 

	//=======VISTA=======

	//===DEBUG===
	error_reporting(E_ALL);
	ini_set('display_errors', 1);


	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	
	//recuperamos al array con los datos de la persona a mostrar en el formulario
	if (isset($_SESSION['datosbanco'])) {
		extract($_SESSION['datosbanco']);
//		$datospersona = $_SESSION['datosbanco'];
	}
	
	//recuperamos info de la paginacion de la tabla
	if (isset($_SESSION['paginacion'])) {
		extract($_SESSION['paginacion']);
	}
	
	//recuperamos el array de personas para construir dinamicamente la tabla
	$personas = $_SESSION['personasbanco'] ?? [];
	

?>
<html>
<head>
	<title>Banco</title>
	<meta charset='UTF-8'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
</head>
<body>
	<div class='container'>
		<form id='formulario' method='post' action='servicios/controladores/frontcontroller.php'>
			<input type='hidden' id='idpersona' name='idpersona' value='<?=$datospersona['idpersona'] ?? '';?>'>
			<div class="row mb-3">
			    <label for="nif" class="col-sm-2 col-form-label">NIF</label>
			    <div class="col-sm-10">
				  <input type="text" class="form-control" id="nif" name='nif' value='<?=$datospersona['nif'] ?? null;?>'>
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
			    <div class="col-sm-10">
				  <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$datospersona['nombre'] ?? null;?>">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
			    <div class="col-sm-10">
				  <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?=$datospersona['apellidos'] ?? null;?>">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
			    <div class="col-sm-10">
				  <input type="text" class="form-control" id="direccion" name="direccion" value="<?=$datospersona['direccion'] ?? null;?>">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
			    <div class="col-sm-10">
				  <input type="text" class="form-control" id="telefono" name="telefono" value="<?=$datospersona['telefono'] ?? null;?>">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="email" class="col-sm-2 col-form-label">Email</label>
			    <div class="col-sm-10">
				  <input type="email" class="form-control" id="email" name="email" value="<?=$datospersona['email'] ?? null;?>">
			    </div>
			</div>
			<label class="col-sm-2 col-form-label"></label>
			<button type="submit" class="btn btn-success" id='alta' name='peticion'  value='alta'>Alta</button>
			<button type="submit" class="btn btn-warning" id='modificacion' name='peticion' value='modificacion'>Modificación</button>
			<button type="submit" class="btn btn-danger" id='baja' name='peticion'  value='baja'>Baja</button>
<!--			<button type="reset" class="btn btn-success">Limpiar</button>   -->
			<a href="index.php" class="btn btn-success">Limpiar</a>
			<label class="col-sm-2 col-form-label"></label>
			<hr>
			<p class='mensajes'><?=$mensajes ?? null;?></p> <!-- para visualizar los msgs del controlador -->
 		</form><br><br>
			<form method='get' action='servicios/controladores/frontcontroller.php' class="d-flex justify-content-center">
			<div class="row col-4 mb-3">
			    <label class="form-label">Personas a mostrar</label>
			    <select class="form-select" name='mostrar' onchange="this.form.submit()">
					<option <?php if ($mostrar == 5) {echo 'selected';}?>>5</option>
					<option <?php if ($mostrar == 10) {echo 'selected';}?>>10</option>
					<option <?php if ($mostrar == 15) {echo 'selected';}?>>15</option>
					<option <?php if ($mostrar == 20) {echo 'selected';}?>>20</option>
			    </select>
			</div>
		</form>
		<table id='listapersonas' class="table table-striped">
			<tr class='table-dark'><th>NIF</th><th>Nombre</th><th>Apellidos</th></tr>
			<?php if (!empty($personas)): ?>
				<?php foreach ($personas as $persona): ?>
					<tr data-id='<?= $persona['idpersona'] ?? '' ?>' >
						<td><?= htmlspecialchars($persona['nif'] ?? '') ?></td>
						<td><?= htmlspecialchars($persona['nombre'] ?? '') ?></td>
						<td><?= htmlspecialchars($persona['apellidos'] ?? '') ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr><td colspan="3" class="text-center">No hay datos</td></tr>
			<?php endif; ?>
		</table>
		<div class="enlaces d-flex justify-content-center">
			<p>
			<?php
				for ($e = 1; $e <= $enlaces; $e++) {
					if ($e == $pagina) {
						echo "<a class='resaltar' href='servicios/controladores/frontcontroller.php?pagina=$e&mostrar=$mostrar'>$e</a> ";
					} else {
						echo "<a href='servicios/controladores/frontcontroller.php?pagina=$e&mostrar=$mostrar'>$e</a> ";
					}
				}
			?>
			</p>
		</div>
	</div>
	</div>
<!-- Formulario oculto para saber en que fila de la tabla hemos hecho click-->
	<form id='formconsulta' method='post' action="servicios/controladores/frontcontroller.php">
		<input type='hidden' name='peticion' value='consulta'>
		<input type='hidden' id='consulta' name='idpersona'>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src='assets/scripts/script.js'></script>
</body>
</html>

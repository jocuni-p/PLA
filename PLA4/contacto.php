<?php
	require_once("config_idioma.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>IEM</title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="css/page.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script src="js/page.js" type="text/javascript"></script>
	<script type="text/javascript" src='js/variables_<?=$idioma?>.js'></script>
	<script src="js/form.js" type="text/javascript"></script>
</head>
<body>
	<header>
		<?php
			require('content_secciones/content_header.php');
		?>
		<a href="?idioma=es">ES</a> | <a href="?idioma=ca">CA</a>
	</header><br>
	<div class="wraper">
		<nav>
			<?php
				require('content_secciones/content_nav.php');
			?>
		</nav>
		<div class="content">
			<div class="slider" >
				<img src="img/iem_3.jpg" /><img src="img/iem_4.jpg" />
		    </div>
		    <div class="sections">
		    	<h1 style="text-align:center"><?=$contacto_titulo_1?></h1><br><br>
		    	<div class="contacto">
					<h2><?=$contacto_titulo_1?></h2>
					<p><?=$c_3?></p><br>
					<form id="form" name="form" method="get" action='#'>
						<label for="nombre"><?=$c_4?></label><input type="text" name="nombre" autofocus id="nombre" /><br><br>
						<label for="email"><?=$c_5?></label><input type="email" name="email" id="email" placeholder="<?=$c_5_1?>" /><br><br>
						<label for="telefono"><?=$c_6?></label><input type="tel" name="telefono" id="telefono"><br><br>
						<label><?=$c_7?></label><br><br>
						<textarea id="mensaje" name="mensaje" placeholder="<?=$c_8?>" ></textarea><br><br>
						<span><?=$c_9?></span><br><br>
						<input id="privacidad" type="checkbox" name="privacidad">&nbsp&nbsp
						<span id='ver' onclick="muestraAlert()"><?=$c_10?></span><br><br>
						<input id="enviar" type="button" name="enviar" value="<?=$c_11?>" onclick="validaFormulario()"/><br>
					</form>
					<div id="alerta">
						<span id="alertatext"><?=$c_10_1?><br><br>
						<input type="button" onclick="ocultaAlert()"/>
					</div>
				</div>
		    </div>
		    <br><br>
		</div>
	
		<footer>
			<?php
				require('content_secciones/content_footer.php');
			?>
		</footer>
	</div>
</body>
</html> 

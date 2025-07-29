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
			<div class="slider">
				<img src="img/iem_1.jpg" /><img src="img/iem_2.jpg" />
			</div>
			<?php
				$fichero_html ="content_secciones/contenido_index_$idioma.html";
				if (file_exists($fichero_html)) {
					readfile($fichero_html);
				} else {
					echo "<p>Contenido no disponible en este idioma.</p>";
				}
			?>
		    <br><br>
		</div>
		<footer>
				<?php
					require('content_secciones/content_footer.php');
				?>
			</ul>
		</footer>
	</div>
</body>
</html> 

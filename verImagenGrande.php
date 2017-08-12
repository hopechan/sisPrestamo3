<html>
	<head>
	</head>
	<body>
		<?php
			$dui = $_GET['dui'];
			$correlativo = $_GET['correlativo'];
			echo '<img width="100%" src="verImagen.php?dui=' . $dui .'&correlativo=' . $correlativo . '"/>';
		?>
	</body>
</html>
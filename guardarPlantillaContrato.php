<?php
$file = fopen('plantillaContrato.txt', 'w');

$plantillaContrato = $_POST['plantillaContrato'];

fwrite($file, $plantillaContrato);

header('Location: webParametros.php');
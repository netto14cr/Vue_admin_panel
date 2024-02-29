<?php
include 'funciones_talla.php'; // Reemplaza con la ruta correcta a tu archivo PHP
$letra = $_GET['letra'];
$genero = $_GET['genero'];
echo obtenerNombreCompletoTalla($letra, $genero);
?>

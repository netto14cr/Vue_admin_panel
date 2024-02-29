<?php
// Archivo: ajax_obtener_sugerencias_tallas.php

// Incluir tus funciones y lógica necesaria
include_once 'funciones_talla.php';

// Obtener el género de la solicitud GET
$genero = isset($_GET['genero']) ? $_GET['genero'] : 'unisex';

// Obtener sugerencias de tallas según el género
$sugerenciasTallas = obtenerSugerenciasTallasPorGenero($genero);

// Devolver las sugerencias en formato JSON
header('Content-Type: application/json');
echo json_encode($sugerenciasTallas);
?>

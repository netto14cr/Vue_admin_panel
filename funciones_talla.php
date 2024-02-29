<?php
// Función para obtener los géneros disponibles
function obtenerGenerosDisponibles()
{
    // Lógica para obtener los géneros sugeridos
    // Puedes adaptar esta función según tus necesidades
    $generos = array('Unisex', 'Mujer', 'Hombre', 'Niños', 'Bebé');
    return $generos;
}


function obtenerSugerenciasTallasPorGenero($genero = 'unisex')
{
    $tallas = array(
        'unisex' => array(
            'XS' => 'Extra Small',
            'S' => 'Small',
            'M' => 'Medium',
            'L' => 'Large',
            'XL' => 'Extra Large',
            'XXL' => 'Double Extra Large',
            '3XL' => 'Triple Extra Large',
        ),
        'mujer' => array(
            'XS' => 'Extra Small (Mujer)',
            'S' => 'Small (Mujer)',
            'M' => 'Medium (Mujer)',
            'L' => 'Large (Mujer)',
            'XL' => 'Extra Large (Mujer)',
        ),
        'hombre' => array(
            'XS' => 'Extra Small (Hombre)',
            'S' => 'Small (Hombre)',
            'M' => 'Medium (Hombre)',
            'L' => 'Large (Hombre)',
            'XL' => 'Extra Large (Hombre)',
            'XXL' => 'Double Extra Large (Hombre)',
            '3XL' => 'Triple Extra Large (Hombre)',
        ),
        'niños' => array(
            '2T' => '2T (Niño)',
            '3T' => '3T (Niño)',
            '4T' => '4T (Niño)',
            '5T' => '5T (Niño)',
        ),
        'bebe' => array(
            'NB' => 'Recién Nacido',
            '0-3M' => '0-3 Meses',
            '3-6M' => '3-6 Meses',
            '6-9M' => '6-9 Meses',
            '9-12M' => '9-12 Meses',
        ),
    );

    $genero = strtolower($genero);

    return isset($tallas[$genero]) ? $tallas[$genero] : array();
}






function obtenerNombreCompletoTalla($abreviatura, $categoria = 'unisex')
{
    $tallas = array(
        'unisex' => array(
            'XS' => 'Extra Small',
            'S' => 'Small',
            'M' => 'Medium',
            'L' => 'Large',
            'XL' => 'Extra Large',
            'XXL' => 'Double Extra Large',
            '3XL' => 'Triple Extra Large',
        ),
        'mujer' => array(
            'XS' => 'Extra Small (Mujer)',
            'S' => 'Small (Mujer)',
            'M' => 'Medium (Mujer)',
            'L' => 'Large (Mujer)',
            'XL' => 'Extra Large (Mujer)',
        ),
        'hombre' => array(
            'XS' => 'Extra Small (Hombre)',
            'S' => 'Small (Hombre)',
            'M' => 'Medium (Hombre)',
            'L' => 'Large (Hombre)',
            'XL' => 'Extra Large (Hombre)',
            'XXL' => 'Double Extra Large (Hombre)',
            '3XL' => 'Triple Extra Large (Hombre)',
        ),
        'niños' => array(
            '2T' => '2T (Niño)',
            '3T' => '3T (Niño)',
            '4T' => '4T (Niño)',
            '5T' => '5T (Niño)',
        ),
        'bebe' => array(
            'NB' => 'Recién Nacido',
            '0-3M' => '0-3 Meses',
            '3-6M' => '3-6 Meses',
            '6-9M' => '6-9 Meses',
            '9-12M' => '9-12 Meses',
        ),
    );

    $abreviatura = strtoupper($abreviatura);

    // Obtener el género asociado a la categoría
    $genero = obtenerGeneroPorCategoria($categoria);

    return isset($tallas[$genero][$abreviatura]) ? $tallas[$genero][$abreviatura] : 'Desconocido';
}

function obtenerGeneroPorCategoria($categoria)
{
    // Mapear las categorías a géneros
    $categoriasGenero = array(
        'unisex' => 'unisex',
        'mujer' => 'mujer',
        'hombre' => 'hombre',
        'niños' => 'niños',
        'bebe' => 'unisex', // Asignar un género predeterminado para la categoría 'bebe'
    );

    return isset($categoriasGenero[strtolower($categoria)]) ? $categoriasGenero[strtolower($categoria)] : 'unisex';
}
?>

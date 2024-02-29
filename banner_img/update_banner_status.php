<?php
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del banner y el estado del interruptor del POST
    $bannerId = $_POST["bannerId"];
    $isChecked = $_POST["isChecked"];

    // Depuración: Mostrar valores
    echo 'Banner ID: ' . $bannerId . '<br><br><br>';
    echo 'El valor que llego es: ' . $isChecked . '<br><br><br>';

    // Intentar establecer la conexión y preparar la consulta
    $updateBannerQuery = "UPDATE banner SET active = ? WHERE banner_id = ?";
    $stmt = mysqli_prepare($con, $updateBannerQuery);

    if ($stmt !== false) {
        // Cambio en la comparación para tener en cuenta la conversión de tipos
        $isChecked = ($isChecked == "true") ? 1 : 0;

        // Vincular los valores y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "ii", $isChecked, $bannerId);
        mysqli_stmt_execute($stmt);

        // Mostrar mensaje de éxito si todo está bien
        echo 'Estado del banner actualizado correctamente';
    } else {
        // Mostrar mensaje de error si hay problemas con la preparación de la consulta
        echo 'Error en la preparación de la consulta';
    }
} else {
    // Mostrar mensaje de error si la solicitud no es de tipo POST
    echo 'Solicitud no válida';
}
?>

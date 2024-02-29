<?php

// Verificar la sesión del administrador
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    // Verificar si se está solicitando la eliminación de un color
    if (isset($_GET['delete_color'])) {
        $delete_id = $_GET['delete_color'];

        // Sentencia SQL corregida para eliminar el color y manejar la clave foránea
        $delete_cat = "DELETE FROM colors WHERE color_id = '$delete_id'";

        $run_delete = mysqli_query($con, $delete_cat);

        // Verificar si la eliminación fue exitosa
        if ($run_delete) {
            echo "<script>alert('One Color Has Been Deleted')</script>";
        } else {
            // Manejar el caso en que la eliminación es denegada debido a la clave foránea
            echo "<script>alert('Error: No se puede borrar este color debido a restricciones de clave foránea')</script>";
        }

        echo "<script>window.open('index.php?view_colors','_self')</script>";
    }
}

?>

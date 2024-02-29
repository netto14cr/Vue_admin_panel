<?php


    // Verificar si se está solicitando la eliminación de un tamaño
    if (isset($_GET['delete_size'])) {
        $delete_id = $_GET['delete_size'];

        // Sentencia SQL para eliminar el tamaño
        $delete_size = "DELETE FROM sizes WHERE size_id = '$delete_id'";

        $run_delete = mysqli_query($con, $delete_size);

        // Verificar si la eliminación fue exitosa
        if ($run_delete) {
            echo "<script>alert('One Size Has Been Deleted')</script>";
        } else {
            // Manejar el caso en que la eliminación es denegada debido a restricciones de clave foránea
            echo "<script>alert('Error: No se puede borrar este tamaño debido a restricciones de clave foránea')</script>";
        }
        echo "<script>window.open('index.php?view_sizes','_self')</script>";
}

?>

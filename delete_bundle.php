<?php
if (isset($_GET['delete_bundle'])) {
    $delete_id = $_GET['delete_bundle'];

    // Inicializa la variable de control
    $operacionesExitosas = true;

    // Intenta eliminar de la tabla stock_by_size_and_color
    $delete_stocks_rel = "DELETE FROM stock_by_size_and_color WHERE product_id='$delete_id'";
    $run_delete_stocks_rel = mysqli_query($con, $delete_stocks_rel);

    // Verifica si la eliminación fue exitosa
    if (!$run_delete_stocks_rel) {
        $operacionesExitosas = false;
        echo "<script>alert('Error: No se puede borrar este tamaño debido a restricciones de clave foránea en stock_by_size_and_color')</script>";
    }

    // Si la primera operación fue exitosa, intenta eliminar de la tabla products
    if ($operacionesExitosas) {
        $delete_pro = "DELETE FROM products WHERE product_id='$delete_id'";
        $run_delete = mysqli_query($con, $delete_pro);

        // Verifica si la eliminación fue exitosa
        if (!$run_delete) {
            $operacionesExitosas = false;
            echo "<script>alert('Error: No se puede borrar este tamaño debido a restricciones de clave foránea en products')</script>";
        }
    }

    // Si las dos operaciones anteriores fueron exitosas, intenta eliminar de la tabla bundle_product_relation
    if ($operacionesExitosas) {
        $delete_rel = "DELETE FROM bundle_product_relation WHERE bundle_id='$delete_id'";
        $run_rel = mysqli_query($con, $delete_rel);

        // Verifica si la eliminación fue exitosa
        if (!$run_rel) {
            $operacionesExitosas = false;
            echo "<script>alert('Error: No se puede borrar este tamaño debido a restricciones de clave foránea en bundle_product_relation')</script>";
        }
    }

    // Redirección solo si todas las operaciones fueron exitosas
    if ($operacionesExitosas) {
        echo "<script>alert('One Bundle Has been deleted')</script>";
    }
    echo "<script>window.open('index.php?view_bundles','_self')</script>";
}
?>

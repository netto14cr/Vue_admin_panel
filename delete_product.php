<?php

if (isset($_GET['delete_product'])) {
    $delete_id = $_GET['delete_product'];

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

    // Intenta eliminar de la tabla products
    $delete_pro = "DELETE FROM products WHERE product_id='$delete_id'";
    $run_delete = mysqli_query($con, $delete_pro);


    // Verifica si la eliminación fue exitosa
    if (!$run_delete) {
        $operacionesExitosas = false;
        echo "<script>alert('Error: No se puede borrar este tamaño debido a restricciones de clave foránea en products')</script>";
    }

    // Redirección solo si la operación fue exitosa
    if ($operacionesExitosas) {
        echo "<script>alert('One Product Has been deleted')</script>";
    }
    echo "<script>window.open('index.php?view_products','_self')</script>";
}
?>

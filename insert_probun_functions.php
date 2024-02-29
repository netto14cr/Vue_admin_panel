
<?php
function consultarCategorias($con) {
    $get_cat = "SELECT * FROM categories ";
    $run_cat = mysqli_query($con, $get_cat);

    $options = "";
    while ($row_cat = mysqli_fetch_array($run_cat)) {
        $cat_id = $row_cat['cat_id'];
        $cat_title = $row_cat['cat_title'];
        $options .= "<option value='$cat_id'>$cat_title</option>";
    }

    return $options;
}

function consultarManufacturers($con) {
    $get_manufacturer = "SELECT * FROM manufacturers ";
    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    $options = "";
    while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
        $manufacturer_id = $row_manufacturer['manufacturer_id'];
        $manufacturer_title = $row_manufacturer['manufacturer_title'];
        $options .= "<option value='$manufacturer_id'>$manufacturer_title</option>";
    }

    return $options;
}

function consultarProductCategories($con) {
    $get_p_cat = "SELECT * FROM product_categories ";
    $run_p_cat = mysqli_query($con, $get_p_cat);

    $options = "";
    while ($row_p_cat = mysqli_fetch_array($run_p_cat)) {
        $p_cat_id = $row_p_cat['p_cat_id'];
        $p_cat_title = $row_p_cat['p_cat_title'];
        $options .= "<option value='$p_cat_id'>$p_cat_title</option>";
    }

    return $options;
}


function obtenerColores($con) {
    $get_colors_query = "SELECT color_id, color_name, color_rgb FROM colors";
    $run_colors = mysqli_query($con, $get_colors_query);

    $options = "";
    while ($row_color = mysqli_fetch_array($run_colors)) {
        $color_id = $row_color['color_id'];
        $color_name = $row_color['color_name'];
        $color_rgb = $row_color['color_rgb'];
        $options .= "<option value='$color_id'>$color_name | $color_rgb</option>";
    }

    return $options;
}

function obtenerTallas($con) {
    $get_sizes_query = "SELECT size_id, size_name FROM sizes";
    $run_sizes = mysqli_query($con, $get_sizes_query);

    $options = "";
    while ($row_size = mysqli_fetch_array($run_sizes)) {
        $size_id = $row_size['size_id'];
        $size_name = $row_size['size_name'];
        $options .= "<option value='$size_id'>$size_name</option>";
    }

    return $options;
}


function insertTallasColoresCantidad($con) {
    // Obtener el ID del producto recién insertado
    $last_inserted_id = mysqli_insert_id($con);

// Insertar tallas, colores y cantidades en la tabla stock_by_size_and_color
    if (!empty($_POST['sizes']) && !empty($_POST['colors']) && !empty($_POST['quantities'])) {
        $sizes = $_POST['sizes'];
        $colors = $_POST['colors'];
        $quantities = $_POST['quantities'];

        // Verificar que los arrays tengan la misma longitud
        if (count($sizes) == count($colors) && count($colors) == count($quantities)) {
            $insert_query = "INSERT INTO stock_by_size_and_color (product_id, size_id, color_id, quantity_available) VALUES (?, ?, ?, ?)";

            $stmt_insert = $con->prepare($insert_query);

            // Bucle para insertar cada combinación de talla, color y cantidad
            for ($i = 0; $i < count($sizes); $i++) {
                $size_id = $sizes[$i];
                $color_id = $colors[$i];
                $quantity = $quantities[$i];

                $stmt_insert->bind_param('ssss', $last_inserted_id, $size_id, $color_id, $quantity);
                $stmt_insert->execute();
            }

            $stmt_insert->close();
        } else {
            // Manejar la situación en la que los arrays no tienen la misma longitud
            echo "Error: Tallas, colores y cantidades deben tener la misma longitud.";
        }
    }
}


?>
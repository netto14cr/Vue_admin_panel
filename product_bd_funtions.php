<?php

function getManufacturerInfo($con, $m_id) {
    $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$m_id'";
    $run_manufacturer = mysqli_query($con, $get_manufacturer);
    return mysqli_fetch_array($run_manufacturer);
}

function getProductCategoryInfo($con, $p_cat) {
    $get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id='$p_cat'";
    $run_p_cat = mysqli_query($con, $get_p_cat);
    return mysqli_fetch_array($run_p_cat);
}

function getCategoryInfo($con, $cat) {
    $get_cat = "SELECT * FROM categories WHERE cat_id='$cat'";
    $run_cat = mysqli_query($con, $get_cat);
    return mysqli_fetch_array($run_cat);
}


function getProductData($con, $edit_id) {
    $get_p = "SELECT * FROM products WHERE product_id='$edit_id'";
    $run_edit = mysqli_query($con, $get_p);
    return mysqli_fetch_array($run_edit);
}

function getManufacturerData($con, $m_id) {
    $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$m_id'";
    $run_manufacturer = mysqli_query($con, $get_manufacturer);
    return mysqli_fetch_array($run_manufacturer);
}

function getProductCategoryData($con, $p_cat) {
    $get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id='$p_cat'";
    $run_p_cat = mysqli_query($con, $get_p_cat);
    return mysqli_fetch_array($run_p_cat);
}

function getCategoryData($con, $cat) {
    $get_cat = "SELECT * FROM categories WHERE cat_id='$cat'";
    $run_cat = mysqli_query($con, $get_cat);
    return mysqli_fetch_array($run_cat);

}


function consultarManufacturersWithSelected($con, $selectedManufacturerId) {
    $get_manufacturer = "SELECT * FROM manufacturers";
    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    $options = "";
    while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
        $manufacturer_id = $row_manufacturer['manufacturer_id'];
        $manufacturer_title = $row_manufacturer['manufacturer_title'];

        $isSelected = ($manufacturer_id == $selectedManufacturerId) ? 'selected' : '';

        $options .= "<option value='$manufacturer_id' $isSelected>$manufacturer_title</option>";
    }

    return $options;
}

function consultarProductCategoriesWithSelected($con, $selectedProductCategoryId) {
    $get_p_cats = "SELECT * FROM product_categories";
    $run_p_cats = mysqli_query($con, $get_p_cats);

    $options = "";
    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
        $p_cat_id = $row_p_cats['p_cat_id'];
        $p_cat_title = $row_p_cats['p_cat_title'];

        $isSelected = ($p_cat_id == $selectedProductCategoryId) ? 'selected' : '';

        $options .= "<option value='$p_cat_id' $isSelected>$p_cat_title</option>";
    }

    return $options;
}


function consultarCategoriasWithSelected($con, $selectedCategoryId) {
    $get_cats = "SELECT * FROM categories";
    $run_cats = mysqli_query($con, $get_cats);

    $options = "";
    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        $isSelected = ($cat_id == $selectedCategoryId) ? 'selected' : '';

        $options .= "<option value='$cat_id' $isSelected>$cat_title</option>";
    }
    return $options;

}




function obtenerUltimoStockId($con)
{
    $get_last_stock_id_query = "SELECT stock_id FROM stock_by_size_and_color ORDER BY stock_id DESC LIMIT 1";
    $run_last_stock_id = mysqli_query($con, $get_last_stock_id_query);
    $last_stock_id_row = mysqli_fetch_assoc($run_last_stock_id);
    return $last_stock_id_row['stock_id'];
}




// -----------------  Ultimos Agregados ----------------- //

function obtenerColores($con) {
    $get_colors_query = "SELECT color_id, color_name, color_rgb FROM colors";
    $run_colors = mysqli_query($con, $get_colors_query);
    $options = "<option>Select A Color</option>";

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
    $options = "<option>Select A Size</option>";

    while ($row_size = mysqli_fetch_array($run_sizes)) {
        $size_id = $row_size['size_id'];
        $size_name = $row_size['size_name'];

        $options .= "<option value='$size_id'>$size_name</option>";
    }

    return $options;
}

function getExistingQuantity($con, $p_id, $color_id, $size_id) {
    $get_quantity_query = "SELECT quantity_available FROM stock_by_size_and_color WHERE product_id='$p_id' AND color_id='$color_id' AND size_id='$size_id'";
    $run_quantity = mysqli_query($con, $get_quantity_query);
    $row_quantity = mysqli_fetch_array($run_quantity);

    return ($row_quantity) ? $row_quantity['quantity_available'] : '';
}




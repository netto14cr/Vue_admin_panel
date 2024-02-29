<?php




function obtenerDatosExistente($con, $p_id)
{
    $get_existing_data_query = "SELECT sc.stock_id, sc.color_id, sc.size_id, s.size_name
                                FROM stock_by_size_and_color sc
                                JOIN sizes s ON sc.size_id = s.size_id
                                WHERE sc.product_id = '$p_id'";
    $run_existing_data = mysqli_query($con, $get_existing_data_query);
    $existingData = [];

    while ($row_existing_data = mysqli_fetch_array($run_existing_data)) {
        $existingData[] = $row_existing_data;
    }

    return $existingData;
}

function mostrarOpcionesSeleccionadas($con, $selectedId, $query, $optionValue, $optionText)
{
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $id = $row[$optionValue];
        $text = $row[$optionText];
        $selected = ($id == $selectedId) ? 'selected' : '';
        echo "<option value='$id' $selected>$text</option>";
    }
}




function displayColorSizeFields($con, $p_id)
{
    $counter = 0;
    $existingData = obtenerDatosExistente($con, $p_id);

    echo '
    <div class="form-group" id="dynamic_fields">
        <label class="col-md-3 control-label"> Color, Size and Quantity </label>
        <div class="col-md-12">
            <div class="input-group">
                <div class="field-container row">';

    foreach ($existingData as $row_existing_data) {
        $existing_stock_id = $row_existing_data['stock_id'];
        $existing_color_id = $row_existing_data['color_id'];
        $existing_size_id = $row_existing_data['size_id'];
        $size_name = $row_existing_data['size_name'];
        $existing_quantity = getExistingQuantity($con, $p_id, $existing_color_id, $existing_size_id);

        echo '
                    <div class="col-md-4">
                        <label class="form-label" for="colors">Color</label>
                        <select class="form-control" name="colors[]">
                            <option>Select A Color</option>';
        mostrarOpcionesSeleccionadas($con, $existing_color_id, "SELECT color_id, color_name, color_rgb FROM colors", 'color_id', 'color_name');
        echo '
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="sizes">Sizes</label>
                        <select class="form-control" name="sizes[]">
                            <option>Select A Size</option>';
        mostrarOpcionesSeleccionadas($con, $existing_size_id, "SELECT size_id, size_name FROM sizes", 'size_id', 'size_name');
        echo '
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="quantities">Quantity</label>
                        <input type="text" name="quantities[]" class="form-control" placeholder="Quantity" value="' . $existing_quantity . '" required>
                    </div>
                    <div class="col-md-1"><br>
                        <button class="btn btn-danger" type="button" id="remove_size_color_' . $counter . '" data-stockid="' . $existing_stock_id . '" data-sizecolorid="' . $counter . '">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    <br>';

        $counter++;
    }

    echo '
                </div>
            </div>
        </div>
    </div>';

    $last_stock_id = obtenerUltimoStockId($con);

    echo '
    <br>
    <div class="form-group" id="dynamic_fields_add" style="display: none;">
        <label class="col-md-3 control-label"> New color, size and quantity </label>
        
            <div class="input-group">
            <div class="col-md-12">
                <div class="field-container row">
                    <div class="col-md-4">
                        <label class="form-label" for="colors">Color</label>
                        <select class="form-control" name="colors_add[]">
                            <option>Select A Color</option>';
    mostrarOpcionesSeleccionadas($con, null, "SELECT color_id, color_name, color_rgb FROM colors", 'color_id', 'color_name');
    echo '
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="sizes">Sizes</label>
                        <select class="form-control" name="sizes_add[]">
                            <option>Select A Size</option>';
    mostrarOpcionesSeleccionadas($con, null, "SELECT size_id, size_name FROM sizes", 'size_id', 'size_name');
    echo '
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="quantities">Quantity</label>
                    <input type="text" name="quantities_add[]" class="form-control" placeholder="Quantity (Add)">
                </div>
                <div class="col-md-1"><br>
                    <button class="btn btn-danger" type="button" id="remove_size_color_add">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>';
}




// Método para eliminar registros de stock_by_size_and_color
function deleteProductStock($con)
{
    $deletedFields = json_decode($_POST['deleted_fields'], true);

    if (is_array($deletedFields) || is_object($deletedFields)) {
        foreach ($deletedFields as $field) {
            $stockId = $field['stockId'];

            $deleteStockQuery = "DELETE FROM stock_by_size_and_color WHERE stock_id = ?";
            $stmtDeleteStock = $con->prepare($deleteStockQuery);

            if (!$stmtDeleteStock) {
                die('Error en la preparación de la consulta: ' . $con->error);
            }

            $stmtDeleteStock->bind_param('s', $stockId);
            $stmtDeleteStock->execute();
            $stmtDeleteStock->close();
        }
    }
}

// Método para actualizar registros en stock_by_size_and_color
function updateProductStock($con)
{
    // Obtener campos actualizados
    $updatedFields = json_decode($_POST['updated_fields'], true);
    var_dump( $updatedFields);

    if (is_array($updatedFields) || is_object($updatedFields)) {
        foreach ($updatedFields as $field) {
            $stockId = $field['stockId'];
            $colorId = $field['colorId'];
            $sizeId = $field['sizeId'];
            $quantity = $field['quantity'];

            // Verificar si ya existe un registro para el stock_id
            $checkExistsQuery = "SELECT stock_id FROM stock_by_size_and_color WHERE stock_id = ?";
            $stmtCheckExists = $con->prepare($checkExistsQuery);
            $stmtCheckExists->bind_param('s', $stockId);
            $stmtCheckExists->execute();
            $stmtCheckExists->store_result();

            if ($stmtCheckExists->num_rows > 0) {
                // Si el registro ya existe, actualizar la cantidad, color y talla
                $updateStockQuery = "UPDATE stock_by_size_and_color SET color_id = ?, size_id = ?, quantity_available = ? WHERE stock_id = ?";
                $stmtUpdateStock = $con->prepare($updateStockQuery);
                $stmtUpdateStock->bind_param('ssss', $colorId, $sizeId, $quantity, $stockId);
                $stmtUpdateStock->execute();
                $stmtUpdateStock->close();
            }

            $stmtCheckExists->close();
        }
    }
}


function addProductStock($con, $productId)
{
    // Obtener campos actualizados en el formulario de añadir
    $updatedFieldsAdd = json_decode($_POST['updated_fields_add'], true);

    if (is_array($updatedFieldsAdd) || is_object($updatedFieldsAdd)) {
        foreach ($updatedFieldsAdd as $field) {
            $colorIdAdd = $field['colorId'];
            $sizeIdAdd = $field['sizeId'];
            $quantityAdd = $field['quantity'];

            // Validar que se hayan seleccionado opciones válidas para color y talla
            if (empty($colorIdAdd) || empty($sizeIdAdd)) {
                echo '<script>alert("Error: Debes seleccionar una opción válida para color y talla.");</script>';
                die();
            }

            // Validar que la cantidad sea mayor a 1
            if ($quantityAdd <= 1) {
                echo '<script>alert("Error: La cantidad debe ser mayor a 1.");</script>';
                die();
            }

            // Insertar nuevo registro en stock_by_size_and_color
            $insertStockQuery = "INSERT INTO stock_by_size_and_color (product_id, color_id, size_id, quantity_available) VALUES (?, ?, ?, ?)";
            $stmtInsertStock = $con->prepare($insertStockQuery);

            if (!$stmtInsertStock) {
                echo '<script>alert("Error en la preparación de la consulta: ' . $con->error . '");</script>';
                die();
            }

            $stmtInsertStock->bind_param('ssss', $productId, $colorIdAdd, $sizeIdAdd, $quantityAdd);
            $stmtInsertStock->execute();
            $stmtInsertStock->close();
        }
    }
}



// Método para actualizar el stock total en la tabla products
function updateStockTotal($con, $p_id)
{
    // Verificar si ha habido alguna actualización en el stock
    if ($_POST['updated_fields'] || $_POST['deleted_fields'] || $_POST['updated_fields_add']) {
        // Obtener el stock total actual del producto
        $getStockTotalQuery = "SELECT SUM(quantity_available) AS total FROM stock_by_size_and_color WHERE product_id = '$p_id'";
        $runStockTotal = mysqli_query($con, $getStockTotalQuery);
        $rowStockTotal = mysqli_fetch_assoc($runStockTotal);
        $currentStockTotal = $rowStockTotal['total'];

        // Actualizar el stock total en la tabla products
        $updateStockTotalQuery = "UPDATE products SET stock_total = ? WHERE product_id = ?";
        $stmtUpdateStockTotal = $con->prepare($updateStockTotalQuery);

        if (!$stmtUpdateStockTotal) {
            die('Error en la preparación de la consulta: ' . $con->error);
        }

        $stmtUpdateStockTotal->bind_param('ss', $currentStockTotal, $p_id);
        $stmtUpdateStockTotal->execute();
        $stmtUpdateStockTotal->close();
    }
}



function buildProductTitleField($p_title) {
    return '
        <div class="form-group">
            <label class="col-md-3 control-label">Product Title</label>
            <div class="col-md-6">
                <input type="text" name="product_title" class="form-control" required value="' . $p_title . '">
            </div>
        </div>';
}

function buildProductImageField($p_image, $temp_name) {
    return '
        <div class="form-group">
            <label class="col-md-3 control-label">Product Image</label>
            <div class="col-md-6">
                <input type="file" name="' . $p_image . '" class="form-control">
                <br><img src="product_images/' . $p_image . '" width="70" height="70">
            </div>
        </div>';
}

// Puedes agregar más funciones para construir otros campos del formulario
// Ejemplo de función para construir un campo de selección
function buildSelectField($label, $name, $options, $selectedValue) {
    $selectField = '<div class="form-group">
                        <label class="col-md-3 control-label">' . $label . '</label>
                        <div class="col-md-6">
                            <select name="' . $name . '" class="form-control">';

    foreach ($options as $value => $text) {
        $selected = ($value == $selectedValue) ? 'selected' : '';
        $selectField .= '<option value="' . $value . '" ' . $selected . '>' . $text . '</option>';
    }

    $selectField .= '</select></div></div>';

    return $selectField;
}

// Puedes agregar más funciones según las necesidades del formulario












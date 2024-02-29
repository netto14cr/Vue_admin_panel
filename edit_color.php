<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    if (isset($_GET['edit_color'])) {
        $edit_id = $_GET['edit_color'];
        $edit_color_query = "SELECT * FROM colors WHERE color_id='$edit_id'";
        $run_edit_color = mysqli_query($con, $edit_color_query);
        $row_edit_color = mysqli_fetch_array($run_edit_color);

        $color_id = $row_edit_color['color_id'];
        $color_rgb = $row_edit_color['color_rgb'];
        $color_name = $row_edit_color['color_name'];
    }

    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> Dashboard / Edit Color</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Edit Color
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">

                        <div class="form-group"><!-- form-group Starts -->
                            <label class="col-md-3 control-label"> Color RGB </label>
                            <div class="col-md-6">
                                <input type="text"  id="rbg_name" name="rbg_name" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Edit Color </label>
                            <div class="col-md-6">
                                <input type="text" id="product_color" class="form-control" name="color_rgb" value="<?php echo $color_rgb; ?>" required style="width: 400px;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Color Name</label>
                            <div class="col-md-6">
                                <input type="text" id="color_name" name="color_name" class="form-control" value="<?php echo $color_name; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-3">
                                <input type="submit" name="update_color" value="Update Color" class="btn btn-primary form-control">
                            </div>

                            <!-- Botón de Cancelar -->
                            <div class="col-md-3">
                                <a href="index.php?view_colors" class="btn btn-primary form-control" style="background-color: #9e9e9e">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update_color'])) {
        $color_rgb = $_POST['color_rgb'];
        $color_name = $_POST['color_name'];

        $update_color_query = "UPDATE colors SET color_rgb=?, color_name=? WHERE color_id=?";
        $stmt = $con->prepare($update_color_query);
        $stmt->bind_param('ssi', $color_rgb, $color_name, $color_id);

        if ($stmt->execute()) {
            echo "<script>alert('Color Has Been Updated')</script>";
            echo "<script>window.open('index.php?view_colors','_self')</script>";
        } else {
            echo "<script>alert('Error updating color')</script>";
        }

        $stmt->close();
    }

    ?>
    <script>
        $("#product_color").spectrum({
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            showPaletteOnly: true,
            togglePaletteOnly: true,
            hideAfterPaletteSelect: true,
            color: "<?php echo $color_rgb; ?>",
            palette: [
                ["#FFFFFF", "#E0E0E0", "#C0C0C0", "#808080", "#404040", "#000000"],
                ["#FF0000", "#990000", "#FF6666", "#00FF00", "#009900", "#66FF66"],
                ["#0000FF", "#000099", "#6666FF", "#FFC0CB", "#FF69B4", "#FF1493"],
                ["#FFA07A", "#D2691E", "#8B4513", "#FFFF00", "#FFD700", "#FFCC00"],
                ["#800080", "#9932CC", "#4B0082", "#FFD700", "#FFA500", "#FF8C00"],
                ["#008080", "#2F4F4F", "#708090", "#FF6347", "#FF4500", "#FF8C69"]
            ],
            change: function(color) {
                $("#product_color").css("background-color", color.toHexString());
                // Obtiene el nombre del color y lo muestra en el span
                var colorName = getColorName(color.toHexString());
                $("#color_name_display").text(colorName);
                // Actualiza el valor del input de nombre de color
                $("#color_name").val(colorName);
                // Actualiza el valor de
                $("#rbg_name").val(color.toHexString());
            }
        });

        // Función para obtener el nombre del color a partir del código hexadecimal
        function getColorName(hexColor) {
            // Utiliza la función del ntc.js para obtener el nombre del color
            var ntcResult = ntc.name(hexColor);
            return ntcResult[1] || "Desconocido";
        }
    </script>

<?php } ?>

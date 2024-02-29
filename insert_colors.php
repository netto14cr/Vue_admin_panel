<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Insert Color</h4>

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card"><!-- card Starts -->
            <div class="card-header"><!-- card-header Starts -->
                <h4 class="card-title"><!-- card-title Starts -->
                    <i class="feather icon-dollar-sign"></i> Insert Color
                </h4><!-- card-title Ends -->
            </div><!-- card-header Ends -->

            <div class="card-content"><!-- card-content Starts -->
                <div class="card-body"><!-- card-body Starts -->
                    <form class="form form-horizontal" action="" method="post"><!-- form-horizontal Starts -->
                        <div class="form-body"><!-- form-body Starts -->
                            <div class="row"><!-- row Starts -->
                                <div class="col-md-3"><!-- col-md-3 Starts -->
                                    <div class="form-group"><!-- form-group Starts -->
                                        <label class="col-md-12 control-label"> Color RGB </label>
                                        <div class="col-md-12">
                                            <input type="text" id="rbg_name" name="rbg_name" class="form-control" disabled>
                                        </div>
                                    </div><!-- form-group Ends -->
                                </div><!-- col-md-3 Ends -->

                                <div class="col-md-3"><!-- col-md-3 Starts -->
                                    <div class="form-group"><!-- form-group Starts -->
                                        <label class="col-md-6 control-label">Select Color</label>
                                        <div class="col-md-3">
                                            <!-- Ajusta el ancho del input agregando el estilo width -->
                                            <input type="text" id="product_color" class="form-control" name="color_rgb" required style="width: 400px;" />
                                        </div>
                                    </div><!-- form-group Ends -->
                                </div><!-- col-md-3 Ends -->

                                <div class="col-md-3"><!-- col-md-3 Starts -->
                                    <div class="form-group"><!-- form-group Starts -->
                                        <label class="col-md-12 control-label">Color Name</label>
                                        <div class="col-md-12">
                                            <input type="text" id="color_name" name="color_name" class="form-control" required>
                                        </div>
                                    </div><!-- form-group Ends -->
                                </div><!-- col-md-3 Ends -->

                                <div class="col-md-3"><!-- col-md-3 Starts -->
                                    <div class="form-group"><!-- form-group Starts -->
                                        <label class="col-md-12 control-label"></label>
                                        <div class="col-md-12">
                                            <input type="submit" name="submit_color" value="Insert Color" class="btn btn-primary form-control">
                                        </div>
                                    </div><!-- form-group Ends -->
                                </div><!-- col-md-3 Ends -->
                            </div><!-- row Ends -->
                        </div><!-- form-body Ends -->
                    </form><!-- form-horizontal Ends -->
                </div><!-- card-body Ends -->
            </div><!-- card-content Ends -->
        </div><!-- card Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->

    <?php

    if (isset($_POST['submit_color'])) {
        $color_rgb = $_POST['color_rgb'];
        $color_name = $_POST['color_name'];

        $insert_color_query = "INSERT INTO colors (color_rgb, color_name) VALUES (?, ?)";
        $stmt = $con->prepare($insert_color_query);
        $stmt->bind_param('ss', $color_rgb, $color_name);

        if ($stmt->execute()) {
            echo "<script>alert('New Color Has Been Inserted')</script>";
            echo "<script>window.open('index.php?view_colors','_self')</script>";
        } else {
            echo "<script>alert('Error inserting color')</script>";
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
            color: "#FFFFFF",
        palette: [
            ["#FFFFFF", "#E0E0E0", "#C0C0C0", "#808080", "#404040", "#000000"], // Blancos y Negros
            ["#FF0000", "#990000", "#FF6666", "#00FF00", "#009900", "#66FF66"], // Rojos y Verdes
            ["#0000FF", "#000099", "#6666FF", "#FFC0CB", "#FF69B4", "#FF1493"], // Azules y Rosas
            ["#FFA07A", "#D2691E", "#8B4513", "#FFFF00", "#FFD700", "#FFCC00"], // Salmón, Marrón, Amarillos y Dorados
            ["#800080", "#9932CC", "#4B0082", "#FFD700", "#FFA500", "#FF8C00"], // Púrpuras, Dorados y Naranjas
            ["#008080", "#2F4F4F", "#708090", "#FF6347", "#FF4500", "#FF8C69"]  // Verde Azulado, Gris Azulado, Coral y Naranja Rojizo
        ],
        // Agrega la función change para actualizar el color seleccionado visualmente
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

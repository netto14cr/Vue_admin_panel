<?php

    include("funciones_talla.php");

    // Obtener los géneros
    $sugerenciasGeneros = obtenerGenerosDisponibles();

    // Realizar la consulta SQL para obtener los géneros
    $query = "SELECT cat_id, cat_title FROM categories";
    $result = mysqli_query($con, $query);

    // Verificar si hay resultados
    if ($result) {
        $generos = array();

        // Iterar sobre los resultados y almacenar los géneros en un array
        while ($row = mysqli_fetch_assoc($result)) {
            $generos[$row['cat_id']] = $row['cat_title'];
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($con);
    }

    // Cerrar la conexión a la base de datos
    //mysqli_close($con);

    $base_url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    ?>

    <script>

        function actualizarSugerenciasTallas() {
            var sugerenciaGenero = document.getElementsByName("suggested_genders")[0].value;

            // Verificar si el campo tiene un valor
            if (sugerenciaGenero) {
                // Realizar una solicitud AJAX para obtener las sugerencias de tallas según el género seleccionado
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        try {
                            var sugerenciasTallas = JSON.parse(this.responseText);

                            // Limpiar el select de sugerencias de tallas
                            var selectSugerenciasTallas = document.getElementById("suggested_sizes");
                            selectSugerenciasTallas.innerHTML = "";

                            // Limpiar el select de sugerencias de diminutivos
                            var selectSugerenciasDiminutivos = document.getElementById("suggested_diminutives");
                            selectSugerenciasDiminutivos.innerHTML = "";

                            // Llenar los selectores con las nuevas sugerencias de tallas y diminutivos
                            for (var abreviatura in sugerenciasTallas) {
                                var nombre = sugerenciasTallas[abreviatura];

                                // Llenar el selector de tallas
                                var optionNombre = document.createElement("option");
                                optionNombre.value = abreviatura;
                                optionNombre.text = nombre;
                                selectSugerenciasTallas.add(optionNombre);

                                // Llenar el selector de diminutivos
                                var optionDiminutivo = document.createElement("option");
                                optionDiminutivo.value = abreviatura;
                                optionDiminutivo.text = abreviatura;
                                selectSugerenciasDiminutivos.add(optionDiminutivo);
                            }

                            // Agregar un evento onchange al selector de tallas para actualizar el selector de diminutivos
                            selectSugerenciasTallas.onchange = function () {
                                // Obtener el valor seleccionado en el selector de tallas
                                var seleccionTalla = selectSugerenciasTallas.value;

                                // Actualizar el valor seleccionado en el selector de diminutivos
                                selectSugerenciasDiminutivos.value = seleccionTalla;
                            };

                        } catch (e) {
                            console.error('Error al parsear JSON:', e);
                        }
                    }
                };
                xmlhttp.open("GET", "<?php echo $base_url; ?>/ajax_obtener_sugerencias_tallas.php?genero=" + sugerenciaGenero, true);
                xmlhttp.send();
            }
        }





        function actualizarNombre() {

            var selectElement = document.getElementsByName("size_gender")[0];
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var genero = selectedOption.id; // Aquí obtienes el id de la opción seleccionada


            var letra = document.getElementsByName("size_letter")[0].value;

            // Verificar si ambos campos tienen valores
            if (genero && letra) {
                // Realizar una solicitud AJAX para obtener el nombre completo
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        document.getElementById("size_name").value = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajax_obtener_nombre_talla.php?letra=" + letra + "&genero=" + genero, true);
                xmlhttp.send();
            }
        }
    </script>



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row g-3">
                    <div class="col-md-4">
                        <h4 class="card-title">
                            Insert Size
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form class="form-horizontal" action="" method="post">

                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Size Gender</label>
                            <select name="size_gender" class="form-control" onchange="actualizarNombre()" required>
                                <?php
                                // Mostrar las opciones del menú desplegable
                                foreach ($generos as $cat_id => $cat_title) {
                                    echo "<option value='$cat_id' id='$cat_title'>$cat_title</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label">Size Letter</label>
                            <input type="text" id="size_letter" name="size_letter" class="form-control" maxlength="5" pattern="[A-Za-z0-9]{1,5}" title="Enter up to 5 alphanumeric characters" onchange="actualizarNombre()" required>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label">Size Name</label>
                            <input type="text" id="size_name" name="size_name" class="form-control" maxlength="50" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1" id="new_fields">
                            <br>
                            <button type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#suggestionsModal">
                                <i class="ti ti-info-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label"></label>
                            <input type="submit" name="submit_size" value="Insert Size" class="btn btn-primary form-control">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<?php
if (isset($_POST['submit_size'])) {
    $size_name = mysqli_real_escape_string($con, $_POST['size_name']);
    $size_gender = mysqli_real_escape_string($con, $_POST['size_gender']);
    $size_letter = mysqli_real_escape_string($con, $_POST['size_letter']);

    // Verificar longitud máxima de size_name y validación de size_letter
    if (strlen($size_name) <= 50 && preg_match("/^[A-Za-z0-9]{1,5}$/", $size_letter)) {

        $insert_size = "INSERT INTO sizes (size_name, size_letter, size_cat_id) VALUES ('$size_name', '$size_letter', '$size_gender')";
        $run_size = mysqli_query($con, $insert_size);

        if ($run_size) {
            echo "<script>alert('New Size Has Been Inserted')</script>";
            echo "<script>window.open('index.php?view_sizes','_self')</script>";
        } else {
            echo "<script>alert('Error inserting size')</script>";
        }
    } else {
        echo "<script>alert('Invalid input. Please check size name (max 50 characters) and size letter (1 to 5 alphanumeric characters).')</script>";
    }
}
?>









<!-- Modal -->
<div class="modal fade" id="suggestionsModal" tabindex="-1" role="dialog" aria-labelledby="suggestionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title" id="suggestionsModalLabel">Sugerencias de Género y Tallas</h5>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <!-- Mostrar el select de géneros sugeridos -->
                <div class="form-group row"><!-- form-group row Starts -->
                    <label class="col-md-4 col-form-label">Suggested Genders</label>
                    <div class="col-md-8">
                        <select id="suggested_genders" name="suggested_genders" class="form-control" onchange="actualizarSugerenciasTallas()">
                            <?php
                            // Mostrar las sugerencias de géneros
                            foreach ($sugerenciasGeneros as $genero) {
                                echo "<option value='$genero'>$genero</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div><!-- form-group row Ends -->

                <!-- Mostrar el select de tallas -->
                <div class="form-group row"><!-- form-group row Starts -->
                    <label class="col-md-4 col-form-label">Suggested Sizes</label>
                    <div class="col-md-8">
                        <select id="suggested_sizes" name="suggested_sizes" class="form-control">
                        </select>
                    </div>
                </div><!-- form-group row Ends -->

                <!-- Mostrar el select de tallas -->
                <div class="form-group row"><!-- form-group row Starts -->
                    <label class="col-md-4 col-form-label">Suggested letters</label>
                    <div class="col-md-8">
                        <select id="suggested_diminutives" name="suggested_diminutives" class="form-control" disabled>
                        </select>
                    </div>
                </div><!-- form-group row Ends -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



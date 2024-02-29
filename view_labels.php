<?php

class ViewLabels {
    private $con;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($con) {
        $this->con = $con;
    }

    // Función para obtener la vista de etiquetas
    public function getView() {
        if (!isset($_SESSION['admin_email'])) {
            echo "<script>window.open('login.php', '_self')</script>";
        } else {
            ?>
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Labels</h4>
                <button class="btn btn-primary" onclick="window.open('index.php?insert_label','_self')">Add Label</button>
                <button class="btn btn-primary pull-right" onclick="window.open('index.php?view_colors','_self')">
                    <i class="fa fa-paint-brush"> </i>View Labels</button>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Categories </h5>

                            <?php
                            echo $this->getLabelsTable();
                            ?>
                        </div><!-- panel-body Ends -->
                    </div><!-- panel panel-default Ends -->
                </div><!-- col-lg-12 Ends -->
            </div><!-- 2 row Ends -->

            <!-- Agrega el script para inicializar Spectrum en la columna Color Preview -->
            <script>
                $(document).ready(function () {
                    $(".color-preview").spectrum({
                        preferredFormat: "hex",
                        showInput: false,
                        showPalette: false,
                    });
                });
            </script>
            <?php
        }
    }

    // Función para obtener la tabla de etiquetas
    private function getLabelsTable() {
        $labelsTable = '<div class="table-responsive text-nowrap"><!-- table-responsive Starts -->
                            <table class="table"><!-- table-bordered table-hover table-striped Starts -->
                                <thead><!-- thead Starts -->
                                    <tr>
                                        <th style="text-align: center">Id</th>
                                        <th style="text-align: center">Label Name</th>
                                        <th style="text-align: center">Label Description</th>
                                        <th style="text-align: center">Label Color</th>
                                        <th style="text-align: center">Editar</th>
                                        <th style="text-align: center">Eliminar</th>
                                        <!-- Puedes agregar más columnas según tus necesidades -->
                                    </tr>
                                </thead><!-- thead Ends -->
                                <tbody><!-- tbody Starts -->';

        $i = 0;
        $get_labels = "SELECT * FROM label";
        $run_labels = mysqli_query($this->con, $get_labels);

        while ($row_labels = mysqli_fetch_array($run_labels)) {
            $label_id = $row_labels['label_id'];
            $label_name = $row_labels['name'];
            $label_description = $row_labels['description'];
            $color_id = $row_labels['color_id'];

            // Obtener información del color
            $get_color_query = "SELECT color_name, color_rgb FROM colors WHERE color_id = '$color_id'";
            $run_color_query = mysqli_query($this->con, $get_color_query);
            $row_color = mysqli_fetch_assoc($run_color_query);
            $color_name = $row_color['color_name'];
            $color_rgb = $row_color['color_rgb'];

            $i++;

            $labelsTable .= '<tr align="center">
                                <td>' . $i . '</td>
                                <td>' . $label_name . '</td>
                                <td>' . $label_description . '</td>
                                <td>
                                 
                                    <div style="width: 30px; height: 30px; background-color: ' . $color_rgb . '; border-radius: 50%;"></div>

                                </td>
                                <td>
                                    <a href="index.php?edit_label=' . $label_id . '">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?delete_label=' . $label_id . '">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </a>
                                </td>
                            </tr>';
        }

        $labelsTable .= '</tbody><!-- tbody Ends -->
                        </table><!-- table-bordered table-hover table-striped Ends -->
                    </div><!-- table-responsive Ends -->';

        return $labelsTable;
    }
}

// Crear una instancia de la clase
$viewLabels = new ViewLabels($con);

// Mostrar la vista de etiquetas
$viewLabels->getView();
?>

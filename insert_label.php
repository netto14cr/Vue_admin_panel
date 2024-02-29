<?php
class Insertlabel {
    private $con;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($con) {
        $this->con = $con;
    }

    // Función para insertar etiquetas en la base de datos
    public function insertLabel($name, $description, $color_id) {
        $name = mysqli_real_escape_string($this->con, $name);
        $description = mysqli_real_escape_string($this->con, $description);

        $insert_label_query = "INSERT INTO label (name, description, color_id) VALUES ('$name', '$description', '$color_id')";
        $run_insert_label = mysqli_query($this->con, $insert_label_query);

        if ($run_insert_label) {
            echo "<script>alert('Label has been inserted successfully')</script>";
            echo "<script>window.open('index.php?view_labels','_self')</script>";
        } else {
            echo "<script>alert('Error inserting label')</script>";
        }
    }

    // Función para obtener información de colores (id y nombre)
    public function getColorInfo() {
        $get_color_query = "SELECT color_id, color_name, color_rgb FROM colors";
        $run_color_query = mysqli_query($this->con, $get_color_query);

        $color_info = array();

        while ($row_color = mysqli_fetch_assoc($run_color_query)) {
            $color_info[] = $row_color;
        }

        return $color_info;
    }

    // Función para construir el selector de colores con círculo de color
    public function buildColorSelector($color_info) {
        $selector_html = "<select name='color_id' class='form-control'>";

        foreach ($color_info as $color) {
            // Agregar círculo de color al texto de la opción
            $selector_html .= "<option value='{$color['color_id']}' style='background-color:{$color['color_rgb']}; color: white; padding: 5px; border-radius: 50%;'>{$color['color_name']} - {$color['color_rgb']}</option>";
        }

        $selector_html .= "</select>";

        return $selector_html;
    }

    // Función para construir el campo de nombre
    public function buildNameField() {
        return "<input type='text' name='name' class='form-control' maxlength='20' required>";
    }

    // Función para construir el campo de descripción
    public function buildDescriptionField() {
        return "<textarea name='description' class='form-control' rows='3' maxlength='50' required></textarea>";
    }
}

// Crear una instancia de la clase
$labelInsertion = new insertlabel($con);

// Mostrar el formulario de inserción
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Insert Label
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Color</label>
                        <div class="col-md-6">
                            <?php
                            // Mostrar el selector de colores
                            $colorInfo = $labelInsertion->getColorInfo();
                            echo $labelInsertion->buildColorSelector($colorInfo);
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <?php
                            // Mostrar el campo de nombre
                            echo $labelInsertion->buildNameField();
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <?php
                            // Mostrar el campo de descripción
                            echo $labelInsertion->buildDescriptionField();
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit_label" value="Insert Label" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Procesar el formulario
if (isset($_POST['submit_label'])) {
    $color_id = $_POST['color_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Insertar la etiqueta
    $labelInsertion->insertLabel($name, $description, $color_id);
}
?>

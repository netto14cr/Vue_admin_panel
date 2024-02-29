<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
} else {
    class EditLabel {
        private $con;

        public function __construct($con) {
            $this->con = $con;
        }

        public function editLabelForm($edit_id) {
            $edit_label_query = "SELECT label.*, colors.color_rgb FROM label JOIN colors ON label.color_id = colors.color_id WHERE label_id='$edit_id'";
            $run_edit_label = mysqli_query($this->con, $edit_label_query);
            $row_edit_label = mysqli_fetch_array($run_edit_label);

            $label_id = $row_edit_label['label_id'];
            $label_name = $row_edit_label['name'];
            $label_description = $row_edit_label['description'];
            $color_rgb = $row_edit_label['color_rgb'];

            // Obtener información de colores
            $get_color_query = "SELECT color_id, color_name, color_rgb FROM colors";
            $run_color_query = mysqli_query($this->con, $get_color_query);

            // Mostrar el formulario de edición
            echo "
            <div class='row'>
                <div class='col-lg-12'>
                    <ol class='breadcrumb'>
                        <li>
                            <i class='fa fa-dashboard'></i> Dashboard / Edit Label
                        </li>
                    </ol>
                </div>
            </div>

            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h3 class='panel-title'>
                                <i class='fa fa-money fa-fw'></i> Edit Label
                            </h3>
                        </div>

                        <div class='panel-body'>
                            <form class='form-horizontal' action='' method='post'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Label Name</label>
                                    <div class='col-md-6'>
                                        <input type='text' name='label_name' class='form-control' value='$label_name' required>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Label Description</label>
                                    <div class='col-md-6'>
                                        <textarea name='label_description' class='form-control' rows='3' maxlength='50' required>$label_description</textarea>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Label Color</label>
                                    <div class='col-md-6'>
                                        <select name='label_color' id='labelColorSelector' class='form-control color-picker' required>";
            while ($row_color = mysqli_fetch_assoc($run_color_query)) {
                $color_id = $row_color['color_id'];
                $color_name = $row_color['color_name'];
                $color_rgb_option = $row_color['color_rgb'];
                $selected = ($color_rgb_option == $color_rgb) ? 'selected' : '';
                echo "<option value='$color_id' style='background-color: $color_rgb_option;' $selected>$color_name</option>";
            }
            echo "</select></div></div>

                                        <div class='form-group'>
                                            <label class='col-md-3 control-label'>Preview</label>
                                                <div class='col-md-6'>
                                                    <div style='border: 1px solid #0c2b4b; background-color: rgba(33,32,32,0.07); height: 32px'>
                                                    <label class='col-md-6 control-label'>Your label</label>
                                                    <div id='labelColorPreview' style='height: 30px; background-color: $color_rgb;'>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                <div class='form-group text-center'>
                                    <label class='col-md-3 control-label'></label>
                                    <div class='col-md-3'>
                                        <input type='submit' name='update_label' value='Update Label' class='btn btn-primary form-control'>
                                    </div>
                                    <div class='col-md-3'>
                                        <a href='index.php?view_labels' class='btn btn-primary form-control' style='background-color: #9e9e9e'>Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ";

            // Script jQuery para actualizar la vista previa del color al cambiar el selector
            echo "
            <script>
                $(document).ready(function () {
                    $('#labelColorSelector').change(function () {
                        var selectedColor = $('#labelColorSelector option:selected').css('background-color');
                        $('#labelColorPreview').css('background-color', selectedColor);
                    });
                });
            </script>
            ";

            if (isset($_POST['update_label'])) {
                $label_name = mysqli_real_escape_string($this->con, $_POST['label_name']);
                $label_description = mysqli_real_escape_string($this->con, $_POST['label_description']);
                $label_color_id = $_POST['label_color'];

                $update_label_query = "UPDATE label SET name='$label_name', description='$label_description', color_id='$label_color_id' WHERE label_id='$label_id'";
                $run_update_label = mysqli_query($this->con, $update_label_query);

                if ($run_update_label) {
                    echo "<script>alert('Label Has Been Updated')</script>";
                    echo "<script>window.open('index.php?view_labels', '_self')</script>";
                }
            }
        }
    }

    // Crear una instancia de la clase
    $editLabel = new EditLabel($con);

    // Verificar si se ha proporcionado el ID de etiqueta para editar
    if (isset($_GET['edit_label'])) {
        $edit_id = $_GET['edit_label'];
        $editLabel->editLabelForm($edit_id);
    }
}
?>
```
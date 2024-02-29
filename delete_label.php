<?php

class Deletelabel {
    private $con;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($con) {
        $this->con = $con;
    }

    // Función para eliminar una etiqueta de la base de datos
    public function deleteLabel($label_id) {
        $delete_label_query = "DELETE FROM label WHERE label_id = '$label_id'";
        $run_delete_label = mysqli_query($this->con, $delete_label_query);

        if ($run_delete_label) {
            echo "<script>alert('Label has been deleted').classList.add('delete_label');</script>";
            echo "<script>window.open('index.php?view_labels','_self')</script>";
        } else {
            echo "<script>alert('Error deleting label').classList.add('delete_label');</script>";
        }
    }
}

// Crear una instancia de la clase
$labelDeletion = new Deletelabel($con);

// Procesar la eliminación
if (isset($_GET['delete_label'])) {
    $delete_id = $_GET['delete_label'];
    $labelDeletion->deleteLabel($delete_id);
}

?>

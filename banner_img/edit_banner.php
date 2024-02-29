<?php
include("BannerImage.php");
include("ImageUploader.php");

// Obtener el ID del banner a editar
$bannerIdToEdit = isset($_GET['edit_banner']) ? $_GET['edit_banner'] : null;

// Verificar si se proporcionó un ID de banner válido
if ($bannerIdToEdit) {
    // Obtener los detalles del banner a editar
    $bannerManager = new BannerImage($con);
    $availableColors = $bannerManager->getAvailableColors();
    $bannerDetails = $bannerManager->getBannerDetails($bannerIdToEdit);

    // Verificar si se encontraron detalles del banner
    if ($bannerDetails) {
        // Obtener la información necesaria para el formulario de edición
        $sectionTitleToEdit = $bannerDetails['section_title'];
        $bannerTitleToEdit = $bannerDetails['banner_title'];
        $descriptionToEdit = $bannerDetails['description'];
        $colorIdToEdit = $bannerDetails['color_id'];
        $colorRgbToEdit = $bannerDetails['color']['color_rgb'];
    } else {
        // Manejar el caso en que no se encuentren detalles del banner
        echo "<script>alert('No se encontraron detalles del banner para editar')</script>";
        echo "<script>window.open('index.php?view_banner_images','_self')</script>";
    }
} else {
    // Manejar el caso en que no se proporcionó un ID de banner válido
    echo "<script>alert('ID de banner no válido para editar')</script>";
    echo "<script>window.open('index.php?view_banner_images','_self')</script>";
}


?>

<!-- Aquí empieza el formulario de edición de banner -->
<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <span class="text-muted fw-light">Dashboard /</span> Edit Banner
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card"><!-- card Starts -->
            <div class="card-header"><!-- card-header Starts -->
                <h3 class="card-title"><!-- card-title Starts -->
                    <i class="fa fa-image fa-fw"></i> Edit Banner
                </h3><!-- card-title Ends -->
            </div><!-- card-heading Ends -->

            <div class="card-body"><!-- card-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Section Title</label>
                        <div class="col-md-6">
                            <input type="text" name="section_title" class="form-control" value="<?php echo $sectionTitleToEdit; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Banner Title</label>
                        <div class="col-md-6">
                            <input type="text" name="banner_title" class="form-control" value="<?php echo $bannerTitleToEdit; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" required><?php echo $descriptionToEdit; ?></textarea>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Select Color</label>
                        <div class="col-md-6">
                            <select name="color_id" id="colorSelect" class="form-control">
                                <?php
                                // Mostrar opciones de colores disponibles
                                foreach ($availableColors as $color) {
                                    $selected = ($color['color_id'] == $colorIdToEdit) ? 'selected' : '';
                                    echo '<option value="' . $color['color_id'] . '" data-color-rgb="' . $color['color_rgb'] . '" ' . $selected . '>' . $color['color_name'] .' | '.$color['color_rgb']. '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Preview Color</label>
                        <div class="col-md-6">
                            <div id='colorPreview' style='height: 30px; position: relative;'>
                                <span id="previewText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: <?php echo $colorRgbToEdit; ?>;">Texto de prueba</span>
                            </div>
                        </div>
                    </div><!-- form-group Ends -->

                    <!-- Agrega este bloque de código en la sección del formulario de edición -->
                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Current Banner Image</label>
                        <div class="col-md-6">
                            <?php
                            // Verifica si hay una imagen almacenada en la base de datos para este banner
                            if (!empty($bannerDetails['image_data']['image_data'])) {
                                $img64ToEdit = $bannerDetails['image_data']['image_data'];
                                $imgTypeToEdit = $bannerDetails['image_data']['image_extension'];
                                echo '<img src="data:image/' . $imgTypeToEdit . ';base64,' . $img64ToEdit . '" alt="Current Image" style="max-height: 300px;">';
                            } else {
                                echo '<span class="text-muted">No current image available</span>';
                            }
                            ?>
                        </div>
                    </div><!-- form-group Ends -->




                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Select New Banner Image</label>
                        <div class="col-md-6">
                            <input type="file" name="banner_image" id="banner_image_input" class="form-control" onchange="previewImage()">
                            <div class="v-card-text mt-2">
                                <span class="text-muted">Recommended size: 1080 x 780 pixels</span>
                            </div>
                            <img id="image_preview" src="#" alt="Preview" style="max-height: 300px; display: none;">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Update Banner" class="btn btn-primary form-control">
                        </div>
                    </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->
            </div><!-- card-body Ends -->
        </div><!-- card Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->
<!-- Aquí termina el formulario de edición de banner -->

<!-- Script de vista previa de la imagen -->
<!-- Agrega este bloque de código en el script JavaScript para manejar la vista previa de la imagen -->
<script>
    function previewImage() {
        var input = document.getElementById('banner_image_input');
        var preview = document.getElementById('image_preview');

        // Mostrar la vista previa solo si se selecciona un nuevo archivo
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // Ocultar la vista previa si no se selecciona un nuevo archivo
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    // Ejecutar la función al cargar la página para manejar la vista previa de la imagen actual
    document.addEventListener('DOMContentLoaded', function () {
        previewImage();
    });
</script>


<script>
    $(document).ready(function () {
        function getContrastColor(hexColor) {
            var r = parseInt(hexColor.slice(1, 3), 16);
            var g = parseInt(hexColor.slice(3, 5), 16);
            var b = parseInt(hexColor.slice(5, 7), 16);
            var brightness = (r * 299 + g * 587 + b * 114) / 1000;
            return brightness > 128 ? 'black' : 'white';
        }

        function updatePreviewColor(selectedColor) {
            $('#previewText').css('color', selectedColor);
            var contrastColor = getContrastColor(selectedColor);
            $('#colorPreview').css('background-color', 'rgba(255, 255, 255, 0.5)'); // Fondo transparente blanco por defecto
            if (contrastColor === 'black') {
                $('#colorPreview').css('background-color', 'rgba(0, 0, 0, 0.5)'); // Fondo transparente negro para texto claro
            }
        }

        $('#colorSelect').change(function () {
            var selectedColor = $('#colorSelect option:selected').data('color-rgb');
            updatePreviewColor(selectedColor);
        });

        // Configura la vista previa del color con el color predeterminado
        var defaultColor = '<?php echo $colorRgbToEdit; ?>';
        $('#previewText').css('color', defaultColor);
        updatePreviewColor(defaultColor);
    });
</script>

<?php

// Verificar si se ha enviado el formulario
if (isset($_POST['submit'])) {
    // Validar y limpiar los datos del formulario
    $sectionTitle = mysqli_real_escape_string($con, $_POST['section_title']);
    $bannerTitle = mysqli_real_escape_string($con, $_POST['banner_title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $colorID = $_POST['color_id'];

    // Crear una instancia de la clase BannerImage
    $bannerImage = new BannerImage($con);

    // Subir la nueva imagen solo si se selecciona un nuevo archivo
    if (!empty($_FILES['banner_image']['name'])) {
        $imageUploader = new ImageUploader(); // Asumiendo que existe una clase ImageUploader para manejar la subida de imágenes

        $compressedImage = $imageUploader->convertToBase64($_FILES['banner_image']['tmp_name'],
            $_FILES['banner_image']['type'], $_FILES['banner_image']['name']);

        if ($compressedImage) {
            // Llamar al método updateBannerImage de la clase BannerImage
            if ($bannerImage->updateBannerImage($bannerIdToEdit, $sectionTitle, $bannerTitle, $description, $colorID, $compressedImage['name'], $compressedImage['data'], $compressedImage['type'])) {
                echo "<script>window.open('index.php?view_banner_images','_self')</script>";
            } else {
                echo "<script>alert('Error al actualizar la imagen del banner')</script>";
            }
        } else {
            echo "<script>alert('Error al comprimir la nueva imagen')</script>";
        }
    } else {
        // Si no se selecciona un nuevo archivo, actualizar solo los datos de texto y color
        if ($bannerImage->updateBannerTextAndColor($bannerIdToEdit, $sectionTitle, $bannerTitle, $description, $colorID)) {
            echo "<script>window.open('index.php?view_banner_images','_self')</script>";
        } else {
            echo "<script>alert('Error al actualizar la información del banner')</script>";
        }
    }
}
?>

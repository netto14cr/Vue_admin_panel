<?php
include("BannerImage.php");
include("ImageUploader.php");

// Uso del método getAvailableColors
$bannerImage = new BannerImage($con);
$availableColors = $bannerImage->getAvailableColors();

?>


<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <span class="text-muted fw-light">Dashboard /</span> Insert Banner
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card"><!-- card Starts -->
            <div class="card-header"><!-- card-header Starts -->
                <h3 class="card-title"><!-- card-title Starts -->
                    <i class="fa fa-image fa-fw"></i> Insert Banner
                </h3><!-- card-title Ends -->
            </div><!-- card-heading Ends -->

            <div class="card-body"><!-- card-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Section Title</label>
                        <div class="col-md-6">
                            <input type="text" name="section_title" class="form-control" required>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Banner Title</label>
                        <div class="col-md-6">
                            <input type="text" name="banner_title" class="form-control" required>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Select Color</label>
                        <div class="col-md-6">
                            <select name="color_id" id="colorSelect" class="form-control">
                                <?php
                                $availableColors = $bannerImage->getAvailableColors();
                                foreach ($availableColors as $color) {
                                    echo '<option value="' . $color['color_id'] . '" data-color-rgb="' . $color['color_rgb'] . '">' . $color['color_name'] .' | '.$color['color_rgb']. '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Preview Color</label>
                        <div class="col-md-6">
                            <div id='colorPreview' style='height: 30px; position: relative;'>
                                <span id="previewText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: <?php echo $availableColors[0]['color_rgb']; ?>;">Texto de prueba</span>
                            </div>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Select Banner Image</label>
                        <div class="col-md-6">
                            <input type="file" name="banner_image" id="banner_image_input" class="form-control" onchange="previewImage()" required>
                            <div class="v-card-text mt-2">
                                <span class="text-muted">Recommended size: 1080 x 780 pixels</span>
                            </div>
                            <img id="image_preview" src="#" alt="Preview" style="max-height: 300px; display: none;">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Insert Banner" class="btn btn-primary form-control">
                        </div>
                    </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->
            </div><!-- card-body Ends -->
        </div><!-- card Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->


<!-- Script de vista previa de la imagen -->
<script>
    function previewImage() {
        var input = document.getElementById('banner_image_input');
        var preview = document.getElementById('image_preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
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
        var defaultColor = '<?php echo $availableColors[0]['color_rgb']; ?>';
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

    // Subir la imagen y obtener la información
    $imageUploader = new ImageUploader(); // Asumiendo que existe una clase ImageUploader para manejar la subida de imágenes

    $compressedImage=$imageUploader->convertToBase64($_FILES['banner_image']['tmp_name'],
        $_FILES['banner_image']['type'], $_FILES['banner_image']['name']);

    if ($compressedImage) {
            // Llamar al método insertBannerImage de la clase BannerImage
            if ($bannerImage->insertBannerImage($sectionTitle, $bannerTitle, $description, $colorID, $compressedImage['name'], $compressedImage['data'], $compressedImage['type'])) {
                echo "<script>window.open('index.php?view_banner_images','_self')</script>";
            } else {
                echo "<script>alert('Error al insertar la imagen del banner')</script>";
            }
    } else {
        echo "<script>alert('Error al comprimir la imagen')</script>";
    }
}
?>

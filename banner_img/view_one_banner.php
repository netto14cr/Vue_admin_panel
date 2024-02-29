<?php
include('BannerImage.php');

// Obtén el banner ID desde la URL
$bannerId = isset($_GET['view_one_banner']) ? $_GET['view_one_banner'] : null;

if ($bannerId) {
    // Instancia tu clase que tiene el método getCarouselItems
    $bannerManager = new BannerImage($con);
    $carouselItems = $bannerManager->getBannerDetails($bannerId);
    $img_code64 = $carouselItems['image_data'];
    $img64 = $img_code64['image_data'];
    $img_type = $img_code64['image_extension'];
    $img_name = $img_code64['image_name'];

    $color_name = $carouselItems['color']['color_name'];
    $color_rgb = $carouselItems['color']['color_rgb'];

    // Convertir la cadena de color RGB en un array
    $color_rgb_array = sscanf($color_rgb, "#%02x%02x%02x");

    // Luego, pasa el array a la vista
    echo '<script>';
    echo 'var colorRgb = ' . json_encode($color_rgb_array) . ';';
    echo '</script>';
}
?>

<div id="app">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"> Dashboard / </span> Banner Image</h4>
    <div class="row">
        <!-- Bootstrap carousel -->
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="my-0">Banner Image #{{ bannerId }}</h5>
                <a href="index.php?edit_banner=<?php echo $bannerId; ?>" class="btn btn-primary">Edit Banner</a>
            </div>


            <div id="carouselExample" class="carousel slide" data-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-target="#carouselExample" data-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 " :src="'data:image/' + img_type + ';base64,' + img64" alt="First slide" />
                        <h4 class="section-title text-left" :style="{ color: textColor, fontSize: '50px', position: 'absolute', top: '10px', left: '10px' }">{{ sectionTitle }}</h4>
                        <div class="carousel-caption">
                            <h4 class="banner-title text-left" :style="{ color: textColor, fontSize: '40px', position: 'absolute', bottom: '70px', left: '10px' }">{{ bannerTitle }}</h4>
                            <p class="description text-left" :style="{ color: textColor, fontSize: '18px', position: 'absolute', bottom: '1px', left: '10px' }">{{ description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Comentamos los controles de navegación para que no se cambie la imagen -->
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Incluimos Vue.js -->
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            bannerId: <?php echo json_encode($bannerId); ?>,
            img_type: <?php echo json_encode($img_type); ?>,
            img64: <?php echo json_encode($img64); ?>,
            sectionTitle: <?php echo json_encode($carouselItems['section_title']); ?>,
            bannerTitle: <?php echo json_encode($carouselItems['banner_title']); ?>,
            description: <?php echo json_encode($carouselItems['description']); ?>,
            colorRgb: <?php echo json_encode($color_rgb_array); ?>,
        },
        computed: {
            textColor() {
                return `rgb(${this.colorRgb.join(',')})`;
            }
        },
        mounted() {
            // Imprimir datos en la consola para realizar comprobaciones
            console.log('Banner ID:', this.bannerId);
            console.log('Image Type:', this.img_type);
            console.log('Image Data:', this.img64);
            console.log('Section Title:', this.sectionTitle);
            console.log('Banner Title:', this.bannerTitle);
            console.log('Description:', this.description);
            console.log('Color RGB:', this.colorRgb);
            console.log('Text Color:', this.textColor);
        }
    });
</script>

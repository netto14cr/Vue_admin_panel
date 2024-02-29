
<?php
session_start();
include("includes/db.php");
    ?>

<!DOCTYPE html>

<html
        lang="en"
        class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="bootstrap5/assets/"
        data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin Panel</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="bootstrap5/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
            rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="bootstrap5/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="bootstrap5/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="bootstrap5/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />




    <!-- Page CSS -->
    <link rel="stylesheet" href="bootstrap5/assets/vendor/css/pages/cards-advance.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/css/pages/ui-carousel.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/css/pages/page-profile.css" />
    <link rel="stylesheet" href="bootstrap5/assets/vendor/css/pages/app-email.css" />


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Spectrum CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap5/spectrum/spectrum.css">
    <!-- Spectrum JS -->
    <script src="bootstrap5/spectrum/spectrum.js"></script>
    <!-- NTC JS -->
    <script type="text/javascript" src="https://chir.ag/projects/ntc/ntc.js"></script>

    <!-- Agrega estas 3 lineas -->
    <link rel="stylesheet" href="bootstrap5/assets/vendor/libs/dropzone/dropzone.css">
    <script src="bootstrap5/assets/vendor/libs/dropzone/dropzone.js"></script>

    <!-- Helpers -->
    <script src="bootstrap5/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="bootstrap5/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="bootstrap5/assets/js/config.js"></script>

</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">

    <!-- Content wrapper -->
    <div class="content-wrapper">
    <?php

    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
        }
    else{
        include("includes/sesion_data.php");
        include("sidebar.php");
        include("header.php");
        echo '<div class="container-xxl flex-grow-1 container-p-y">';
        include("links.php");
    }


?>
    </div>
    <!-- Content wrapper -->

    </div>
</div>
<!-- / Layout page -->
</div>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="bootstrap5/assets/vendor/libs/jquery/jquery.js"></script>
<script src="bootstrap5/assets/vendor/libs/popper/popper.js"></script>
<script src="bootstrap5/assets/vendor/js/bootstrap.js"></script>
<script src="bootstrap5/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="bootstrap5/assets/vendor/libs/hammer/hammer.js"></script>
<script src="bootstrap5/assets/vendor/libs/i18n/i18n.js"></script>
<script src="bootstrap5/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="bootstrap5/assets/vendor/js/menu.js"></script>
<!-- endbuild -->


<!-- Vendors JS -->
<script src="bootstrap5/assets/vendor/libs/quill/katex.js"></script>
<script src="bootstrap5/assets/vendor/libs/quill/quill.js"></script>
<script src="bootstrap5/assets/vendor/libs/select2/select2.js"></script>
<script src="bootstrap5/assets/vendor/libs/block-ui/block-ui.js"></script>
<!-- Vendors JS -->

<!-- Page JS -->
<script src="bootstrap5/assets/js/app-email.js"></script>

<!-- Main JS -->
<script src="bootstrap5/assets/js/main.js"></script>
<script src="bootstrap5/assets/js/ui-carousel.js"></script>
<script src="bootstrap5/assets/js/pages-profile.js"></script>
<script src="bootstrap5/assets/js/app-academy-course-details.js"></script>


</body>
</html>
<?php
include("BannerImage.php");

class DeleteBanner
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function deleteBannerAndImage($bannerId)
    {
        // Crear una instancia de la clase BannerImage
        $bannerImage = new BannerImage($this->con);

        // Llamar al método deleteBannerAndImage de la clase BannerImage
        if ($bannerImage->deleteBannerAndImage($bannerId)) {
            echo "<script>alert('Banner and image deleted successfully')</script>";
            echo "<script>window.open('index.php?view_banner_images','_self')</script>";
        } else {
            echo "<script>alert('Error deleting banner and image')</script>";
        }
    }
}

// Obtener el ID del banner a eliminar desde la URL
$bannerIdToDelete = isset($_GET['delete_banner']) ? $_GET['delete_banner'] : null;

if ($bannerIdToDelete) {
    // Crear una instancia de la clase DeleteBanner
    $deleteBanner = new DeleteBanner($con);

    // Llamar al método deleteBannerAndImage de la clase DeleteBanner
    $deleteBanner->deleteBannerAndImage($bannerIdToDelete);
}
?>

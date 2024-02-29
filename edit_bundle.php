<?php


include("product_function2.php");
include("product_bd_funtions.php");



if (isset($_GET['edit_bundle'])) {
    $edit_id = $_GET['edit_bundle'];

    // Obtener datos del producto
    $row_edit = getProductData($con, $edit_id);

    $p_id = $row_edit['product_id'];
    $p_title = $row_edit['product_title'];
    $p_cat = $row_edit['p_cat_id'];
    $cat = $row_edit['cat_id'];
    $m_id = $row_edit['manufacturer_id'];
    $p_image1 = $row_edit['product_img1'];
    $p_image2 = $row_edit['product_img2'];
    $p_image3 = $row_edit['product_img3'];
    $new_p_image1 = $row_edit['product_img1'];
    $new_p_image2 = $row_edit['product_img2'];
    $new_p_image3 = $row_edit['product_img3'];
    $p_price = $row_edit['product_price'];
    $p_desc = $row_edit['product_desc'];
    $p_keywords = $row_edit['product_keywords'];
    $psp_price = $row_edit['product_psp_price'];
    $p_label = $row_edit['product_label'];
    $p_url = $row_edit['product_url'];
    $p_features = $row_edit['product_features'];
    $p_video = $row_edit['product_video'];

    // Obtener datos del fabricante
    $row_manufacturer = getManufacturerData($con, $m_id);
    $manufacturer_id = $row_manufacturer['manufacturer_id'];
    $manufacturer_title = $row_manufacturer['manufacturer_title'];

    // Obtener datos de la categoría de productos
    $row_p_cat = getProductCategoryData($con, $p_cat);
    $p_cat_title = $row_p_cat['p_cat_title'];

    // Obtener datos de la categoría
    $row_cat = getCategoryData($con, $cat);
    $cat_title = $row_cat['cat_title'];
}

?>



<div class="row"><!-- 2 row Starts -->

    <div class="card mb-4">
        <h5 class="card-header">Edit Bundle</h5>
        <form class="card-body form-horizontal" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <h6>1. Bundle Details</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="product_title">Bundle Title</label>
                        <input type="text" id="product_title" class="form-control" name="product_title"
                               required value="<?php echo $p_title; ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="product_url">Bundle Url</label>
                        <input type="text" id="product_url" class="form-control" name="product_url"
                               required value="<?php echo $p_url; ?>" >
                        <p style="font-size:15px; font-weight:bold;">Bundle Url Example: navy-blue-t-shirt</p>
                    </div>
                </div>

                <hr class="my-4 mx-n4">
                <h6>2. Manufacturer, Product and Category</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="manufacturer">Manufacturer</label>
                        <select name="manufacturer" class="form-control">
                            <option>Select a Manufacturer</option>
                            <?php echo consultarManufacturersWithSelected($con, $m_id); ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label name="p_cat" class="form-label">Product Category</label>
                        <select name="product_cat" class="form-control">
                            <option>Select a Product Category</option>
                            <?php echo consultarProductCategoriesWithSelected($con, $p_cat); ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="cat">Category</label>
                        <select name="cat" class="form-control">
                            <option>Select a Category</option>
                            <?php echo consultarCategoriasWithSelected($con, $cat); ?>
                        </select>
                    </div>
                </div>

                <hr class="my-4 mx-n4">
                <h6>3. Bundle Images</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="product_img1">Bundle Image 1</label>
                        <input type="file" id="product_img1" class="form-control" name="product_img1">
                        <?php if (!empty($p_image1)) : ?>
                            <center><img src="product_images/<?php echo $p_image1; ?>" height="150"></center>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="product_img2">Bundle Image 2</label>
                        <input type="file" id="product_img2" class="form-control" name="product_img2">
                        <?php if (!empty($p_image2)) : ?>
                            <center><img src="product_images/<?php echo $p_image2; ?>" height="150"></center>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="product_img3">Bundle Image 3</label>
                        <input type="file" id="product_img3" class="form-control" name="product_img3">
                        <?php if (!empty($p_image3)) : ?>
                            <center><img src="product_images/<?php echo $p_image3; ?>" height="150"></center>
                        <?php endif; ?>
                    </div>
                </div>


                <hr class="my-4 mx-n4">

                <h6>4. Bundle Price, Bundle Sale Price and Bundle Keywords</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="product_price">Bundle Price</label>
                        <input type="text" id="product_price" class="form-control" name="product_price"
                               required value="<?php echo $p_price; ?>" >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="psp_price">Bundle Sale Price</label>
                        <input type="text" id="psp_price" class="form-control" name="psp_price"
                               value="<?php echo $psp_price; ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="product_keywords">Bundle Keywords</label>
                        <input type="text" id="product_keywords" class="form-control" name="product_keywords"
                               value="<?php echo $p_keywords; ?>" >
                    </div>
                </div>

                <hr class="my-4 mx-n4">

                <div class="row g-3">
                    <div class="col-md-6">
                        <h6>5. Bundle Color, Size, Quantity</h6>
                    </div>

                    <div class="col-md-3" id="new_fields">
                        <button class="btn btn-primary" id="show_add_form"><i class="ti ti-shopping-cart-plus"></i></button>
                    </div>
                </div>

                <?php
                // Mostrar campos de color, talla y cantidad
                displayColorSizeFields($con, $p_id); ?>
                <div class="form-group">
                    <input type="hidden" name="deleted_fields" id="deleted_fields" value="">
                </div>
                <div class="form-group">
                    <input type="hidden" name="updated_fields" id="updated_fields" value="">
                </div>

                <div class="form-group" ><!-- form-group Starts -->
                    <input type="hidden" name="updated_fields_add" id="updated_fields_add" value="">
                </div>

                <hr class="my-4 mx-n4">





    <h6>6. Bundle Tabs</h6>
    <div class="card text-center mb-3">
        <div class="card-header pt-1">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#description" aria-controls="description" aria-selected="true">
                        Description
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#features" aria-controls="features" aria-selected="false" tabindex="-1">
                        Features
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#video" aria-controls="video" aria-selected="false" tabindex="-1">
                        Video
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body pt-3">
            <div class="tab-content p-0">
                <div id="description" class="tab-pane fade show active" role="tabpanel">
                    <br>
                    <textarea name="product_desc" class="form-control" rows="5" id="product_desc"><?php echo $p_desc ?></textarea>
                </div>
                <div id="features" class="tab-pane fade" role="tabpanel">
                    <br>
                    <textarea name="product_features" class="form-control" rows="5" id="product_features"><?php echo $p_features ?></textarea>
                </div>
                <div id="video" class="tab-pane fade" role="tabpanel">
                    <br>
                    <textarea name="product_video" class="form-control" rows="5" id="product_video"><?php echo $p_video ?></textarea>
                </div>
            </div>
        </div>
    </div>


                <h6>6.  Bundle Label</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="product_label">Bundle Label</label>
                        <input type="text" id="product_label" class="form-control" name="product_label"
                               required value="<?php echo $p_label; ?>" >
                    </div>
                    <div class="col-md-6" >
                        <label class="form-label" for="update">Update</label>
                        <input type="submit" name="update" value="Update Bundle" class="btn btn-primary form-control" >
                    </div>
                </div>
        </form><!-- form-horizontal Ends -->
    </div><!-- panel-body Ends -->
</div>
</div>


<!-- Se incluye el script de la funcion de editar productos -->
<script src="script_edit_products.js"> </script>




<?php

if(isset($_POST['update'])){

$product_title = $_POST['product_title'];
$product_cat = $_POST['product_cat'];
$cat = $_POST['cat'];
$manufacturer_id = $_POST['manufacturer'];
$product_price = $_POST['product_price'];
$product_desc = $_POST['product_desc'];
$product_keywords = $_POST['product_keywords'];

$psp_price = $_POST['psp_price'];

$product_label = $_POST['product_label'];

$product_url = $_POST['product_url'];

$product_features = $_POST['product_features'];

$product_video = $_POST['product_video'];

$status = "bundle";

$product_img1 = $_FILES['product_img1']['name'];
$product_img2 = $_FILES['product_img2']['name'];
$product_img3 = $_FILES['product_img3']['name'];

$temp_name1 = $_FILES['product_img1']['tmp_name'];
$temp_name2 = $_FILES['product_img2']['tmp_name'];
$temp_name3 = $_FILES['product_img3']['tmp_name'];

if(empty($product_img1)){

$product_img1 = $new_p_image1;

}


if(empty($product_img2)){

$product_img2 = $new_p_image2;

}

if(empty($product_img3)){

$product_img3 = $new_p_image3;

}


move_uploaded_file($temp_name1,"product_images/$product_img1");
move_uploaded_file($temp_name2,"product_images/$product_img2");
move_uploaded_file($temp_name3,"product_images/$product_img3");

$update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',manufacturer_id='$manufacturer_id',date=NOW(),product_title='$product_title',product_url='$product_url',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',product_price='$product_price',product_psp_price='$psp_price',product_desc='$product_desc',product_features='$product_features',product_video='$product_video',product_keywords='$product_keywords',product_label='$product_label',status='$status' where product_id='$p_id'";

$run_product = mysqli_query($con,$update_product);

// Llamadas a los métodos según sea necesario
    deleteProductStock($con);
    updateProductStock($con);
    addProductStock($con, $p_id);
    updateStockTotal($con, $p_id);



if($run_product){

echo "<script> alert('Bundle has been updated successfully') </script>";

echo "<script>window.open('index.php?view_bundles','_self')</script>";

}

}

?>

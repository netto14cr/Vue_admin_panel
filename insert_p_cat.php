<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <span class="text-muted fw-light">Dashboard /</span> Insert Product Category
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card"><!-- card Starts -->
            <div class="card-header"><!-- card-header Starts -->
                <h3 class="card-title"><!-- card-title Starts -->
                    <i class="fa fa-money fa-fw"></i> Insert Product Category
                </h3><!-- card-title Ends -->
            </div><!-- card-heading Ends -->

            <div class="card-body"><!-- card-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Product Category Title</label>
                        <div class="col-md-6">
                            <input type="text" name="p_cat_title" class="form-control">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Show as Top Product Category</label>
                        <div class="col-md-6">
                            <input type="radio" name="p_cat_top" value="yes" id="yes">
                            <label for="yes">Yes</label>
                            <input type="radio" name="p_cat_top" value="no" id="no">
                            <label for="no">No</label>
                        </div>
                    </div><!-- form-group Ends -->


                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Select Category Image</label>
                        <div class="col-md-6">
                            <input type="file" name="p_cat_image" id="p_cat_image" class="form-control" onchange="previewImage(this)">
                            <div class="v-card-text mt-2">
                                <span class="text-muted">Recommended size: 512x512</span>
                            </div>
                            <img id="image_preview" src="#" alt="Preview" style="max-height: 150px; display: none;">
                        </div>
                    </div><!-- form-group Ends -->


                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Submit Now" class="btn btn-primary form-control">
                        </div>
                    </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->
            </div><!-- card-body Ends -->
        </div><!-- card Ends -->

    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->

<script>
    function previewImage(input) {
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




<?php

if(isset($_POST['submit'])){

$p_cat_title = $_POST['p_cat_title'];

$p_cat_top = $_POST['p_cat_top'];

$p_cat_image = $_FILES['p_cat_image']['name'];

$temp_name = $_FILES['p_cat_image']['tmp_name'];

move_uploaded_file($temp_name,"other_images/$p_cat_image");

$insert_p_cat = "insert into product_categories (p_cat_title,p_cat_top,p_cat_image) values ('$p_cat_title','$p_cat_top','$p_cat_image')";

$run_p_cat = mysqli_query($con,$insert_p_cat);

if($run_p_cat){

echo "<script>alert('New Product Category Has been Inserted')</script>";

echo "<script>window.open('index.php?view_p_cats','_self')</script>";

}



}



?>


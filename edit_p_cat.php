
<?php

if(isset($_GET['edit_p_cat'])){

$edit_p_cat_id = $_GET['edit_p_cat'];

$edit_p_cat_query = "select * from product_categories where p_cat_id='$edit_p_cat_id'";

$run_edit = mysqli_query($con,$edit_p_cat_query);

$row_edit = mysqli_fetch_array($run_edit);

$p_cat_id = $row_edit['p_cat_id'];

$p_cat_title = $row_edit['p_cat_title'];

$p_cat_top = $row_edit['p_cat_top'];

$p_cat_image = $row_edit['p_cat_image'];

$new_p_cat_image = $row_edit['p_cat_image'];

}


?>

<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <i class="fa fa-dashboard"></i> Dashboard / Edit Product Category
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card"><!-- card Starts -->
            <div class="card-header"><!-- card-header Starts -->
                <h3 class="card-title"><!-- card-title Starts -->
                    <i class="fa fa-money fa-fw"></i> Edit Product Category
                </h3><!-- card-title Ends -->
            </div><!-- card-heading Ends -->

            <div class="card-body"><!-- card-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Product Category Title</label>
                        <div class="col-md-6">
                            <input type="text" name="p_cat_title" class="form-control" value="<?php echo $p_cat_title; ?>">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Show as Top Product Category</label>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="p_cat_top" id="p_cat_top_yes" value="yes" <?php if($p_cat_top == 'yes') echo 'checked'; ?>>
                                <label class="form-check-label" for="p_cat_top_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="p_cat_top" id="p_cat_top_no" value="no" <?php if($p_cat_top == 'no') echo 'checked'; ?>>
                                <label class="form-check-label" for="p_cat_top_no">No</label>
                            </div>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label">Select Category Image</label>
                        <div class="col-md-6">
                            <input type="file" name="p_cat_image" id="p_cat_image_input" class="form-control" onchange="previewImage(this)">
                            <div class="v-card-text mt-2">
                                <span class="text-muted">Recommended size: 512x512</span>
                            </div>
                            <img id="p_cat_image_preview" src="other_images/<?php echo $p_cat_image; ?>" alt="Preview" style="max-height: 130px;">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group mb-3"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="update" value="Update Now" class="btn btn-primary form-control">
                        </div>
                    </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->
            </div><!-- card-body Ends -->
        </div><!-- card Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->


<script>
    function previewImage(input) {
        var preview = document.getElementById('p_cat_image_preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = 'other_images/<?php echo $p_cat_image; ?>';
            preview.style.display = 'none';
        }
    }
</script>



<?php

if(isset($_POST['update'])){

$p_cat_title = $_POST['p_cat_title'];

$p_cat_top = $_POST['p_cat_top'];

$p_cat_image = $_FILES['p_cat_image']['name'];

$temp_name = $_FILES['p_cat_image']['tmp_name'];


move_uploaded_file($temp_name,"other_images/$p_cat_image");

if(empty($p_cat_image)){

$p_cat_image = $new_p_cat_image;

}

$update_p_cat = "update product_categories set p_cat_title='$p_cat_title',p_cat_top='$p_cat_top',p_cat_image='$p_cat_image' where p_cat_id='$p_cat_id'";

$run_p_cat = mysqli_query($con,$update_p_cat);

if($run_p_cat){

echo "<script>alert('Product Category has been Updated')</script>";

echo "<script>window.open('index.php?view_p_cats','_self')</script>";

}



}



?>




<?php

if(isset($_GET['edit_manufacturer'])){

$edit_manufacturer = $_GET['edit_manufacturer'];

$get_manufacturer = "select * from manufacturers where manufacturer_id='$edit_manufacturer'";

$run_manufacturer = mysqli_query($con,$get_manufacturer);

$row_manufacturer = mysqli_fetch_array($run_manufacturer);

$m_id = $row_manufacturer['manufacturer_id'];

$m_title = $row_manufacturer['manufacturer_title'];

$m_top = $row_manufacturer['manufacturer_top'];

$m_image = $row_manufacturer['manufacturer_image'];

$new_m_image = $row_manufacturer['manufacturer_image'];


}


?>

<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / Edit Manufacturer
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card"><!-- panel panel-default Starts -->
            <div class="card-header"><!-- panel-heading Starts -->
                <h3 class="card-title"><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw"> </i> Edit Manufacturer
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->

            <div class="card-body"><!-- panel-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"> Manufacturer Name </label>
                        <div class="col-md-6">
                            <input type="text" name="manufacturer_name" class="form-control" value="<?php echo $m_title; ?>">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"> Show as Top Manufacturers </label>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="manufacturer_top" value="yes" <?php if($m_top == 'no'){}else{ echo "checked='checked'"; } ?> >
                                <label class="form-check-label" for="manufacturer_top_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="manufacturer_top" value="no" <?php if($m_top == 'no'){ echo "checked='checked'"; }else{} ?> >
                                <label class="form-check-label" for="manufacturer_top_no">No</label>
                            </div>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"> Select Manufacturer Image </label>
                        <div class="col-md-6">
                            <input type="file" name="manufacturer_image" class="form-control" onchange="previewImage(this)"
                            <br>
                            <img id="manufacturer_image_preview" src="other_images/<?php echo $m_image; ?>" alt="Preview" style="max-height: 130px;">
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group"><!-- form-group Starts -->
                        <label class="col-md-3 control-label"> </label>
                        <div class="col-md-6">
                            <input type="submit" name="update" class="form-control btn btn-primary" value=" Update Manufacturer " >
                        </div>
                    </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->
            </div><!-- panel-body Ends -->
        </div><!-- panel panel-default Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->


<script>
    function previewImage(input) {
        var preview = document.getElementById('manufacturer_image_preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = 'other_images/<?php echo $m_image; ?>';
            preview.style.display = 'none';
        }
    }
</script>


<?php

if(isset($_POST['update'])){

$manufacturer_name = $_POST['manufacturer_name'];

$manufacturer_top = $_POST['manufacturer_top'];

$manufacturer_image = $_FILES['manufacturer_image']['name'];

$tmp_name = $_FILES['manufacturer_image']['tmp_name'];

move_uploaded_file($tmp_name,"other_images/$manufacturer_image");

if(empty($manufacturer_image)){

$manufacturer_image = $new_m_image;

}

$update_manufacturer = "update manufacturers set manufacturer_title='$manufacturer_name',manufacturer_top='$manufacturer_top',manufacturer_image='$manufacturer_image' where manufacturer_id='$m_id'";

$run_manufacturer = mysqli_query($con,$update_manufacturer);

if($run_manufacturer){

echo "<script>alert('Manufacturer Has Been Updated')</script>";

echo "<script>window.open('index.php?view_manufacturers','_self')</script>";

}

}

?>



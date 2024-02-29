<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
} else {
    if (isset($_GET['edit_size'])) {
        $edit_id = $_GET['edit_size'];
        $edit_size = "SELECT sizes.*, categories.cat_title FROM sizes JOIN categories ON sizes.size_cat_id = categories.cat_id WHERE size_id='$edit_id'";
        $run_edit = mysqli_query($con, $edit_size);
        $row_edit = mysqli_fetch_array($run_edit);

        $size_id = $row_edit['size_id'];
        $size_name = $row_edit['size_name'];
        $size_letter = $row_edit['size_letter'];
        $size_cat_id = $row_edit['size_cat_id'];
        $cat_title = $row_edit['cat_title'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> Dashboard / Edit Size
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Edit Size
                    </h3>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Size Name</label>
                            <div class="col-md-6">
                                <input type="text" name="size_name" class="form-control" value="<?php echo $size_name; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Size Letter</label>
                            <div class="col-md-6">
                                <input type="text" name="size_letter" class="form-control" value="<?php echo $size_letter; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Category</label>
                            <div class="col-md-6">
                                <select name="size_cat_id" class="form-control" required>
                                    <?php
                                    $get_cats = "SELECT * FROM categories";
                                    $run_cats = mysqli_query($con, $get_cats);
                                    while ($row_cats = mysqli_fetch_array($run_cats)) {
                                        $cat_id = $row_cats['cat_id'];
                                        $cat_title = $row_cats['cat_title'];
                                        echo "<option value='$cat_id' " . ($size_cat_id == $cat_id ? 'selected' : '') . ">$cat_title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-3">
                                <input type="submit" name="update" value="Update Size"  class="btn btn-primary form-control">
                            </div>
                            <!-- Botón de Cancelar -->
                            <div class="col-md-3">
                                <a href="index.php?view_sizes" class="btn btn-primary form-control" style="background-color: #9e9e9e">Cancelar</a>
                            </div>
                        </div>




                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $size_name = mysqli_real_escape_string($con, $_POST['size_name']);
        $size_letter = mysqli_real_escape_string($con, $_POST['size_letter']);
        $size_cat_id = $_POST['size_cat_id'];

        $update_size = "UPDATE sizes SET size_name='$size_name', size_letter='$size_letter', size_cat_id='$size_cat_id' WHERE size_id='$size_id'";
        $run_size = mysqli_query($con, $update_size);

        if ($run_size) {
            echo "<script>alert('One Size Has Been Updated')</script>";
            echo "<script>window.open('index.php?view_sizes', '_self')</script>";
        }
    }
    ?>
<?php } ?>

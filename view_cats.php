    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Categories</h4>
    <button class="btn btn-primary" onclick="window.open('index.php?insert_cat','_self')">Add Category</button>


    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header"><i class="ti ti-category"></i> View Categories </h5>
        <div class="table-responsive text-nowrap">

<table class="table"><!-- table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>


    <th style="text-align: center">Id</th>
    <th style="text-align: center">Name</th>
    <th style="text-align: center">Image</th>
    <th style="text-align: center">Top</th>
    <th style="text-align: center">Actions</th>


</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php 

$i=0;

$get_cats = "select * from categories";

$run_cats = mysqli_query($con,$get_cats);

while($row_cats = mysqli_fetch_array($run_cats)){

$cat_id = $row_cats['cat_id'];

$cat_title = $row_cats['cat_title'];
$cat_image = $row_cats['cat_image'];
$cat_top = $row_cats['cat_top'];


$i++;



?>

<tr align="center">

<td><?php echo $cat_id; ?></td>

<td><?php echo $cat_title; ?></td>
<td><img src="other_images/<?php echo $cat_image; ?>" width="30" height="30"></td>
<td><?php echo $cat_top; ?></td>





<td>
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ti ti-dots-vertical"></i>
        </button>
        <div class="dropdown-menu" style="">
            <a class="dropdown-item" href="index.php?edit_cat=<?php echo $cat_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
            <a class="dropdown-item" href="index.php?delete_cat=<?php echo $cat_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
        </div>
    </div>
</td>


</tr>


<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table-bordered table-hover table-striped Ends -->


</div><!-- table-responsive Ends -->
    </div> <!-- / .card -->

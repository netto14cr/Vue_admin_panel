
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Manufacturers</h4>
<button class="btn btn-primary" onclick="window.open('index.php?insert_manufacturer','_self')">Add Manufacturers</button>


<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Manufacturers </h5>
    <div class="table-responsive text-nowrap">

        <table class="table"><!-- table-bordered -->

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

$i = 0;

$get_manufacturers = "select * from manufacturers";

$run_manufacturers = mysqli_query($con,$get_manufacturers);

while($row_manufacturers = mysqli_fetch_array($run_manufacturers)){

$manufacturer_id = $row_manufacturers['manufacturer_id'];

$manufacturer_title = $row_manufacturers['manufacturer_title'];
$manufacturer_image = $row_manufacturers['manufacturer_image'];
$manufacturer_top = $row_manufacturers['manufacturer_top'];

$i++;

?>

    <tr align="center">

<td><?php echo $i; ?></td>

<td><?php echo $manufacturer_title; ?></td>

    <td><img src="other_images/<?php echo $manufacturer_image; ?>" width="30" height="30"></td>


    <td> <?php echo $manufacturer_top; ?> </td>

        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="index.php?edit_manufacturer=<?php echo $manufacturer_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                    <a class="dropdown-item" href="index.php?delete_manufacturer=<?php echo $manufacturer_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
                </div>
            </div>
        </td>



</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends --->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->


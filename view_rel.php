


<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Relations</h4>
<button class="btn btn-primary" onclick="window.open('index.php?insert_rel','_self')">Add Relation</button>


<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Relations </h5>
    <div class="table-responsive text-nowrap">

        <table class="table"><!-- table-bordered -->


<thead> <!-- thead Starts   -->

<tr>

<th style="text-align: center">#</th>

<th style="text-align: center">Title</th>

<th style="text-align: center">Product</th>

<th style="text-align: center">Bundle</th>

<th style="text-align: center">Actions</th>



</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php

$i = 0;


$get_rel = "select * from bundle_product_relation";

$run_rel = mysqli_query($con,$get_rel);

while($row_rel = mysqli_fetch_array($run_rel)){

$rel_id = $row_rel['rel_id'];

$rel_title = $row_rel['rel_title'];

$bundle_id = $row_rel['bundle_id'];

$product_id = $row_rel['product_id'];

$get_p = "select * from products where product_id='$product_id'";

$run_p = mysqli_query($con,$get_p);

$row_p = mysqli_fetch_array($run_p);

$p_title = $row_p['product_title'];


$get_b = "select * from products where product_id='$bundle_id'";

$run_b = mysqli_query($con,$get_b);

$row_b = mysqli_fetch_array($run_b);

$b_title = $row_b['product_title'];

$i++;

?>

<tr align="center">

<td> <?php echo $i; ?> </td>

<td> <?php echo $rel_title; ?> </td>

<td> <?php echo $p_title; ?> </td>

<td> <?php echo $b_title; ?> </td>
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="index.php?edit_rel=<?php echo $rel_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                <a class="dropdown-item" href="index.php?delete_rel=<?php echo $rel_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>




</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->


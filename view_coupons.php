

    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Coupons</h4>
    <button class="btn btn-primary" onclick="window.open('index.php?insert_coupons','_self')">Add Coupons</button>


    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Coupons </h5>
        <div class="table-responsive text-nowrap">

<table class="table"><!-- table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>

<td>#</td>
<td>Title</td>
<td>Product</td>
<td>Coupon Price</td>
<td>Code</td>
<td>Limit</td>
<td>Used</td>
<td>Actions</td>



</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php

$i = 0;

$get_coupons = "select * from coupons";

$run_coupons = mysqli_query($con,$get_coupons);

while($row_coupons = mysqli_fetch_array($run_coupons)){

$coupon_id = $row_coupons['coupon_id'];

$product_id = $row_coupons['product_id'];

$coupon_title = $row_coupons['coupon_title'];

$coupon_price = $row_coupons['coupon_price'];

$coupon_code = $row_coupons['coupon_code'];

$coupon_limit = $row_coupons['coupon_limit'];

$coupon_used = $row_coupons['coupon_used'];


$get_products = "select * from products where product_id='$product_id'";

$run_products = mysqli_query($con,$get_products);

$row_products = mysqli_fetch_array($run_products);

$product_title = $row_products['product_title'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td><?php echo $coupon_title; ?></td>

<td><?php echo $product_title; ?></td>

<td><?php echo "$$coupon_price"; ?></td>

<td><?php echo $coupon_code; ?></td>

<td><?php echo $coupon_limit; ?></td>

<td><?php echo $coupon_used; ?></td>

    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="index.php?edit_coupon=<?php echo $coupon_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                <a class="dropdown-item" href="index.php?delete_coupon=<?php echo $coupon_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>



</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->

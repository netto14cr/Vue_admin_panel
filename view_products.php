    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Products</h4>
    <button class="btn btn-primary" onclick="window.open('index.php?insert_product','_self')">Add Product</button>


    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Products </h5>
        <div class="table-responsive text-nowrap">

<table class="table"><!-- table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>
<th>#</th>
<th>Title</th>
<th>Image</th>
<th>Price</th>
<th>Sold</th>
<th>Keywords</th>
<th>Date</th>
<th>Actions</th>


</tr>

</thead>

<tbody>

<?php

$i = 0;

$get_pro = "select * from products where status='product'";

$run_pro = mysqli_query($con,$get_pro);

while($row_pro=mysqli_fetch_array($run_pro)){

$pro_id = $row_pro['product_id'];

$pro_title = $row_pro['product_title'];

$pro_image = $row_pro['product_img1'];

$pro_price = $row_pro['product_price'];

$pro_keywords = $row_pro['product_keywords'];

$pro_date = $row_pro['date'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td><?php echo $pro_title; ?></td>

<td><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"></td>

<td><?php echo $pro_price; ?></td>

<td>
<?php

$get_sold = "select * from pending_orders where product_id='$pro_id'";
$run_sold = mysqli_query($con,$get_sold);
$count = mysqli_num_rows($run_sold);
echo $count;
?>
</td>

<td> <?php echo $pro_keywords; ?> </td>

<td><?php echo $pro_date; ?></td>


    <td align="center">
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="index.php?edit_product=<?php echo $pro_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                <a class="dropdown-item" href="index.php?delete_product=<?php echo $pro_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>


</tr>

<?php } ?>


</tbody>


</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->


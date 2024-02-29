
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Enquiry Types</h4>
<button class="btn btn-primary" onclick="window.open('index.php?insert_enquiry','_self')">Add Enquiry Type</button>


<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Enquiry Types </h5>
    <div class="table-responsive text-nowrap">

        <table class="table"><!-- table-bordered -->
<thead>

<tr>

<th style="text-align: center">#</th>

<th style="text-align: center">Enquiry Type Title</th>

<th style="text-align: center">Actions</th>


</tr>

</thead>

<tbody><!-- tbody Starts -->

<?php

$i = 0;

$get_enquiry_types = "select * from enquiry_types";

$run_enquiry_types = mysqli_query($con,$get_enquiry_types);

while($row_enquiry_types = mysqli_fetch_array($run_enquiry_types)){

$enquiry_id = $row_enquiry_types['enquiry_id'];

$enquiry_title = $row_enquiry_types['enquiry_title'];

$i++;

?>

<tr align="center">

<td> <?php echo $i; ?> </td>

<td> <?php echo $enquiry_title; ?> </td>

    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="index.php?edit_enquiry=<?php echo $enquiry_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                <a class="dropdown-item" href="index.php?delete_enquiry=<?php echo $enquiry_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>




</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->



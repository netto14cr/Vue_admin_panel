
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Sizes</h4>


<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">
        <div class="row">
            <div class="col-md-6">View Sizes</div>
            <div class="col-md-6" align="right">
                <button class="btn btn-primary" onclick="window.open('index.php?insert_size','_self')">Add Sizes</button>
            </div>
        </div>
    <div class="table-responsive text-nowrap">

        <table class="table"><!-- table-bordered -->
                            <thead>
                            <tr>
                                <th style="text-align: center">Size Id</th>
                                <th style="text-align: center">Size Name</th>
                                <th style="text-align: center">Size Letter</th>
                                <th style="text-align: center">Category</th>
                                <th style="text-align: center">Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i = 0;
                            $get_sizes = "SELECT sizes.*, categories.cat_title FROM sizes JOIN categories ON sizes.size_cat_id = categories.cat_id";
                            $run_sizes = mysqli_query($con, $get_sizes);

                            while ($row_sizes = mysqli_fetch_array($run_sizes)) {
                                $size_id = $row_sizes['size_id'];
                                $size_name = $row_sizes['size_name'];
                                $size_letter = $row_sizes['size_letter'];
                                $cat_title = $row_sizes['cat_title'];
                                $i++;
                                ?>
                                <tr align="center">
                                    <td><?php echo $size_id; ?></td>
                                    <td><?php echo $size_name; ?></td>
                                    <td><?php echo $size_letter; ?></td>
                                    <td><?php echo $cat_title; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="index.php?edit_size=<?php echo $size_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="index.php?delete_size=<?php echo $size_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
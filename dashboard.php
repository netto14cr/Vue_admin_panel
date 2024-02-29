<!-- 2nd row -->
<div class="row">
    <?php

    $widgets = array(
        array('count' => $_SESSION['count_products'] , 'label' => 'Products', 'link' => 'index.php?view_products', 'icon' => 'fa-tasks', 'panel_color' => 'bg-white', 'icon_color' => 'text-primary'),
        array('count' => $_SESSION['count_customers'], 'label' => 'Customers', 'link' => 'index.php?view_customers', 'icon' => 'fa-comments', 'panel_color' => 'bg-white', 'icon_color' => 'text-info'),
        array('count' => $_SESSION['count_p_categories'], 'label' => 'Products Categories', 'link' => 'index.php?view_p_cats', 'icon' => 'fa-shopping-cart', 'panel_color' => 'bg-white', 'icon_color' => 'text-danger'),
        array('count' => $_SESSION['count_total_orders'], 'label' => 'Orders', 'link' => 'index.php?view_orders', 'icon' => 'fa-support', 'panel_color' => 'bg-white', 'icon_color' => 'text-success'),
        array('count' => $_SESSION['count_total_earnings'], 'label' => 'Earnings', 'link' => 'index.php?view_orders', 'icon' => 'fa-dollar', 'panel_color' => 'bg-white', 'icon_color' => 'text-warning'),
        array('count' => $_SESSION['count_pending_orders'], 'label' => 'Pending Orders', 'link' => 'index.php?view_orders', 'icon' => 'fa-spinner', 'panel_color' => 'bg-white', 'icon_color' => 'text-info'),
        array('count' => $_SESSION['count_completed_orders'], 'label' => 'Completed Orders', 'link' => 'index.php?view_orders', 'icon' => 'fa-check', 'panel_color' => 'bg-white', 'icon_color' => 'text-warning'),
        array('count' => $_SESSION['count_coupons'], 'label' => 'Total Coupons', 'link' => 'index.php?view_coupons', 'icon' => 'fa-percent', 'panel_color' => 'bg-white', 'icon_color' => 'text-danger')
    );

    foreach ($widgets as $widget) {
        ?>
        <div class="col-md-3 col-6">
            <div class="card <?php echo $widget['panel_color']; ?> h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0 <?php echo $widget['icon_color']; ?>"><i class="fa <?php echo $widget['icon']; ?> ti-sm"></i> <?php echo $widget['label']; ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="card-info">
                            <h5 class="mb-0"><?php echo $widget['count']; ?></h5>
                            <small><?php echo $widget['label']; ?></small>
                        </div>
                    </div>
                </div>
                <a href="<?php echo $widget['link']; ?>">
                    <div class="card-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <?php
    }
    ?>
</div>





<br> <!-- end of 2nd row -->
<!-- 3rd row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-money fa-fw"></i> New Orders
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Invoice No</th>
                            <th>Product ID</th>
                            <th>Qty</th>
                            <th>Size</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        function getCustomerEmail($con, $customerId) {
                            $get_customer = "SELECT * FROM customers WHERE customer_id='$customerId'";
                            $run_customer = mysqli_query($con, $get_customer);
                            $row_customer = mysqli_fetch_array($run_customer);
                            return $row_customer['customer_email'];
                        }

                        $i = 0;
                        $get_order = "SELECT * FROM pending_orders ORDER BY 1 DESC LIMIT 0,5";
                        $run_order = mysqli_query($con, $get_order);

                        while ($row_order = mysqli_fetch_array($run_order)) {
                            $order_id = $row_order['order_id'];
                            $c_id = $row_order['customer_id'];
                            $invoice_no = $row_order['invoice_no'];
                            $product_id = $row_order['product_id'];
                            $qty = $row_order['qty'];
                            $size = $row_order['size'];
                            $order_status = $row_order['order_status'];
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo getCustomerEmail($con, $c_id); ?></td>
                                <td><?php echo $invoice_no; ?></td>
                                <td><?php echo $product_id; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $size; ?></td>
                                <td><?php echo ($order_status == 'pending') ? 'pending' : 'Complete'; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?view_orders">
                        View All Orders <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

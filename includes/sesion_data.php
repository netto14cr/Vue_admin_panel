<?php


$admin_session = $_SESSION['admin_email'];
$get_admin = "select * from admins  where admin_email='$admin_session'";
$run_admin = mysqli_query($con,$get_admin);
$row_admin = mysqli_fetch_array($run_admin);



$_SESSION['admin_id'] = $row_admin['admin_id'];
$_SESSION['admin_name'] = $row_admin['admin_name'];
$_SESSION['admin_email'] = $row_admin['admin_email'];
$_SESSION['admin_image'] = $row_admin['admin_image'];
$_SESSION['admin_country'] = $row_admin['admin_country'];
$_SESSION['admin_job'] = $row_admin['admin_job'];
$_SESSION['admin_contact'] = $row_admin['admin_contact'];
$_SESSION['admin_about'] = $row_admin['admin_about'];
$_SESSION['admin_birthday'] = '';






function getCustomers($con){
    $get_customers = "SELECT * FROM customers";
    $run_customers = mysqli_query($con,$get_customers);
    $count_customers = mysqli_num_rows($run_customers);
    return $count_customers;
}

function getCategories($con){
    $get_categories = "SELECT * FROM categories";
    $run_categories = mysqli_query($con,$get_categories);
    return mysqli_num_rows($run_categories);
}

function getAdmins($con){
    $get_admins = "SELECT * FROM admins";
    $run_admins = mysqli_query($con,$get_admins);
    $count_admins = mysqli_num_rows($run_admins);
    return $count_admins;
}


function getCustomersOrders($con){
    $get_customers_orders = "SELECT * FROM customer_orders";
    $run_customers_orders = mysqli_query($con,$get_customers_orders);
    $count_customers_orders = mysqli_num_rows($run_customers_orders);
    return $count_customers_orders;
}


 function getPendingOrders($con)
 {
     $get_pending_orders = "SELECT * FROM customer_orders WHERE order_status='pending'";
     $run_pending_orders = mysqli_query($con, $get_pending_orders);
     $count_pending_orders = mysqli_num_rows($run_pending_orders);
     return $count_pending_orders;
 }

     function getCompletedOrders($con)
     {
         $get_completed_orders = "SELECT * FROM customer_orders WHERE order_status='Complete'";
         $run_completed_orders = mysqli_query($con, $get_completed_orders);
         $count_completed_orders = mysqli_num_rows($run_completed_orders);
         return $count_completed_orders;
     }

     function getTotalOrders($con)
     {
         $get_total_orders = "SELECT * FROM customer_orders";
         $run_total_orders = mysqli_query($con, $get_total_orders);
         return mysqli_num_rows($run_total_orders);
     }


     function getTotalEarnings($con)
     {
         $get_total_earnings = "SELECT SUM( due_amount) as Total FROM customer_orders WHERE order_status = 'Complete'";
         $run_total_earnings = mysqli_query($con, $get_total_earnings);
         $row = mysqli_fetch_assoc($run_total_earnings);
         $total_earnings = $row['Total'];
         return $total_earnings;
     }


     function getCountCoupon($con)
     {
         $get_coupons = "SELECT * FROM coupons";
         $run_coupons = mysqli_query($con, $get_coupons);
         $count_coupons = mysqli_num_rows($run_coupons);
         return $count_coupons;
     }


        function getCountProducts($con)
        {
            $get_products = "SELECT * FROM products";
            $run_products = mysqli_query($con, $get_products);
            $count_products = mysqli_num_rows($run_products);
            return $count_products;
        }

        $_SESSION['count_products'] = getCountProducts($con);
        $_SESSION['count_customers'] = getCustomers($con);
        $_SESSION['count_p_categories'] = getCategories($con);
        $_SESSION['count_admins'] = getAdmins($con);
        $_SESSION['count_pending_orders'] = getPendingOrders($con);
        $_SESSION['count_completed_orders'] = getCompletedOrders($con);
        $_SESSION['count_total_orders'] = getTotalOrders($con);
        $_SESSION['count_total_earnings'] = getTotalEarnings($con);
        $_SESSION['count_coupons'] = getCountCoupon($con);
        $_SESSION['count_customers_orders'] = getCustomersOrders($con);


 ?>
<?php

// Funciones de obtención de datos
function getProductTitle($con, $product_id) {
    $get_product = "SELECT * FROM products WHERE product_id='$product_id'";
    $run_product = mysqli_query($con, $get_product);
    $row_product = mysqli_fetch_array($run_product);

    return ($row_product) ? $row_product['product_title'] : "Producto Eliminado";
}

function getCustomerData($con, $c_id) {
    $get_customer = "SELECT * FROM customers WHERE customer_id='$c_id'";
    $run_customer = mysqli_query($con, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);

    return ($row_customer) ? array(
        'customer_name' => $row_customer['customer_name'],
        'customer_email' => $row_customer['customer_email']
    ) : array(
        'customer_name' => 'Cliente Eliminado',
        'customer_email' => ''
    );
}

// Función de visualización de detalles del pedido
function displayOrderDetails($order_id, $invoice_no,$order_date, $order_status) {
    echo "<tr align='center'>";
    echo "<td>$order_id</td>";
    echo "<td>$invoice_no</td>";
    echo "<td>$order_date</td>";
    echo "<td>$order_status</td>";
    echo "<td>
            <button class='btn btn-primary btn-sm' onclick='showOrderDetailsModal($order_id)'>
            <i class='fa fa-eye'></i></button>
          </td>";
    echo "</tr>";
}




// Función principal para obtener pedidos pendientes
function getPendingOrdersDetails($con) {
    $i = 0;
    $get_orders = "SELECT * FROM pending_orders";
    $run_orders = mysqli_query($con, $get_orders);

    while ($row_orders = mysqli_fetch_array($run_orders)) {
        $order_id = $row_orders['order_id'];
        $customer_id = $row_orders['customer_id'];
        $invoice_no = $row_orders['invoice_no'];
        $product_id = $row_orders['product_id'];
        $qty = $row_orders['qty'];
        $size = $row_orders['size'];
        $order_status = $row_orders['order_status'];

        // Obtener detalles adicionales del pedido desde customer_orders
        $get_customer_order = "SELECT order_date FROM customer_orders WHERE order_id='$order_id'";
        $run_customer_order = mysqli_query($con, $get_customer_order);
        $row_customer_order = mysqli_fetch_array($run_customer_order);
        $order_date = ($row_customer_order) ? $row_customer_order['order_date'] : 'No data found';

        // Mostrar detalles del pedido en una tabla HTML
        displayOrderDetails($order_id, $invoice_no, $order_date, $order_status);

        $i++;
    }
}









?>

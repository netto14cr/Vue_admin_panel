<?php
// Incluir la conexión a la base de datos u otros archivos necesarios
include('includes/db.php');
include('orders_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    if ($order_id) {
        // Obtener detalles del pedido
        $orderDetails = getOrderDetails($con, $order_id);

        if ($orderDetails) {

            //echo '<script>console.log("orderDetails: ", ' . json_encode($orderDetails) . ');</script>';
            // Si se obtienen detalles del pedido, llamar a la función para generar el HTML del modal
            echo generateOrderDetailsModal(
                $orderDetails['order_id'],
                $orderDetails['customer_name'],
                $orderDetails['customer_email'],
                $orderDetails['invoice_no'],
                $orderDetails['product_title'],
                $orderDetails['qty'],
                $orderDetails['size'],
                $orderDetails['order_date'],
                $orderDetails['due_amount'],
                $orderDetails['order_status']
            );
        } else {
            // Manejar el caso en el que no se encuentran detalles del pedido
            echo "<script>alert('No se encontraron detalles para el pedido con ID: $order_id.');</script>";
        }
    } else {
        // Manejar el caso en el que no se proporciona el order_id
        echo "<script>alert('No se proporcionó el ID del pedido.');</script>";
    }
}


// Función para obtener toda la información de un pedido basado en su order_id
function getOrderDetails($con, $order_id) {
    // Obtener detalles del pedido
    $get_order = "SELECT * FROM pending_orders WHERE order_id='$order_id'";
    $run_order = mysqli_query($con, $get_order);
    $row_order = mysqli_fetch_array($run_order);

    if (!$row_order) {
        // Si no se encuentra el pedido, devolver un array vacío o un mensaje de error según tu preferencia
        return array();
    }

    $c_id = $row_order['customer_id'];
    $invoice_no = $row_order['invoice_no'];
    $product_id = $row_order['product_id'];
    $qty = $row_order['qty'];
    $size = $row_order['size'];
    $order_status = $row_order['order_status'];

    // Obtener detalles del producto
    $product_title = getProductTitle($con, $product_id);

    // Obtener detalles del cliente
    $customer_data = getCustomerData($con, $c_id);
    $customer_name = $customer_data['customer_name'];
    $customer_email = $customer_data['customer_email'];

    // Obtener detalles adicionales del pedido
    $get_customer_order = "SELECT * FROM customer_orders WHERE order_id='$order_id'";
    $run_customer_order = mysqli_query($con, $get_customer_order);

    if ($run_customer_order && mysqli_num_rows($run_customer_order) > 0) {
        // Si hay datos en la tabla customer_orders
        $row_customer_order = mysqli_fetch_array($run_customer_order);
        $order_date = date("F d, Y", strtotime($row_customer_order['order_date']));
        $due_amount = $row_customer_order['due_amount'];
    } else {
        return array(); // Devolver un array vacío o un mensaje de error según tu preferencia
    }

    // Devolver un array asociativo con la información del pedido
    return array(
        'order_id' => $order_id,
        'customer_name' => $customer_name,
        'customer_email' => $customer_email,
        'invoice_no' => $invoice_no,
        'product_title' => $product_title,
        'qty' => $qty,
        'size' => $size,
        'order_date' => $order_date,
        'due_amount' => $due_amount,
        'order_status' => $order_status
    );
}





// Función para generar el HTML del modal
function generateOrderDetailsModal($order_id, $customer_name, $customer_email, $invoice_no, $product_title, $qty, $size, $order_date, $due_amount, $order_status) {
    $modalHTML = '
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-3">Order Details - ' . $order_id . '</h3>
                            <p class="text-muted">Details of the selected order</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-success rounded p-2 me-3"><i class="ti ti-hash ti-sm" style="color: #28a745;"></i></div>
                            <h6 class="me-3">Order Id:</h6>
                            <p>' . $order_id . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-danger rounded p-2 me-3"><i class="ti ti-user ti-sm" style="color: #dc3545;"></i></div>
                            <h6 class="me-3">Customer Name:</h6>
                            <p>' . $customer_name . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-info rounded p-2 me-3"><i class="ti ti-mail ti-sm" style="color: #17a2b8;"></i></div>
                            <h6 class="me-3">Customer Email:</h6>
                            <p>' . $customer_email . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-warning rounded p-2 me-3">
                                <i class="ti ti-file-text ti-sm" style="color: #ffc107;"></i></div>
                            <h6 class="me-3">Invoice No:</h6>
                            <p>' . $invoice_no . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-primary rounded p-2 me-3">
                                <i class="ti ti-package ti-sm" style="color: #007bff;"></i>
                            </div>
                            <h6 class="me-3">Product Title:</h6>
                            <p>' . $product_title . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-secondary rounded p-2 me-3"><i class="ti ti-shopping-bag ti-sm" style="color: #6c757d;"></i></div>
                            <h6 class="me-3">Product Qty:</h6>
                            <p>' . $qty . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-danger rounded p-2 me-3">
                                <i class="ti ti-ruler-3 ti-sm" style="color: #dc3545;"></i></div>
                            <h6 class="me-3">Product Size:</h6>
                            <p>' . $size . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-success rounded p-2 me-3"><i class="ti ti-calendar ti-sm" style="color: #28a745;"></i></div>
                            <h6 class="me-3">Order Date:</h6>
                            <p>' . $order_date . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-info rounded p-2 me-3">
                                <i class="ti ti-credit-card ti-sm" style="color: #17a2b8;"></i></div>
                            <h6 class="me-3">Total Amount:</h6>
                            <p>' . $due_amount . '</p>
                        </div><hr>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="badge bg-label-' . ($order_status == 'pending' ? 'warning' : 'success') . ' rounded p-2 me-3">
                                <i class="ti ' . ($order_status == 'pending' ? 'ti-alert-triangle' : 'ti-check') . ' ti-sm text-body"></i>
                            </div>
                            <h6 class="m-0 me-2">Order Status:</h6>';
    if ($order_status == 'pending') {
        $modalHTML .= '<span class="badge bg-label-warning me-1">Pending</span>';
    } else {
        $modalHTML .= '<span class="badge bg-label-success me-1">Completed</span>';
    }

    $modalHTML .= '
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    return $modalHTML;
}


?>

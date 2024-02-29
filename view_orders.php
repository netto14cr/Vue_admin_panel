<?php

include('orders_functions.php');
?>


<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Orders</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Orders </h5>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th style="text-align: center">Id</th>
                <th style="text-align: center">Invoice No</th>
                <th style="text-align: center">Order Date</th>
                <th style="text-align: center">Order Status</th>
                <th style="text-align: center">Actions</th>
            </tr>
            </thead>
            <tbody>

                <tr align="center">
                    <?php
                    // Llamada a la función principal
                    getPendingOrdersDetails($con);
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function showOrderDetailsModal(order_id) {
        console.log('Story aqui', order_id);
        // Hacer una solicitud AJAX para obtener los detalles del pedido
        $.ajax({
            type: "POST",
            url: "get_order_details.php",
            data: { order_id: order_id },
            success: function (data) {
                // Verifica que los datos se están recuperando correctamente
                console.log("Data from server:", data);
                // Llenar el modal con los detalles del pedido
                $("#orderDetailsModalContent").html(data);
                // Mostrar el modal
                $("#orderDetailsModal").modal("show");
            }
        });
    }

</script>



<div class="modal-body" id="orderDetailsModalContent">
    <!-- Contenido del modal se llenará dinámicamente -->
</div>

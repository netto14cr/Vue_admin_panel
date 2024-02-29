<?php

class StoreManager {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    // Método para obtener datos de la tienda desde la base de datos
    public function getStoreData() {
        $get_store = "SELECT * FROM store";
        $run_store = mysqli_query($this->con, $get_store);

        $storeData = array(); // Almacena los datos de la tienda

        while ($row_store = mysqli_fetch_array($run_store)) {
            $storeData[] = array(
                'store_id' => $row_store['store_id'],
                'store_title' => $row_store['store_title'],
                'store_image' => $row_store['store_image'],
                'store_desc' => substr($row_store['store_desc'], 0, 400),
                'store_button' => $row_store['store_button'],
                'store_url' => $row_store['store_url']
            );
        }

        return $storeData;
    }
}

// Crear una instancia de la clase StoreManager
$storeManager = new StoreManager($con);

// Obtener datos de la tienda
$storeData = $storeManager->getStoreData();
?>



<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View store
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card mb-4"><!-- card mb-4 Starts -->
            <div class="card-header d-flex flex-wrap justify-content-between gap-3"><!-- card-header Starts -->
                <div class="card-title mb-0 me-1"><!-- card-title Starts -->
                    <h5 class="mb-1">Store Information</h5>
                    <p class="text-muted mb-0">Total stores:  <?php echo count($storeData); ?></p>
                </div><!-- card-title Ends -->
                <div class="card-actions"><!-- card-actions Starts -->
                    <a class="btn btn-primary" href="index.php?insert_store">Add New Store</a>

            </div><!-- card-header Ends -->

            <div class="card-body"><!-- card-body Starts -->
                <div class="row gy-4 mb-4"><!-- Vuexy card row Starts -->
                    <?php
                    foreach ($storeData as $store) {
                        $store_id = $store['store_id'];
                        $store_title = $store['store_title'];
                        $store_image = $store['store_image'];
                        $store_desc = $store['store_desc'];
                        ?>
                        <div class="col-sm-6 col-lg-4"><!-- col-sm-6 col-lg-4 Starts -->
                            <div class="card p-2 h-100 shadow-none border"><!-- card Starts -->
                                <div class="rounded-2 text-center mb-3"><!-- card image container Starts -->
                                    <img class="img-fluid" src="store_images/<?php echo $store_image; ?>"
                                         alt="<?php echo $store_title; ?>" style="max-height: 300px;">
                                </div><!-- card image container Ends -->
                                <div class="card-body p-3 pt-2"><!-- card body Starts -->
                                    <div class="d-flex justify-content-between align-items-center mb-3"><!-- card header Starts -->
                                        <span class="badge bg-label-primary"><?php echo $store_title; ?></span>
                                        <!-- Add other relevant information dynamically here -->
                                    </div><!-- card header Ends -->
                                    <a href="#" class="h5"><?php echo $store_title; ?></a>
                                    <p class="mt-2"><?php echo $store_desc; ?></p>
                                </div><!-- card body Ends -->
                                <div class="card-footer"><!-- card footer Starts -->
                                    <a href="index.php?delete_store=<?php echo $store_id; ?>" class="btn btn-label-danger">
                                        <i class="  ti ti-trash "></i> Delete
                                    </a>
                                    <a href="index.php?edit_store=<?php echo $store_id; ?>" class="btn btn-label-primary pull-right">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                </div>

                            </div><!-- card Ends -->
                        </div><!-- col-sm-6 col-lg-4 Ends -->
                    <?php } ?>
                </div><!-- Vuexy card row Ends -->
            </div><!-- card-body Ends -->
                <!--
                <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">  pagination Starts
                    <ul class="pagination">
                        <li class="page-item prev">
                            <a class="page-link waves-effect" href="javascript:void(0);"><i class="ti ti-chevron-left ti-xs scaleX-n1-rtl"></i></a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link waves-effect" href="javascript:void(0);">1</a>
                        </li>
                        Add more pagination links dynamically here
                        <li class="page-item next">
                            <a class="page-link waves-effect" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs scaleX-n1-rtl"></i></a>
                        </li>
                    </ul>
                </nav> pagination Ends -->
            </div>
        </div> <!-- card mb-4 Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->







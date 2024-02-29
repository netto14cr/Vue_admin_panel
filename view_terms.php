<?php

class TermManager {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    // Método para obtener datos de los términos desde la base de datos
    public function getTermData() {
        $get_terms = "SELECT * FROM terms";
        $run_terms = mysqli_query($this->con, $get_terms);

        $termData = array(); // Almacena los datos de los términos

        while ($row_terms = mysqli_fetch_array($run_terms)) {
            $termData[] = array(
                'term_id' => $row_terms['term_id'],
                'term_title' => $row_terms['term_title'],
                'term_desc' => substr($row_terms['term_desc'], 0, 400),
            );
        }

        return $termData;
    }
}

// Crear una instancia de la clase TermManager
$termManager = new TermManager($con);

// Obtener datos de los términos
$termData = $termManager->getTermData();
?>

<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Terms
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="card mb-4"><!-- card mb-4 Starts -->
            <div class="card-header d-flex flex-wrap justify-content-between gap-3"><!-- card-header Starts -->
                <div class="card-title mb-0 me-1"><!-- card-title Starts -->
                    <h5 class="mb-1">Term Information</h5>
                    <p class="text-muted mb-0">Total terms:  <?php echo count($termData); ?></p>
                </div><!-- card-title Ends -->
            </div><!-- card-header Ends -->

            <div class="card-body"><!-- card-body Starts -->
                <div class="row gy-4 mb-4"><!-- Vuexy card row Starts -->
                    <?php
                    foreach ($termData as $term) {
                        $term_id = $term['term_id'];
                        $term_title = $term['term_title'];
                        $term_desc = $term['term_desc'];
                        ?>
                        <div class="col-lg-4"><!-- col-lg-4 Starts -->
                            <div class="card p-2 h-100 shadow-none border"><!-- card Starts -->
                                <div class="panel panel-primary"><!-- panel panel-primary Starts -->
                                    <div class="panel-heading"><!-- panel-heading Starts -->
                                        <h3 class="panel-title" align="center"><!-- panel-title Starts -->
                                            <?php echo $term_title; ?>
                                        </h3><!-- panel-title Ends -->
                                    </div><!-- panel-heading Ends -->

                                    <div class="panel-body"><!-- panel-body Starts -->
                                        <?php echo $term_desc; ?>
                                    </div><!-- panel-body Ends -->

                                    <div class="card-footer"><!-- card footer Starts -->
                                        <a href="index.php?delete_term=<?php echo $term_id; ?>" class="btn btn-label-danger">
                                            <i class="  ti ti-trash "></i> Delete
                                        </a>
                                        <a href="index.php?edit_term=<?php echo $term_id; ?>" class="btn btn-label-primary pull-right">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- panel panel-primary Ends -->
                            </div><!-- card Ends -->

                        </div><!-- col-lg-4 Ends -->
                    <?php } ?>
                </div><!-- Vuexy card row Ends -->
            </div><!-- card-body Ends -->
        </div> <!-- card mb-4 Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->

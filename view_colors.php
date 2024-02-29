


    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> View Colors</h4>
    <button class="btn btn-primary" onclick="window.open('index.php?insert_colors','_self')">Add Colors</button>


    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header"><i class="fa fa-money fa-fw"></i> View Colors </h5>
        <div class="table-responsive text-nowrap">

<table class="table"><!-- table-bordered table-hover table-striped Starts -->

    <thead><!-- thead Starts -->
    <tr>
        <th style="text-align: center">Id</th>
        <th style="text-align: center">Color Name</th>
        <th style="text-align: center">Color RGB</th>
        <th style="text-align: center">Color Preview</th>
        <th style="text-align: center">Actions</th>
        <!-- Puedes agregar más columnas según tus necesidades -->
    </tr>
    </thead><!-- thead Ends -->

    <tbody><!-- tbody Starts -->
    <?php
    $i = 0;
    $get_colors = "SELECT * FROM colors";
    $run_colors = mysqli_query($con, $get_colors);

    while ($row_colors = mysqli_fetch_array($run_colors)) {
        $color_id = $row_colors['color_id'];
        $color_name = $row_colors['color_name'];
        $color_rgb = $row_colors['color_rgb'];
        $i++;
        ?>
        <tr align="center">
            <td><?php echo $i; ?></td>
            <td><?php echo $color_name; ?></td>
            <td><?php echo $color_rgb; ?></td>
            <td>
                <!-- Agrega el div para mostrar el color con Spectrum -->
                <div style="width: 30px; height: 30px; background-color: <?php echo $color_rgb; ?>;"></div>
            </td>


            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="index.php?edit_color=<?php echo $color_id; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                        <a class="dropdown-item" href="index.php?delete_color=<?php echo $color_id; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
                    </div>
                </div>
            </td>

    <?php } ?>
    </tbody><!-- tbody Ends -->
</table><!-- table-bordered table-hover table-striped Ends -->
        </div><!-- table-responsive Ends -->
    </div><!-- panel-body Ends -->


<!-- Agrega el script para inicializar Spectrum en la columna Color Preview -->
<script>
    $(document).ready(function () {
        $(".color-preview").spectrum({
            preferredFormat: "hex",
            showInput: false,
            showPalette: false,
        });
    });
</script>

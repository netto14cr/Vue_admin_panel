<?php

include("BannerImage.php");
include("getBannerDetails.php");

?>


<!-- View Banner Images Table -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-header"><i class="ti ti-image"></i> View Banner Images </h5>
        <a href="index.php?insert_banner" class="btn btn-outline-primary">Insert Banner Image</a>
    </div>




    <div class="table-responsive text-nowrap">
        <table class="table"><!-- table-bordered table-hover table-striped Starts -->
            <thead><!-- thead Starts -->
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Section Title</th>
                <th style="text-align: center">Banner Title</th>
                <th style="text-align: center">Image</th>
                <th style="text-align: center">Status</th>
                <th style="text-align: center">Actions</th>
            </tr>
            </thead><!-- thead Ends -->
            <tbody><!-- tbody Starts -->

            <?php
            $bannerManager = new BannerImage($con);
            $banners = $bannerManager->getAllBanners();

            foreach ($banners as $banner) {
                // Ahora puedes acceder a la información de cada banner de manera más organizada
                $bannerId = $banner['banner_id'];
                $sectionTitle = $banner['section_title'];
                $bannerTitle = $banner['banner_title'];
                $image64 = $banner['image_data']['image_data'];
                $img_type = $banner['image_data']['image_extension'];
                $status = $banner['status']; // Agregar el estado del banner
                ?>
                <tr align="center">
                    <td><?php echo $bannerId; ?></td>
                    <td><?php echo $sectionTitle; ?></td>
                    <td><?php echo $bannerTitle; ?></td>

                    <td align="center">
                        <img src="data:image/<?php echo $img_type?>;base64,<?php echo $image64; ?>"
                             style="background-size: auto" height="50" width="50" alt="" class="rounded-circle"></td>


                    <td class="align-middle">
                        <!-- Agregar el interruptor y vincularlo al estado del banner -->
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input status-switch" type="checkbox" id="statusSwitch<?php echo $bannerId; ?>" <?php echo isset($status) && $status == 1 ? 'checked' : ''; ?> data-banner-id="<?php echo $bannerId; ?>">
                            <label class="form-check-label" for="statusSwitch<?php echo $bannerId; ?>"></label>
                        </div>
                    </td>



                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">

                                <a class="dropdown-item" href="index.php?view_one_banner=<?php echo $bannerId; ?>"><i class="ti ti-eye me-1"></i> View</a>
                                <a class="dropdown-item" href="index.php?edit_banner=<?php echo $bannerId; ?>"><i class="ti ti-pencil me-1"></i> Edit</a>
                                <a class="dropdown-item" href="index.php?delete_banner=<?php echo $bannerId; ?>"><i class="ti ti-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

            <?php } ?>

            </tbody><!-- tbody Ends -->
        </table><!-- table-bordered table-hover table-striped Ends -->
    </div><!-- table-responsive Ends -->
</div> <!-- / .card -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Manejar el cambio en el interruptor
        $('.status-switch').change(function() {
            // Obtener el estado actual del interruptor
            var isChecked = $(this).prop('checked');
            // Obtener el ID del banner asociado al interruptor
            var bannerId = $(this).data('banner-id');

            // Mensajes de depuración
            //console.log('isChecked:', isChecked);
            //console.log('bannerId:', bannerId);

            // Enviar una solicitud Ajax para actualizar el estado en la base de datos
            $.ajax({
                url: 'banner_img/update_banner_status.php',
                method: 'POST',
                data: { bannerId: bannerId, isChecked:isChecked},

                success: function(response) {
                    // Manejar la respuesta del servidor si es necesario
                    //console.log(response);
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error('Error al actualizar el estado del banner:', status, error);
                }
            });
        });
    });



</script>

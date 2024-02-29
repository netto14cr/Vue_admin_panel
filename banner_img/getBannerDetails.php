<?php


if (isset($_GET['view_banner_images'])) {
    $bannerId = $_GET['view_banner_images'];
    $bannerManager = new BannerImage($con);
    $bannerDetails = $bannerManager->getBannerDetails($bannerId);
    if ($bannerDetails) {
        $sectionTitle = $bannerDetails['section_title'];
        $bannerTitle = $bannerDetails['banner_title'];
        $description = $bannerDetails['description'];
        $color = $bannerDetails['color'];
        $image64 = $bannerDetails['image_64'];
        ?>

        <!-- Modal -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                        <h5 class="modal-title" id="exampleModalLabel">Banner Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="data:image/jpeg;base64,<?php echo $image64['image_data']; ?>" class="img-fluid" alt="Banner Image">
                            </div>
                            <div class="col-md-8">
                                <h5>Section Title: <?php echo $sectionTitle; ?></h5>
                                <h5>Banner Title: <?php echo $bannerTitle; ?></h5>
                                <p>Description: <?php echo $description; ?></p>
                                <p>Color: <span style="background-color: <?php echo $color['color_rgb']; ?>"><?php echo $color['color_name']; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>

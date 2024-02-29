
                    <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>

                    <!-- Header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="user-profile-header-banner">
                                    <img src="store_images/login1.jpg" alt="Banner image" class="rounded-top" />
                                </div>
                                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                        <img
                                                src="admin_images/<?php echo $_SESSION['admin_image']; ?>"
                                                alt="user image"
                                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                                    </div>
                                    <div class="flex-grow-1 mt-3 mt-sm-5">
                                        <div
                                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                            <div class="user-profile-info">
                                                <h4><?php echo $_SESSION['admin_name']; ?></h4>
                                                <ul
                                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                    <li class="list-inline-item d-flex gap-1">
                                                        <i class="ti ti-color-swatch"></i> <?php echo $_SESSION['admin_job']; ?>
                                                    </li>
                                                    <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i> <?php echo $_SESSION['admin_country']; ?></li>
                                                    <li class="list-inline-item d-flex gap-1">
                                                        <i class="ti ti-calendar"></i> <?php echo $_SESSION['admin_birthday']; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="index.php?user_profile=<?php echo $_SESSION['admin_id']; ?>"
                                               class="btn btn-primary"> <i class="ti ti-user-edit"></i> Edit Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Header -->


                    <!-- User Profile Content -->
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-5">
                            <!-- About User -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <small class="card-text text-uppercase">About</small>
                                    <ul class="list-unstyled mb-4 mt-3">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-user text-heading"></i
                                            ><span class="fw-medium mx-2 text-heading">Full Name:</span> <span><?php echo $_SESSION['admin_name']; ?></span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-check text-heading"></i
                                            ><span class="fw-medium mx-2 text-heading">Status:</span> <span>Active</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-crown text-heading"></i
                                            ><span class="fw-medium mx-2 text-heading">Role:</span> <span> <?php echo $_SESSION['admin_job']; ?></span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-flag text-heading"></i
                                            ><span class="fw-medium mx-2 text-heading">Country:</span> <span> <?php echo $_SESSION['admin_country']; ?></span>
                                        </li>
                                    </ul>
                                    <small class="card-text text-uppercase">Contacts</small>
                                    <ul class="list-unstyled mb-4 mt-3">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span>
                                            <span><?php echo $_SESSION['admin_contact']; ?></span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                                            <span><?php echo $_SESSION['admin_email']; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ About User -->
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7">
                            <!-- Activity Timeline -->
                            <div class="card card-action mb-4">
                                <div class="card-header align-items-center">
                                    <h5 class="card-action-title mb-0">About Me</h5>
                                    <div class="card-action-element">
                                        <div class="dropdown">
                                            <button
                                                    type="button"
                                                    class="btn dropdown-toggle hide-arrow p-0"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="ti ti-dots-vertical text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <ul class="timeline ms-1 mb-0">
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-primary"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header">
                                                    <h6 class="mb-0"><?php echo $_SESSION['admin_about']; ?></h6>
                                                </div>
                                            </div>
                                        </li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ User Profile Content -->
                </div>
                <!-- / Content -->



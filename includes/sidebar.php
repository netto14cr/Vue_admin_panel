
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.php?dashboard" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                          fill="#7367F0" />
                  <path
                          opacity="0.06"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                          fill="#161616" />
                  <path
                          opacity="0.06"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                          fill="#161616" />
                  <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                          fill="#7367F0" />
                </svg>
              </span>
                    <span class="app-brand-text demo menu-text fw-bold">Tienda</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>
            <ul class="menu-inner py-1">

                <!---------------------------   Menu completo   --------------------------->

                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?dashboard" class="menu-link">
                                <div>Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_email" class="menu-link">
                                <div>View email</div>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Banner -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-photo-star"></i>
                        <div data-i18n="Banner">Banner</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_banner" class="menu-link">
                                <div>Insert Banner</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_banner_images" class="menu-link">
                                <div>View Banner</div>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Products -->

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-shirt-sport"></i>
                        <div data-i18n="Products">Products</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_product" class="menu-link">
                                <div>Insert Products</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_products" class="menu-link">
                                <div>View Products</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Bundles -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-shirt"></i>
                        <div data-i18n="Bundles">Bundles</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_bundle" class="menu-link">
                                <div>Insert Bundle</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_bundles" class="menu-link">
                                <div>View Bundles</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Relations -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-relation-many-to-many"></i>
                        <div data-i18n="Relations">Assign Products To Bundles Relations</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_rel" class="menu-link">
                                <div>Insert Relation</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_rel" class="menu-link">
                                <div>View Relations</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Manufacturers -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-brand-amazon"></i>
                        <div data-i18n="Manufacturers">Manufacturers</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_manufacturer" class="menu-link">
                                <div>Insert Manufacturer</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_manufacturers" class="menu-link">
                                <div>View Manufacturers</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Products Categories -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-category"></i>
                        <div data-i18n="Products Categories">Products Categories</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_p_cat" class="menu-link">
                                <div>Insert Product Category</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_p_cats" class="menu-link">
                                <div>View Products Categories</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Categories -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-ticket"></i>
                        <div data-i18n="Categories">Categories</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_cat" class="menu-link">
                                <div>Insert Category</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_cats" class="menu-link">
                                <div>View Categories</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Colors -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-paint"></i>
                        <div data-i18n="Colors">Colors</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_colors" class="menu-link">
                                <div>Insert Colors</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_colors" class="menu-link">
                                <div>View Colors</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sizes -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-ruler"></i>
                        <div data-i18n="Sizes">Sizes</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_sizes" class="menu-link">
                                <div>Insert Sizes</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_sizes" class="menu-link">
                                <div>View Sizes</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Labels -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-layout"></i>
                        <div data-i18n="Labels">Labels</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_label" class="menu-link">
                                <div>Insert Labels</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_labels" class="menu-link">
                                <div>View Labels</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Store -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-building-store"></i>
                        <div data-i18n="Store">Store</div>
                        
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_store" class="menu-link">
                                <div>Insert store</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_store" class="menu-link">
                                <div>View store</div>
                            </a>
                        </li>
                        <!-- About Us -->
                        <li class="menu-item">
                            <a href="index.php?edit_about_us" class="menu-link">
                                <div>Edit About Us</div>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- Contact Us -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-phone"></i>
                        <div data-i18n="Contact Us">Contact Us</div>
                        
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?edit_contact_us" class="menu-link">
                                <div>Edit Contact Us</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?insert_enquiry" class="menu-link">
                                <div>Insert Enquiry Type</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_enquiry" class="menu-link">
                                <div>View Enquiry Types</div>
                            </a>
                        </li>
                    </ul>
                </li>



                <!-- Coupons Section -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-discount-check"></i>
                        <div data-i18n="Coupons">Coupons</div>
                        
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_coupon" class="menu-link">
                                <div>Insert Coupon</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_coupons" class="menu-link">
                                <div>View Coupons</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Terms -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-text-plus"></i>
                        <div data-i18n="Terms">Terms</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_term" class="menu-link">
                                <div>Insert Terms</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_terms" class="menu-link">
                                <div>View Terms</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Customers, Orders, Payments -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-user-circle"></i>
                        <div data-i18n="Customers">Customers</div>
                        
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?view_customers" class="menu-link">
                                <div>View Customers</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_orders" class="menu-link">
                                <div>View Orders</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_payments" class="menu-link">
                                <div>View Payments</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-users-group"></i>
                        <div data-i18n="Users">Users</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="index.php?insert_user" class="menu-link">
                                <div>Insert User</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="index.php?view_users" class="menu-link">
                                <div>View Users</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="index.php?profile=<?php echo $_SESSION['admin_id']; ?>" class="menu-link">
                                <div>View Profile</div>
                            </a>

                        <li class="menu-item">
                            <a href="index.php?user_profile=<?php echo $_SESSION['admin_id']; ?>" class="menu-link">
                                <div>Edit Profile</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Log Out -->
                <li class="menu-item">
                    <a href="logout.php" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-logout"></i>
                        <div>Log Out</div>
                    </a>
                </li>




            </ul>
        </aside>
        <!-- / Menu -->


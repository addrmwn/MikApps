<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?> | <?= SITE_NAME; ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/sweetalert2/sweetalert2.min.css">
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <!-- End plugin css for this page -->



    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/flatpickr/flatpickr.min.css">
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- End layout styles -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.min.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" />
</head>

<body>
    <div class="loader" style="background-color:#070D19;">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="main-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    Mik<span>Apps</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>dashboard" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#hotspot" role="button" aria-expanded="false" aria-controls="hotspot">
                            <i class="link-icon" data-feather="wifi"></i>
                            <span class="link-title">Hotspot Manager</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="hotspot">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>hotspot/generate" class="nav-link">Generate Voucher</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>hotspot/adduser" class="nav-link">Add User</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>hotspot/users" class="nav-link">Users List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>hotspot/active" class="nav-link">Hotspot Active</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>hotspot/profile" class="nav-link">Hotspot Profile</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url(); ?>report" class="nav-link">
                            <i class="link-icon" data-feather="book"></i>
                            <span class="link-title">Report</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url(); ?>router/list" class="nav-link">
                            <i class="link-icon" data-feather="settings"></i>
                            <span class="link-title">Settings</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url(); ?>logout" class="nav-link">
                            <i class="link-icon" data-feather="log-out"></i>
                            <span class="link-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">


                </div>
            </nav>
            <!-- partial -->

            <div class="page-content">

                <?php
                echo view($view);
                ?>
            </div>

            <!-- partial:partials/_footer.html -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2023 <a href="https://www.nobleui.com" target="_blank"><?= SITE_NAME; ?></a>.</p>
                <p class="text-muted">Crafted with <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i> by Adi Darmawan</p>
            </footer>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="<?php echo base_url(); ?>assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?php echo base_url(); ?>assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="<?php echo base_url(); ?>assets/vendors/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?php echo base_url(); ?>assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- Plugin js for this page -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <!-- End plugin js for this page -->



    <!-- Custom js for this page -->
    <script src="<?php echo base_url(); ?>assets/js/dashboard-dark.js"></script>
    <!-- End custom js for this page -->
    <!-- Custom js for this page -->
    <script src="<?php echo base_url(); ?>assets/js/data-table.js"></script>

    <!-- End custom js for this page -->


</body>

</html>
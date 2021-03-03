<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?= link_tag('images/favicon.png', 'png', 'image/x-icon') ?>
        <?= link_tag('images/favicon.png', 'icon', 'image/x-icon') ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
        <?= APP_NAME.' | '.ucfirst($title) ?>
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <!-- CSS Files -->
        <?= link_tag('assets/css/font-awesome.min.css','stylesheet') ?>
        <?= link_tag('assets/css/bootstrap.min.css','stylesheet') ?>
        <?= link_tag('assets/css/paper-dashboard.css','stylesheet') ?>
    </head>
    <body>
        <div class="wrapper ">
            <div class="sidebar" data-color="default" data-active-color="info">
                <div class="logo">
                    <a href="<?= base_url(admin()) ?>" class="simple-text logo-mini">
                        <?= APP_NAME ?>
                    </a>
                    <a href="<?= base_url(admin()) ?>" class="simple-text logo-normal">
                        <?= APP_NAME ?>
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="<?= base_url('images/user.jpg') ?>" />
                        </div>
                        <div class="info">
                            <a href="<?= base_url(admin()) ?>">
                                <span>
                                    <?= $this->session->name ?>
                                </span>
                            </a>
                        </div>
                    </div>
                    <ul class="nav">
                        <li <?= ($name === 'dashboard') ? 'class="active"' : '' ?>>
                            <a href="<?= base_url(admin()) ?>">
                                <i class="fa fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li <?= ($name === 'restaurant') ? 'class="active"' : '' ?>>
                            <a href="<?= base_url(admin('restaurant')) ?>">
                                <i class="fa fa-cutlery"></i>
                                <p>Restaurant</p>
                            </a>
                        </li>
                        <li <?= (in_array($name, ['menu', 'category'])) ? 'class="active"' : '' ?>>
                            <a data-toggle="collapse" href="#manageMenu" aria-expanded="true">
                                <i class="nc-icon nc-single-copy-04"></i>
                                <p>
                                    Manage Menu <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse <?= (in_array($name, ['menu', 'category'])) ? 'show' : '' ?> " id="manageMenu">
                                <ul class="nav">
                                    <li <?= ($name === 'menu') ? 'class="active"' : '' ?>>
                                        <a href="<?= base_url(admin('menu')) ?>">
                                            <span class="sidebar-mini-icon">M</span>
                                            <span class="sidebar-normal"> Menu </span>
                                        </a>
                                    </li>
                                    <li <?= ($name === 'category') ? 'class="active"' : '' ?>>
                                        <a href="<?= base_url(admin('category')) ?>">
                                            <span class="sidebar-mini-icon">C</span>
                                            <span class="sidebar-normal"> Category </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li <?= ($name === 'gallery') ? 'class="active"' : '' ?>>
                            <a href="<?= base_url(admin('gallery')) ?>">
                                <i class="fa fa-image"></i>
                                <p>Gallery</p>
                            </a>
                        </li>
                        <li <?= ($name === 'banner') ? 'class="active"' : '' ?>>
                            <a href="<?= base_url(admin('banner')) ?>">
                                <i class="fa fa-image"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <div class="navbar-minimize">
                                <button id="minimizeSidebar" class="btn btn-icon btn-round">
                                <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                                <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
                                </button>
                            </div>
                            <div class="navbar-toggle">
                                <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                                </button>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link btn-rotate" href="javascript:;">
                                        <i class="nc-icon nc-button-power"></i>
                                        <p>
                                            <span class="d-lg-none d-md-block">Profile</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-rotate" href="javascript:;" onclick="script.logout()">
                                        <i class="nc-icon nc-button-power"></i>
                                        <p>
                                            <span class="d-lg-none d-md-block">Logout</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <h5><?= ucwords($title) ?></h5>
                    <?= $contents ?>
                </div>
            </div>
        </div>
        <input type="hidden" id="base_url" value="<?= base_url(admin()) ?>">
        <input type="hidden" id="dataTableUrl" value="<?= base_url($url) ?>">
        <!-- Core JS Files   -->
        <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/moment.min.js') ?>"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="<?= base_url('assets/js/plugins/bootstrap-switch.js') ?>"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="<?= base_url('assets/js/plugins/sweetalert2.min.js') ?>"></script>
        <!-- Forms Validations Plugin -->
        <script src="<?= base_url('assets/js/plugins/jquery.validate.min.js') ?>"></script>
        <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="<?= base_url('assets/js/plugins/jquery.bootstrap-wizard.js') ?>"></script>
        <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="<?= base_url('assets/js/plugins/bootstrap-selectpicker.js') ?>"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="<?= base_url('assets/js/plugins/bootstrap-datetimepicker.js') ?>"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <script src="<?= base_url('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>
        <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="<?= base_url('assets/js/plugins/bootstrap-tagsinput.js') ?>"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="<?= base_url('assets/js/plugins/jasny-bootstrap.min.js') ?>"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="<?= base_url('assets/js/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/fullcalendar/daygrid.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/fullcalendar/timegrid.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/fullcalendar/interaction.min.js') ?>"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="<?= base_url('assets/js/plugins/jquery-jvectormap.js') ?>"></script>
        <!--  Plugin for the Bootstrap Table -->
        <script src="<?= base_url('assets/js/plugins/nouislider.min.js') ?>"></script>
        <!-- Chart JS -->
        <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>
        <!--  Notifications Plugin    -->
        <script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?= base_url('assets/js/paper-dashboard.min1036.js') ?>"></script>
        <!-- Sharrre libray -->
        <script src="<?= base_url('assets/demo/jquery.sharrre.js') ?>"></script>
        <script src="<?= base_url('assets/js/core.js') ?>"></script>
        <script src="<?= base_url('assets/js/script.js') ?>"></script>
        <?php if ($this->session->flashdata('success')): ?>
        <script>
        script.showNotification('top', 'right', "<b>Success</b><br><?= $this->session->flashdata('success') ?>", 'success');
        </script>
        <?php endif ?>
        <?php if ($this->session->flashdata('error')): ?>
        <script>
        script.showNotification('top', 'right', "<b>Error</b><br><?= $this->session->flashdata('error') ?>", 'danger');
        </script>
        <?php endif ?>
    </body>
</html>
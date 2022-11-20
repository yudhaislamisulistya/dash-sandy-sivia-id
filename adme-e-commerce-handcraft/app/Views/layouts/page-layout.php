<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Admin and Merchant Dashboard - E-Commerce Handcraft</title>
    <meta name="description" content="Philbert is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Morris Charts CSS -->
    <link href="<?= base_url() ?>/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- Data table CSS -->
    <link href="<?= base_url() ?>/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css"
        rel="stylesheet" type="text/css" />

    <link href="<?= base_url() ?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css"
        rel="stylesheet" type="text/css">

    <!-- bootstrap-select CSS -->
    <link href="<?= base_url() ?>/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Switches CSS -->
    <link
        href="<?= base_url() ?>/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css"
        rel="stylesheet" type="text/css" />

    <!-- switchery CSS -->
    <link href="<?= base_url() ?>/vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Dropify CSS -->
    <link href="<?= base_url() ?>/vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="<?= base_url() ?>/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->
    <?= $this->include('layouts/menu') ?>
    <!-- /#wrapper -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Data table JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/dist/js/dataTables-data.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="<?= base_url() ?>/dist/js/jquery.slimscroll.js"></script>

    <!-- simpleWeather JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/moment/min/moment.min.js"></script>
    <script src="<?= base_url() ?>/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
    <script src="<?= base_url() ?>/dist/js/simpleweather-data.js"></script>

    <!-- Progressbar Animation JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="<?= base_url() ?>/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Sparkline JavaScript -->
    <script src="<?= base_url() ?>/vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

    <!-- Owl JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/dropify/dist/js/dropify.min.js"></script>

    <!-- Form Flie Upload Data JavaScript -->
	<script src="<?= base_url() ?>/dist/js/form-file-upload-data.js"></script>

    <!-- ChartJS JavaScript -->
    <script src="<?= base_url() ?>/vendors/chart.js/Chart.min.js"></script>

    <!-- EasyPieChart JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js">
    </script>
    <!-- Morris Charts JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>/vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="<?= base_url() ?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <!-- Switchery JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/switchery/dist/switchery.min.js"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="<?= base_url() ?>/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Init JavaScript -->
    <script src="<?= base_url() ?>/dist/js/init.js"></script>
    <script src="<?= base_url() ?>/dist/js/ecommerce-data.js"></script>

    <?= $this->renderSection('javascript') ?>
</body>

</html>
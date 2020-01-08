<?php

session_start();
/**
 * @file
 */
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" href="views/img/template/icono-negro.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- Overwrites -->
    <link rel="stylesheet" href="views/dist/css/custom.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    <!-- Sweet Alert 2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
    <?php

    if (!empty($_SESSION['posStartSes']) && $_SESSION['posStartSes'] === 'ok') {
        // <!-- Site wrapper -->
        echo '<div class="wrapper">';

        // <!-- Header -->
        include 'modules/header.php';
        // <!-- Menu -->
        include 'modules/sidebar.php';

        // <!-- Content -->
        if (!empty($_GET['route']) && $route = $_GET['route']) {
            if (file_exists(__DIR__ . "/modules/{$route}.php") && $route !== 'login') {
                include __DIR__ . "/modules/{$route}.php";
            } else {
                include __DIR__ . "/modules/404.php";
            }
        } else {
            include __DIR__ . "/modules/home.php";
        }

        // <!-- Footer -->
        include 'modules/footer.php';
        echo '</div>'; // <!-- ./wrapper -->
    } else {
        // Login Page.
        include __DIR__ . "/modules/login.php";
    }
    ?>

    <!-- AdminLTE for demo purposes -->
    <script src="views/js/template.js"></script>
    <script src="views/js/users.js"></script>
    <script>
        $(document).ready(function() {

        })
    </script>
</body>

</html>

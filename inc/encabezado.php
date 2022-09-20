<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>
<?php
const NOMBRE_NEGOCIO = "InventoryAPP";
const THEME = "skin-green";
?>
<!DOCTYPE html>
<html>
<head>

    <title><?php echo NOMBRE_NEGOCIO ?></title>
    <link rel="icon" type="image/png" href="./img/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="./css/pnotify.css" rel="stylesheet">

    <!-- SCRIPTS -->

    <script src="./lib/jquery.js"></script>
    <script src="./lib/bootstrap.js"></script>
    <script src="./lib/pnotify.js"></script>
    <script src="./lib/np.js"></script>
    <script src="./js/main.js"></script>

    <!-- Bootstrap 3.3.2 -->
    <link href="./public/css/display.css" rel="stylesheet">
    <!-- Bootstrap 3.3.2 -->
    <link href="./public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="./public/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="./public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="./public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="./public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="./public/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="./public/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="./public/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="./public/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="./public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

</head>
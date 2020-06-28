<?php
session_start();
if ($_SESSION['role']!='penilai'){
      header('location: index.php');  
} else {
    include ("koneksi.php");
}


if (!isset($_GET['module']) || $_GET['module'] == ''){
         $_GET['module'] = 'home';   
}

$username = $_SESSION['username'];
$query0 = "select * from user where username='$username'";
$hasil0 = mysqli_query($link, $query0);
$data0 = mysqli_fetch_Array($hasil0);
$id_user = $data0['id_user'];

$query01 = "select * from penilai where id_user='$id_user'";
$hasil001 = mysqli_query($link, $query01);
$hasil01 = mysqli_fetch_Array($hasil001);
$id_penilai = $hasil01['id_penilai'];

$pegawai = $link -> query("SELECT * FROM pegawai");
$jumlahp  = mysqli_num_rows($pegawai);

$history = $link-> query("SELECT * FROM history where status='belum' OR status='konfirm'");
$history = mysqli_fetch_array($history);
$id_history = $history['id_history'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISTEM PENDUKUNG KEPUTUSAN PENILAIAN PEKERJAAN PEGAWAI TIDAK TETAP</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />
     <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand">SISTEM PENDUKUNG KEPUTUSAN PENILAIAN PEKERJAAN PEGAWAI TIDAK TETAP</a>
            </div>
                      <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">NEW</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <ul class="menu">
                               <?php
                                $query2 = $link-> query("SELECT * from nilai_pegawai where id_penilai='$id_penilai'");
                                $juml = mysqli_num_rows($query2);
                                if($juml==0){
                                    ?>
                                    <li>
                                        <a href="?module=email&kd=<?=$data['id_penilai'];?>">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b><?= $data['nama']; ?></b> Belum Melakukan Penilaian</h4>
                                                <p>
                                                   Segera lakukan penilaian
                                               </p>
                                           </div>
                                       </a>
                                   </li>
                                   <?php 
                               }
                               if($juml<$jumlahp){ ?>
                                   <li>
                                     <a href="?module=email&kd=<?=$data['id_penilai'];?>">
                                        <div class="icon-circle bg-orange">
                                            <i class="material-icons">mode_edit</i>
                                        </div>
                                        <div class="menu-info">
                                        <h4><b><?= $data['nama']; ?></b> Belum Selesai Melakukan Penilaian</h4>
                                            <p>
                                                Segera lakukan penilaian
                                           </p>
                                       </div>
                                   </a>
                               </li>
                               <?php  }  ?>


                           </ul>
                       </li>
                   </ul>
               </li>
               <!-- #END# Notifications -->

           </ul>
       </div>
            
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?= $hasil01['foto']; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $hasil01['nama']; ?></div>
                    <div class="email"><?= $hasil01['jabatan']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="?module=profile"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php if($_GET['module'] == 'home' || $_GET['module'] == '' || $_GET['module'] == '') { ?> class="active" <?php } else { ?> class="nav-item" <?php } ?> >
                        <a href="?module=home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li <?php if($_GET['module'] == 'profile' || $_GET['module'] == '' || $_GET['module'] == '') { ?> class="active" <?php } else { ?> class="nav-item" <?php } ?>>
                        <a href="?module=profile">
                            <i class="material-icons">text_fields</i>
                            <span>Akun</span>
                        </a>
                    </li>   
                    <li <?php if($_GET['module'] == 'nilai' || $_GET['module'] == 'isian'|| $_GET['module'] == 'ubahisian'  || $_GET['module'] == 'nilai_pegawai'|| $_GET['module'] == '') { ?> class="active" <?php } else { ?> class="nav-item" <?php } ?>>
                        <a href="?module=nilai">
                            <i class="material-icons">text_fields</i>
                            <span>Nilai</span>
                        </a>
                    </li>
                     <li <?php if($_GET['module'] == 'hasil' ||  $_GET['module'] == '') { ?> class="active" <?php } else { ?> class="nav-item" <?php } ?>>
                        <a href="?module=hasil">
                            <i class="material-icons">layers</i>
                            <span>Hasil</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 <a href="javascript:void(0);">Pengadilan Negeri Prabumulih</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.2
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
    </section>

 <section class="content">
        <div class="container-fluid">
            <?php require_once('penilai/'.$_GET['module'].'.php'); ?>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
  <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>

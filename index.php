<?php
    session_start();
    
    if (!isset($_SESSION['level']))
    {
        header("Location: login.php");
    }
    else 
    {
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Informasi Pendaftaran Praktikum</title>
        <link rel="author" href="humans.txt">
        <link href="assets2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets2/css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="assets2/css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="assets2/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Pendaftaran Praktikum Universitas 17 Agustus 1945 Surabaya</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Author <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    <?php if(($_SESSION['level'] == '5') || ($_SESSION['level'] == '5')){?>
                     <li>
                        <a href="?p=pendaftaranpraktikum"><i class="fa fa-fw fa-edit"></i> Pendaftaran Praktikum</a>
                    </li> 
                    <li>
                        <a href="?p=lihatpraktikum"><i class="fa fa-fw fa-bar-chart-o"></i> Lihat Praktikum</a>
                    </li>    
                    <?php } ?>
                    <?php if(($_SESSION['level'] == '4') || ($_SESSION['level'] == '4')){?>
                    <li>
                        <a href="?p=jadwalpraktikum"><i class="fa fa-fw fa-table"></i> Jadwal Praktikum</a>
                    </li>
                    <li>
                        <a href="?p=mahasiswaregister"><i class="fa fa-fw fa-edit"></i> Mahasiswa Register</a>
                    </li>
                    <?php } ?>
                    <?php if(($_SESSION['level'] == '3') || ($_SESSION['level'] == '3')){?>
                    <li>
                        <a href="?p=nilaidosen"><i class="fa fa-fw fa-edit"></i> Daftar Nilai Mahasiswa</a>
                    </li>
                    <?php } ?>
                     <?php if(($_SESSION['level'] == '2') || ($_SESSION['level'] == '2')){?>
                    <li>
                        <a href="?p=nilaiaslab"><i class="fa fa-fw fa-edit"></i> Daftar Nilai Mahasiswa</a>
                    </li>
                    <?php } ?>
                    <?php if(($_SESSION['level'] == '1') || ($_SESSION['level'] == '1')){?>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-desktop"></i> Data Master <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            
                            <li>
                                <a href="?p=kalab">Data Ketua Lab</a>
                            </li>
                            <li>
                                <a href="?p=aslab">Data Asisten Lab</a>
                            </li>
                            <li>
                                <a href="?p=dosen">Data Dosen</a>
                            </li>
                        </ul>
                    </li>
                   
                   

                    <?php } ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid"> 
               
            <?php
                if ((isset($_GET['p'])) and (!isset($_GET['a']))) 
                {
                    include $_GET['p']."/view.php";
                }
                else if(isset($_GET['q']))
                {
                    include($_GET['q'].'.php');
                } 
                else if ((isset($_GET['p'])) and (isset($_GET['a'])))
                {
                    $a=$_GET['a'];
                    include $_GET['p']."/".$a.".php";
                }   
            ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    	
        <script src="assets2/js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="assets2/js/bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="assets2/js/plugins/morris/raphael.min.js"></script>
        <script src="assets2/js/plugins/morris/morris.min.js"></script>
        <script src="assets2/js/plugins/morris/morris-data.js"></script>
    </body>
</html>
<?php
    }
?>			
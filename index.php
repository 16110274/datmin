
<?php
    //Time Handler
    ini_set('max_execution_time', 0); // for infinite time of execution 
    $time_start = microtime(true);  //Start Timer

    //Import library
    require_once ("connection.php");
    require_once ("kmeans.php");
    require_once ("naivebayes.php");
    require_once ("showdata.php");
    
?>




<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Datmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
        <script type="text/javascript" src="chartjs/Chart.js"></script>


        

</head>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">

        <!-- page title area end -->
        <div class="main-content-inner">




            <div class="container">
                                 

                                   <form method="post" action=''>


                                     <!-- header area start -->
        <div class="header-area header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9  d-none d-lg-block">
                        <div class="horizontal-menu">
                            <nav>
                                <ul id="nav_menu">
                                    <li>
                                        <a href="javascript:void(0)"><span>Data Preprocessing</span></a>
                                        <ul class="submenu">
                                     
                                           
                                            <li><br>
                    <div class="custom-control custom-checkbox custom-control-inline">
                                          <button name="" type="submit" class="btn btn-primary mb-3">SHOW</button>
                                            </div>
                                            </li>

                                        </ul>
                                    </li> 

                                    <li>
                                        <a href="javascript:void(0)"><span>NAIVE BAYES Classification</span></a>
                                        <ul class="submenu">
                                            <li>
                                                  
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input name="prep" type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Prepare Data Training</label>
                                            </div>   

                                            </li>
                                            <li><br>
                                             <div class="custom-control custom-checkbox custom-control-inline">
                                          <button  name="dt"  type="submit" class="btn btn-primary mb-3">Show data training</button>
                                            </div></li>
                                            <li> <div class="custom-control custom-checkbox custom-control-inline">
                                                <input name="ins" type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">Insert new data in data training</label>
                                            </div> </li>

                                            <li><br>
                    <div class="custom-control custom-checkbox custom-control-inline">
                                          <button name="nb" type="submit" class="btn btn-primary mb-3">Naive Bayes</button>
                                            </div>
                                            </li>

                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><span>K-Means Clustering</span></a>
                                        <ul class="submenu">
                                            <li>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                            <input  name="nbtkm" type="checkbox" class="custom-control-input" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3"> Process Naive Bayes Data Training with K-Means </label>
                                            </div>
                                        </li>
                                            <li><br>
                                             <div class="custom-control custom-checkbox custom-control-inline">
                                          <button name="km" type="submit" class="btn btn-primary mb-3">K-Means</button>
                                            </div></li>
                                        </ul>
                                    </li>
                                  
                                </ul>
                            </nav>
                        </div>
                    </div>
                 <!-- nav and search button -->
                    <div class="col-lg-3 clearfix">
                        <div class="search-box">
                           <p> <center>         Metode Klasifikasi dan Clustering dalam Penentuan Prioritas Bantuan Posko Bencana Gunung Merapi Tahun 2010</p></center>
                        </div>
                    </div>
                    <!-- mobile_menu -->
                    <!-- mobile_menu -->
                    <div class="col-12 d-block d-lg-none">
                        <div id="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->
  <br>            

   

 <!-- Striped table start -->
                    <div class=" mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="single-table">
                                    <div class="table-responsive">
                                                                         
<?php
    if(isset($_POST['dt'])){
        //if button show data training is pressed
        if(isset($_POST['prep'])){
            //if prepare data training is checked
            //function preparation is called
            prep($con,'mentah');
        }
        //function show data is called
        showdata($con,'naivebayes','Naive Bayes Data Training');
    }else if(isset($_POST['nb'])){
        //if button naive bayes is pressed
        if(isset($_POST['ins'])){
            //if insert in data training is checked
            //function insert to data training is called after every row is calculated
            //INDT($con,$record,$prob);
            echo "Hasil dengan memasukkan data baru ke dalam data training";
        }else{
            echo "Hasil tanpa memasukkan data baru ke dalam data training";
        }   
        //function naive bayes is called
        showNB($con);
    }else if(isset($_POST['km'])){
        //if button kmeans is pressed
        if(isset($_POST['nbtkm'])){
            //if process with kmeans is checked
            //union($con, "naivebayes");
            //km_t_nb($con);
            kmeans($con,'kmeans_training_naivebayes');
            //union($con, "kmeans");
            prep($con,'union_kmeans');
        }else{
        //function kmeans is called
        kmeans($con,'mentah');
        }
        showdata($con,'kmeans','K-Means Clustering');
    }else {
        //default view
        showprepro($con);
    }
?>

<?php
    $time_end = microtime(true); //End Timer
    //Calculate and Print Timer
    $execution_time = ($time_end - $time_start);
    echo '<b>Total Execution Time:</b> '.$execution_time.' Seconds';
?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- Striped table end -->
</p>
<br>






        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
  
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

   <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- start amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all bar chart activation -->
    <script src="assets/js/bar-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>








    
</body>

</html>

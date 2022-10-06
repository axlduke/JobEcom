<?php
    session_start();
    include "../auth/db.php";
    
    if (!isset($_SESSION['user_id'])){
        // echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
        echo '<script>window.location.replace("../form/login.php");</script>';
    }
    $user_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM user WHERE user_id ='$user_id'";
    $result = $conn->query($sql_query);
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $fname = $row['fname'];
        $contact = $row['contact'];
        $pictures = $row['pictures'];
        require_once('../auth/db.php');
        if($_SESSION['type']==2){
        }
        else{
            header('location: ../form/login.php');
        }
            if(!isset($_SESSION['user_id'])){
                header('location: ../form/login.php');
        }
    }
    // total orders
    $total_orders = 0;
    $query = "SELECT orders.product_id,  orders.product_id, count(DISTINCT orders.trx_id) as total_orders, orders.order_id FROM products inner join orders on products.product_id = orders.product_id Where products.seller_id ='$user_id'";
    $results = $conn->query($query);
    while($rows = $results->fetch_array()){
        $total_orders = $rows['total_orders'];
    }

    // total profit
    $total_profit=0;
    $query2 = "SELECT products.price as price, orders.quantity as qty, orders.product_id,orders.quantity FROM products inner join orders on products.product_id = orders.product_id Where products.seller_id = '$user_id'";
    $res = $conn->query($query2);
    while($f = $res->fetch_array()){
        $total_profit += $f['qty'] * $f['price'];
    }

    // Chart
    $dataPoints = array(
    array("y"=> 10, "label"=> "Japan"),
    array("y"=> 20, "label"=> "USA"),
    array("y"=> 30, "label"=> "Ukraine"),
    array("y"=> 40, "label"=> "Albay"),
    array("y"=> 50, "label"=> "lehgazpi"),
    array("y"=> 60, "label"=> "Ph"),
    array("y"=> 70, "label"=> "Aldog"),

);

    $test=array();
    $count=0;
    $res=mysqli_query($conn,"SELECT *, SUBSTRING(product_name, 1,20) as product_name from products WHERE seller_id ='$user_id'");
    while($row=mysqli_fetch_array($res))
    {
        $test[$count]["label"]=$row["product_name"];
        $test[$count]["y"]=$row["quantity"];
        $count = $count+1;
    }
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard Ecommerce</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?= $fname ?></span><span class="user-status">User</span></div><span class="avatar"><img class="round" src="../img/profile/<?= $pictures?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="user-profile.php"><i class="mr-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item nav-link nav-link-style ml-50"><i class="mr-50" data-feather="moon"></i> Theme</a>                        
                    <a class="dropdown-item" href="../auth/logout.php"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="#_">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">JobsEcom</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="active"><a class="d-flex align-items-center" href="dashboard-ecommerce.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='list'></i><span class="menu-title text-truncate" data-i18n="Invoice">Orders</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="ecommerce-order-list.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List of Orders</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ecommerce-invoice-preview.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Invoice Preview</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="ecommerce-posted-products.php"><i data-feather='shopping-bag'></i><span class="menu-title text-truncate" data-i18n="eCommerce">Products</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='user'></i><span class="menu-title text-truncate" data-i18n="user">Profile</a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="ecommerce-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof_setting">General</span></a>
                        </li>
                    </ul>
                </li>              
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h5>Welcomeback Back</h5>
                                    <h5><?=$fname?> 🎉</h5>
<!--                                     <p class="card-text font-small-3">You have won gold medal</p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        <a href="javascript:void(0);">$48.9k</a>
                                    </h3> -->
                                    <!-- <img src="../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" /> -->
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-8 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistics</h4>
                                    <div class="d-flex align-items-center">
                                        <!-- <p class="card-text font-small-2 mr-25 mb-0">Sale Reports</p> -->
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <?php 
                                            $total_today = 0;
                                            $sql = "SELECT sum(products.price*orders.quantity) as daily from products,orders where products.product_id=orders.product_id AND products.seller_id = '$user_id' AND DATE(orders.date_ordered) = DATE(NOW()) group by date(orders.date_ordered)";
                                             $r = $conn->query($sql);
                                            while($today = $r->fetch_array()){
                                                $total_today = $today['daily'];
                                            }
                                        ?>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h5 class="font-weight-bolder mb-0">₱<?php echo number_format($total_today, 2, '.', ',') ?></h5>
                                                    <div class="font-small-2">Sales Today</div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            $total_products = 0;
                                            $query3 = "SELECT count(product_id) as products from products where seller_id ='$user_id'";
                                            $result2 = $conn->query($query3);
                                            while($prod = $result2->fetch_array()){
                                                $total_products = $prod['products'];
                                            }                                        
                                        ?>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="media">
                                                <div class="avatar bg-light-danger mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h5 class="font-weight-bolder mb-0"><?=$total_products?></h5>
                                                    <div class="font-small-2">Products</div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            $yearly = 0;
                                            $query4 = "SELECT year(orders.date_ordered),sum(products.price*orders.quantity) as yearly_revenue from products,orders where products.product_id=orders.product_id and products.seller_id = '$user_id' group by year(orders.date_ordered)";
                                            $result4 = $conn->query($query4);
                                            while($rev = $result4->fetch_array()){
                                                $yearly = $rev['yearly_revenue'];
                                            }                                        
                                        ?>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h5 class="font-weight-bolder mb-0">₱<?php echo number_format($yearly, 2, '.', ',') ?></h5>
                                                    <div class="font-small-2">Yearly Rev.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>

                    <div class="row match-height">
                        <div class="col-lg-4 col-12">
                            <div class="row match-height">
                                <!-- Bar Chart - Orders -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-body pb-50">
                                            <h6>Total Orders</h6>
                                            <h2 class="font-weight-bolder mb-1"><?=$total_orders?></h2>
                                            <div id="statistics-order-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->

                                <!-- Line Chart - Profit -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card card-tiny-line-stats">
                                        <div class="card-body pb-50">
                                            <h6>Total Earnings</h6>
                                            <h4 class="font-weight-bolder mb-0">₱<?php echo number_format($total_profit, 2, '.', ',') ?></h4>
                                            <div id="statistics-profit-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Line Chart - Profit -->

                                <?php   
                                     $this_month = 0;
                                     $prev_month = 0;
                                    $query5 = "SELECT month(orders.date_ordered),sum(products.price*orders.quantity) as this_month from products,orders where products.seller_id =  '$user_id' and products.product_id=orders.product_id and orders.date_ordered >= (LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 1 MONTH) and orders.date_ordered < (LAST_DAY(NOW()) + INTERVAL 1 DAY) group by month(orders.date_ordered)";
                                            $result5 = $conn->query($query5);
                                            while($mtly = $result5->fetch_array()){
                                                $this_month = $mtly['this_month'];                                                                
                                            }       
                                            $query6 = "SELECT  date(orders.date_ordered) as date, sum(products.price*orders.quantity) as last_month FROM orders, products WHERE products.seller_id='$user_id' and products.product_id=orders.product_id and orders.date_ordered BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()"; 
                                                    $result6 = $conn->query($query6);
                                                    while($last_month = $result6->fetch_array()){
                                                        $prev_month = $last_month['last_month'];
                                            } 
                                    ?>

                                <!-- Earnings Card -->
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="card earnings-card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="card-title mb-1">Earnings</h4>
                                                    <div class="font-small-2">Last Month</div>
                                                    <h5 class="mb-1">₱<?php echo number_format($prev_month, 2, '.', ',') ?></h5>
                                                    <p class="card-text text-muted font-small-2">
                                                        <!-- <span class="font-weight-bolder">₱<?php echo number_format($prev_month, 2, '.', ',') ?></span><span> more earnings than last month.</span> -->
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <h4 class="card-title mb-1">Earnings</h4>
                                                    <div class="font-small-2">This Month</div>
                                                    <h5 class="mb-1">₱<?php echo number_format($this_month, 2, '.', ',') ?></h5>
                                                    <p class="card-text text-muted font-small-2">
                                                        <!-- <span class="font-weight-bolder">₱<?php echo number_format($prev_month, 2, '.', ',') ?></span><span> more earnings than last month.</span> -->
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Earnings Card -->
                            </div>
                        </div>

                        <!-- Revenue Report Card -->
                        <div class="col-lg-8 col-12">
                            <div class="card card-revenue-budget">
                                <!-- <div class="mx-0"> -->
                                    <!-- <div class="col-md-8 col-12 revenue-report-wrapper"> -->
                                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                        </div>
                                        
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        </div>
                        <!--/ Revenue Report Card -->
                    </div>

                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="#_" target="_blank">Ace Malto, Mark Limpo</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">BS - COMPUTER SCIENCE<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    title:{
        text: "Products posted"
    },
    subtitles: [{
        text: ""
    }],
    data: [{
        type: "pie",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - #percent%",
        yValueFormatString: "Quantity: #,##0",
        dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
<!-- END: Body-->

</html>
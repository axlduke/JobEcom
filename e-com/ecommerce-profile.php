<?php
    session_start();
    include "../auth/db.php";
    
    if (!isset($_SESSION['user_id'])){
 echo '<script>window.location.replace("../form/login.php");</script>';
    }
    $user_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM user WHERE user_id ='$user_id'";
    $result = $conn->query($sql_query);
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $fname = $row['fname'];
        $contact = $row['contact'];
        $email = $row['email'];
        $title = $row['title'];
        $about = $row['about'];
        $address = $row['address'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        $theme =$row['theme'];
        $shop_name = $row['business'];
        require_once('../auth/db.php');
        if($_SESSION['type']==2){
        }
        else{
            header('location: ../form/login.php');
        }
    }
?>
<!DOCTYPE html>
<html class="<?=$theme?>" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>Profile</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/page-profile.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
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
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?= $fname ?></span><span class="user-status"><?=$shop_name?></span></div><span class="avatar"><img class="round" src="../img/profile/<?= $pictures?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="user-profile.php"><i class="mr-50" data-feather="user"></i> Profile</a>                       
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
                <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
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
                <li class=" nav-item"><a class="d-flex align-items-center" href="dashboard-ecommerce.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
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
                        <li class="active"><a class="d-flex align-items-center" href="ecommerce-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof">Profile</span></a>
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Profile
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div id="user-profile">
                    <!-- profile header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card profile-header mb-2">
                                <!-- profile cover photo -->
                                <img class="card-img-top" src="../app-assets/images/profile/user-uploads/timeline.jpg" alt="User Profile Image" />
                                <!--/ profile cover photo -->

                                <div class="position-relative">
                                    <!-- profile picture -->
                                    <div class="profile-img-container d-flex align-items-center">
                                        <div class="profile-img">
                                            <img src="../img/profile/<?= $pictures?>" class="rounded img-fluid" alt="Card image" />
                                        </div>
                                        <!-- profile title -->
                                        <div class="profile-title ml-3">
                                            <h2 class="text-white"><?= $fname?></h2>
                                            <p class="text-white"><?= $title?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- tabs pill -->
                                <div class="profile-header-nav">
                                    <!-- navbar -->
                                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                        <button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                        </button>

                                        <!-- collapse  -->
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="true">About</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#education" aria-controls="education" role="tab" aria-selected="false">Education</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#experience" aria-controls="experience" role="tab" aria-selected="false">Experience</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="about-tab" data-toggle="tab" href="#certificates" aria-controls="certificates" role="tab" aria-selected="false">Certificates</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ collapse  -->
                                    </nav>
                                    <!--/ navbar -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ profile header -->

                    <!-- profile info section -->
                    <section id="profile-info">
                        <div class="row ">
                            <div class="card w-100">
                                <div class="tab-content card-body">
                                    <div class="tab-pane active" id="about" aria-labelledby="home-tab" role="tabpanel">
                                        <h3 class="mb-75">About</h3>
                                        <p class="card-text ">
                                            <?= $about?>
                                        </p>
                                        <div class="row row-cols-2 ml-1">
                                            <div class="mt-2">
                                                <h5 class="mb-75">Job Title:</h5>
                                                <p class="card-text"><?= $title?></p>
                                            </div>
                                            <div class="mt-2">
                                                <h5 class="mb-75">Address:</h5>
                                                <p class="card-text"><?= $address?></p>
                                            </div>
                                            <div class="mt-2">
                                                <h5 class="mb-75">Email:</h5>
                                                <p class="card-text"><?= $email?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $credentials = "SELECT * FROM `credentials` WHERE user_id = $user_id";
                                        $result1 = $conn->query($credentials);
                                        while($rows = $result1->fetch_array()){
                                    ?>
                                    <div class="tab-pane" id="education" aria-labelledby="profile-tab" role="tabpanel">
                                        <h3 class="mb-75">Experience</h3>
                                        <div class="row row-cols-2 ml-1">
                                            <div class="mt-2">
                                                <p class="card-text">Education 1</p>
                                                <h5 class="mb-75"><?= $rows['educ_1']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Education 2</p>
                                                <h5 class="mb-75"><?= $rows['educ_2']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Education 3</p>
                                                <h5 class="mb-75"><?= $rows['educ_3']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Education 4</p>
                                                <h5 class="mb-75"><?= $rows['educ_4']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Education 5</p>
                                                <h5 class="mb-75"><?= $rows['educ_5']?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="experience" aria-labelledby="profile-tab" role="tabpanel">
                                        <h3 class="mb-75">Experience</h3>
                                        <div class="row row-cols-2 ml-1">
                                            <div class="mt-2">
                                                <p class="card-text">Experience 1</p>
                                                <h5 class="mb-75"><?= $rows['exp_1']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Experience 2</p>
                                                <h5 class="mb-75"><?= $rows['exp_2']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Experience 3</p>
                                                <h5 class="mb-75"><?= $rows['exp_3']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Experience 4</p>
                                                <h5 class="mb-75"><?= $rows['exp_4']?></h5>
                                            </div>
                                            <div class="mt-2">
                                                <p class="card-text">Experience 5</p>
                                                <h5 class="mb-75"><?= $rows['exp_5']?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane grid-view" id="certificates" aria-labelledby="about-tab" role="tabpanel">
                                        <h3 class="mb-75">Certificates</h3>
                                        <div class="d-flex">
                                            <div class="row g-1">
                                                <div class="col-lg">
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="../img/certificates/<?= $rows['cert_1']?>" class="rounded img-fluid"  alt="Card image" />
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Certificates</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body d-flex justify-content-center">
                                                                <div id="carousel-interval" class="carousel slide" data-ride="carousel" data-interval="5000">
                                                                    <ol class="carousel-indicators">
                                                                        <li data-target="#carousel-interval" data-slide-to="1" class="active"></li>
                                                                        <li data-target="#carousel-interval" data-slide-to="2"></li>
                                                                        <li data-target="#carousel-interval" data-slide-to="3"></li>
                                                                        <li data-target="#carousel-interval" data-slide-to="4"></li>
                                                                        <li data-target="#carousel-interval" data-slide-to="5"></li>
                                                                        <li data-target="#carousel-interval" data-slide-to="6"></li>
                                                                    </ol>
                                                                    <div class="carousel-inner" role="listbox">
                                                                        <div class="carousel-item active">
                                                                            <img class="img-fluid" src="../img/certificates/<?= $rows['cert_1']?>" alt="First slide" />
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="img-fluid" src="../img/certificates/<?= $rows['cert_2']?>" alt="Second slide" />
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="img-fluid" src="../img/certificates/<?= $rows['cert_3']?>" alt="Third slide" />
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="img-fluid" src="../img/certificates/<?= $rows['cert_4']?>" alt="Third slide" />
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="img-fluid" src="../img/certificates/<?= $rows['cert_5']?>" alt="Third slide" />
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="img-fluid" src="../img/certificates/<?= $rows['cert_6']?>" alt="Third slide" />
                                                                        </div>
                                                                    </div>
                                                                    <a class="carousel-control-prev" href="#carousel-interval" role="button" data-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                    <a class="carousel-control-next" href="#carousel-interval" role="button" data-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg">
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="../img/certificates/<?= $rows['cert_2']?>" class="rounded img-fluid" alt="Card image" />
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="col-lg">
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="../img/certificates/<?= $rows['cert_3']?>" class="rounded img-fluid" alt="Card image" />
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="col-lg">
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="../img/certificates/<?= $rows['cert_4']?>" class="rounded img-fluid" alt="Card image" />
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="col-lg">
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="../img/certificates/<?= $rows['cert_5']?>" class="rounded img-fluid" alt="Card image" />
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="col-lg">
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="../img/certificates/<?= $rows['cert_6']?>" class="rounded img-fluid" alt="Card image" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                    </section>
                    <!--/ profile info section -->
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a class="ml-25" href="#_" target="_blank">Ace Malto, Mark Limpo</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">BS - COMPUTER SCIENCE<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/page-profile.js"></script>
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
</body>
<!-- END: Body-->

</html>
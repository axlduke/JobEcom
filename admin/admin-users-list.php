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
        if($_SESSION['type']==0){
        }
        else{
            header('location: ../form/login.php');
        }
            if(!isset($_SESSION['user_id'])){
                header('location: ../form/login.php');
        }
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
    <title>Accounts Verification</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/javascript" href="cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-swiper.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/swiper.min.css">    
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">    
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
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?= $fname ?></span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="../img/profile/<?= $pictures?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
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
                <li class="nav-item mr-auto"><a class="navbar-brand" href="#_"><span class="brand-logo">
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
                        <h2 class="brand-text">jobEcom</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="dashboard-admin.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" active"><a class="d-flex align-items-center" href="admin-users-list.php"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Users List</span></a>
                </li>              
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Account</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="admin-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="admin-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">General</span></a>
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
                            <h2 class="content-header-title float-left mb-0">Users</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#_">Users</a>
                                    </li>
                                    <li class="breadcrumb-item active">Users List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <!-- <div class="row"> -->
                        <!-- <div class="col-12"> -->
                        <div class="card mb-4">
                            <div class="card-body overflow-auto">
                                <table id="example">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Name</th>                                     
                                            <th>Violations</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        $sql_query = "SELECT * FROM user WHERE type != 0";
                                        $result = $conn->query($sql_query);
                                        while($row = $result->fetch_array()){
                                            $uid =$row['user_id'];
                                            $type = $row['type'];
                                            if($row['verification_status'] == 'Verified'){
                                              $button ='                                                                    
                                              <button type="btn" name="reject" class="btn btn-danger mr-1" disabled>Reject</button>
                                              <button type="btn" name="verify" class="btn btn-primary mr-1" disabled>Verify</button>';      
                                            }else{
                                              $button = '                                                                    
                                              <button type="btn" name="reject" class="btn btn-danger mr-1">Reject</button>
                                              <button type="btn" name="verify" class="btn btn-primary mr-1">Verify</button>';
                                            }      
                                            if($row['restriction'] == 'Banned' OR $row['restriction'] == 'Restricted'){
                                              $disable = 'disabled';      
                                            }else{$disable = '';}                                                                                  
                                            if ( $type=='1') {
                                              $type = 'User';
                                              $valid_id = ' 
                                                <span>Identification: Front</span>              
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['front_id'].'" alt="front img" />
                                                 <span>Identification: Back</span>
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['back_id'].'" alt="back img" />';
                                            }
                                            elseif ( $type=='2') {
                                              $type = 'Seller';
                                              $valid_id = ' 
                                                <span>Identification: Front</span>              
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['front_id'].'" alt="front img" />
                                                 <span>Identification: Back</span>
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['back_id'].'" alt="back img" />
                                                <span>B.I.R.</span>              
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['bir'].'" alt="front img" />';                                              
                                            }
                                            elseif ( $type=='3') {
                                              $type = 'Employer';
                                              $valid_id = ' 
                                                <span>Identification: Front</span>              
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['front_id'].'" alt="front img" />
                                                 <span>Identification: Back</span>
                                                <img style="height:270px; width:450px;" class="img-fluid rounded mb-75" src="../img/valid_info/'.$row['back_id'].'" alt="back img" />';                                              
                                            } else{
                                                $valid_id = '';
                                            }   
                                                                               
                                            echo 
                                            '<tr>
                                                <td>'.$type.'</td>
                                                <td>'.$row['fname'].'</td>
                                                <td>'.$row['total_violation'].'</td>
                                                <td>'.$row['contact'].'</td>
                                                <td>'.$row['email'].'</td>
                                                <td>'.$row['address'].'</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#backdropid'.$uid.'">
                                                                <i data-feather="image" mr-50></i>
                                                                <span>View I.D.</span>
                                                            </a>                                                       
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#backdrop'.$uid.'">
                                                                <i data-feather="alert-triangle" mr-50></i>
                                                                <span>Restrict</span>
                                                            </a>                                                       
                                                            <a class="dropdown-item" href="../auth/admin/admin-ban-account.php?uid='.$uid.'">
                                                                <i data-feather="slash" class="mr-50"></i>
                                                                <span>Ban</span>
                                                            </a>                                                        
                                                        </div>
                                                    </div>
                                                    <!-- Restric Account       -->
                                                                <div style="text-align: right;">
                                                                    <div class="disabled-backdrop-ex">
                                                                        <!-- Button trigger modal -->
                                                                    <!-- Modal -->
                                                                    <div class="modal fade text-left" id="backdrop'.$uid.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="myModalLabel4">Restrict Account</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                        <div class="modal-body">
                                                                            <section id="multiple-column-form">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="card-body">
                                                                                        <form class="form form-vertical" action="../auth/admin/admin-restric-account.php" method="post">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="first-name-icon">First Name</label>
                                                                                                        <div class="input-group input-group-merge">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                                                                            </div>
                                                                                                            <input type="text" id="first-name-icon" class="form-control" name="fname-icon" value="'.$row['fname'].'" disabled/>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="email-id-icon">Email</label>
                                                                                                        <div class="input-group input-group-merge">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <span class="input-group-text"><i data-feather="mail"></i></span>
                                                                                                            </div>
                                                                                                            <input type="email" id="email-id-icon" class="form-control" name="email-id-icon" value="'.$row['email'].'" disabled />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="contact-info-icon">Mobile</label>
                                                                                                        <div class="input-group input-group-merge">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                                                                            </div>
                                                                                                            <input type="number" id="contact-info-icon" class="form-control" name="contact-icon" value="'.$row['contact'].'" disabled />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="password-icon">Starting Date</label>
                                                                                                        <div class="input-group input-group-merge">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <span class="input-group-text"></span>
                                                                                                            </div>
                                                                                                            <input type="date" id="password-icon" class="form-control" name="starting_date" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="password-icon">Ending Date</label>
                                                                                                        <div class="input-group input-group-merge">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <span class="input-group-text"></span>
                                                                                                            </div>
                                                                                                            <input type="date" id="password-icon" class="form-control" name="ending_date" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>                                                                                            
                                                                                                <div class="col-12">
                                                                                                <input type="hidden" class="form-control" name="uid" value="'.$uid.'"/>
                                                                                                </div>
                                                                                                <div style="text-align:right;" class="col-12">
                                                                                                <button type="reset" class="btn btn-outline-secondary" '.$disable.'>Reset</button>
                                                                                                <button type="btn" name="restrict_button" class="btn btn-primary mr-1" '.$disable.'>Submit</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                        <!-- </div> -->
                                                                                    </div>
                                                                                </div>
                                                                            </section>                                                                                                            
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <!-- Restrict Account        -->
                                                        <!-- View ID       -->
                                                                <div style="text-align: right;">
                                                                    <div class="disabled-backdrop-ex">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade text-left" id="backdropid'.$uid.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="myModalLabel4">View ID</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                        <div class="modal-body">
                                                                        '.$valid_id.'
                                                                        </div>
                                                                        <div style="text-align:right;" class="col-12">
                                                                        <form method="POST" action="../auth/admin/verify-account-action.php">
                                                                        <input type="hidden" class="form-control" name="uid" value="'.$uid.'"/>
                                                                        <input type="hidden" class="form-control" name="user_email" value="'.$row['email'].'"/>
                                                                        '.$button.'
                                                                        </form>
                                                                        </div>
                                                                        <br>                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <!-- View ID        --> 
                                                </td>
                                            </tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- Modal to add new record -->
                </section>
                <!--/ Basic table -->


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
    <script src="../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>


    <!-- start error in datatables -->
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <!-- end error in datatables -->
    
    <script src="../app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="../app-assets/js/scripts/tables/table-datatables-basic.js"></script> -->
    <script src="../app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="../app-assets/js/scripts/charts/chart-chartjs.js"></script>
    <script src="../app-assets/js/scripts/extensions/ext-component-swiper.js"></script>
    <script src="../app-assets/vendors/js/extensions/swiper.min.js"></script>
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
        $(document).ready(function () {
            $('#example').DataTable({
                order: [[3, 'desc']],
            });
        });
    </script>
    <script src="../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
    <script src="../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/polyfill.min.js"></script>    
<?php
    if (isset($_SESSION['status_title']) && $_SESSION['status_title'] !='') {
        // code...
    
?>    
<script>
Swal.fire({
  icon: '<?php echo $_SESSION['status_icon']?>',
  title: '<?php echo $_SESSION['status_title']?>',
  text: '<?php echo $_SESSION['status_text']?>'
})
</script>    
<?php
    unset($_SESSION['status_title']);
}
?>
</body>
<!-- END: Body-->

</html>
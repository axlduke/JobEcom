<?php 
    session_start();
    include_once "../auth/db.php";
    if(!isset($_SESSION['user_id'])){
        header("location: ../form/login.php");
    }
        $user_id = $_SESSION['user_id'];
        $sql_query = "SELECT * FROM user WHERE user_id ='$user_id'";
        $result = $conn->query($sql_query);
        while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $type = $row['type'];
        $fname = $row['fname'];
        $title = $row['title'];
        $contact = $row['contact'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        require_once('../auth/db.php');
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
    <title>Chat Message</title>
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-chat-list.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

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
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?= $fname ?></span><span class="user-status"><?=$mode?></span></div><span class="avatar"><img class="round" src="../img/profile/<?= $pictures?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
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
                        <h2 class="brand-text">JobsEcom</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">                                
            <?php if($type == '0'){ echo 
                '<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="../admin/dashboard-admin.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" active"><a class="d-flex align-items-center" href="app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../admin/admin-users-list.php"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Users List</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="user">Account</a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../admin/admin-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../admin/admin-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof_setting">General</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
            '; }elseif($type == '1'){ echo   
                '        
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="#_"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item"><a class="d-flex align-items-center" href="../user/user-job.php"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Invoice">Job Portal</span></a>
                        </li>
                        <li ><a class="d-flex align-items-center" href="../user/ecommerce-shop.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">E-Commerce</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class="active"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Cart</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../user/ecommerce-checkout.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Checkout</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../user/user-order-history.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Order History</span></a>
                        </li>
                        <!-- <li><a class="d-flex align-items-center" href="app-ecommerce-wishlist.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Wish List">Wish List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../user/ecommerce-checkout.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Checkout">Checkout</span></a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item"><a class="d-flex align-items-center" href="../user/user-jobs-applied-list.php"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="jobs_applied">Jobs Applied</span></a>
                </li>                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Account</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../user/user-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../user/user-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">General</span></a>
                        </li>
                    </ul>
                </li>
            </ul>';
            }elseif($type == '2'){ echo 
                '<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="../e-com/dashboard-ecommerce.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li  class="active"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Invoice">Orders</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../e-com/ecommerce-order-list.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List of Orders</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../e-com/ecommerce-invoice-preview.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Invoice Preview</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../e-com/ecommerce-posted-products.php"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Products</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="user">Profile</a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../e-com/ecommerce-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../e-com/page-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="prof_setting">General</span></a>
                        </li>
                    </ul>
                </li>                 
            </ul>'; }elseif($type=='3'){ echo
                '            
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="../job/dashboard-analytics.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../job/available-user.php"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="jobseekers">Job Seekers</span></a>
                </li>  
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li  class="active"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Jobs</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../job/posted-jobs.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Posted Job List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../job/applicants-list.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Applicants</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Account</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../job/employer-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../job/employer-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">General</span></a>
                        </li>
                    </ul>
                </li>
            </ul>';
            } ?>    
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content chat-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- Admin user profile area -->
                    <div class="chat-profile-sidebar">
                        <header class="chat-profile-header">
                            <span class="close-icon">
                                <i data-feather="x"></i>
                            </span>
                            <!-- User Information -->
                            <div class="header-profile-sidebar">
                                <div class="avatar box-shadow-1 avatar-xl avatar-border">
                                    <img src="../img/profile/<?= $pictures?>" alt="user_avatar" />
                                    <span class="avatar-status-online avatar-status-xl"></span>
                                </div>
                                <h4 class="chat-user-name"><?= $fname?></h4>
                                <span class="user-post"><?= $title?></span>
                            </div>
                            <!--/ User Information -->
                        </header>
                    </div>
                    <!--/ Admin user profile area -->

                    <!-- Chat Sidebar area -->
                    <div class="sidebar-content">
                        <span class="sidebar-close-icon">
                            <i data-feather="x"></i>
                        </span>
                        <!-- Sidebar header start -->
                        <div class="chat-fixed-search">
                            <div class="d-flex align-items-center w-100">
                                <div class="sidebar-profile-toggle">
                                    <div class="avatar avatar-border">
                                        <img src="../img/profile/<?= $pictures?>" alt="user_avatar" height="42" width="42" />
                                        <span class="avatar-status-online"></span>
                                    </div>
                                </div>
                                <div class="input-group input-group-merge ml-1 w-100">
                                    <div class="search">
                                            <!-- <span class="text">Select user to chat</span> -->
                                        <input type="text" class="form-control round" id="chat-search" placeholder="Search or start a new chat" aria-label="Search..." aria-describedby="chat-search" />
                                        <button hidden><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar header end -->

                        <!-- Sidebar Users start -->
                        <div id="users-list" class="chat-user-list-wrapper list-group">
                            <h4 class="chat-list-title">Chats</h4>
                              <div class="users-list">
  
                              </div>
                              <script src="users.js"></script>
                        </div>
                        <!-- Sidebar Users end -->
                    </div>
                    <!--/ Chat Sidebar area -->

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- Main chat area -->
                        <section class="chat-app-window">
                            <!-- Active Chat -->
                        <?php 
                            if (empty($_GET['incoming_id'])){
                            echo '<div class="start-chat-area">
                                <div class="mb-1 start-chat-icon">
                                    <i data-feather="message-square"></i>
                                </div>
                                <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                            </div>'; 
                            }else{
                            $incoming_id = mysqli_real_escape_string($conn, $_GET['incoming_id']);
                            $sql_query = "SELECT * FROM user WHERE user_id ='$incoming_id'";
                            $result = $conn->query($sql_query);
                            while($row = $result->fetch_array()){
                                $name = $row['fname'];
                                $picture = $row['pictures'];
                                $company = $row['company'];
                                $email = $row['email'];
                                $status = $row['status'];
                                if ($row['status']== "Offline now") {
                                   $status = '<span class="avatar-status-offline avatar-status-lg"></span>';
                                }
                                if ($row['status']== "Active now") {
                                    $status = '<span class="avatar-status-online avatar-status-xl"></span>';
                                }
                        ?>
                            <div class="active-chat ">
                                <!-- Chat Header -->
                                <div class="chat-navbar">
                                    <header class="chat-header">
                                        <div class="d-flex align-items-center">
                                            <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                <i data-feather="menu" class="font-medium-5"></i>
                                            </div>
                                            <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                                                <img src="../img/profile/<?= $picture ?>" alt="avatar" height="36" width="36" />
                                                <?= $status?>
                                            </div>
                                            <h6 class="mb-0"><?= $name?></h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i data-feather="phone-call" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
                                            <i data-feather="video" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
                                            <i data-feather="search" class="cursor-pointer d-sm-block d-none font-medium-2"></i>
                                            <div class="dropdown">
                                                <button class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" id="chat-header-actions" class="font-medium-2"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions">
                                                    <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                </div>
                                <!--/ Chat Header -->
                                <!-- User Chat messages -->                             
                                <div class="user-chats">
                                    <div class="chats"> 
                                        <div class="chat-box">

                                        </div>
                                    </div>
                                </div>
                                    
                                <section class="chat-area">
                                    <form class="chat-app-form" id="submitForm">
                                        <div class="input-group input-group-merge mr-1 form-send-message">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                    <label for="attach-doc" class="attachment-icon mb-0">
                                                        <i data-feather="file" class="cursor-pointer lighten-2 text-secondary"></i>
                                                        <input type="file" name="file" id="attach-doc" hidden /> </label></span>
                                        </div>
                                            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $incoming_id;?>" hidden>
                                            <input type="text" name="message" class="form-control" placeholder="Type a message here..." autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <label for="attach-image" class="attachment-icon mb-0">
                                                        <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>
                                                        <input type="file" name="image" id="attach-image" hidden /> </label></span>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary send">
                                            <i data-feather="send" class="d-lg-none"></i>
                                            <span class="d-none d-lg-block">Send</span>
                                        </button>
                                    </form>
                                </section>
                                <script src="chat.js"></script>
                                <!--/ Submit Chat form -->
                            </div>
                            <!--/ Active Chat -->
                        </section>
                        <!--/ Main chat area -->

                        <!-- User Chat profile right area -->

                                <!-- User Chat messages -->

                                <!-- Submit Chat form -->
                                <form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat();">
                                    <div class="input-group input-group-merge mr-1 form-send-message">
                                        <div class="input-group-prepend">
                                            <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
                                        </div>
                                        <input type="text" class="form-control message" placeholder="Type your message or use speech to text" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <label for="attach-doc" class="attachment-icon mb-0">
                                                    <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>
                                                    <input type="file" id="attach-doc" hidden /> </label></span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary send" onclick="enterChat();">
                                        <i data-feather="send" class="d-lg-none"></i>
                                        <span class="d-none d-lg-block">Send</span>
                                    </button>
                                </form>
                                <!--/ Submit Chat form -->
                            </div>
                            <!--/ Active Chat -->
                        </section>
                        <!--/ Main chat area -->

                        <!-- User Chat profile right area -->
                        <div class="user-profile-sidebar">
                            <header class="user-profile-header">
                                <span class="close-icon">
                                    <i data-feather="x"></i>
                                </span>
                                <!-- User Profile image with name -->
                                <div class="header-profile-sidebar">
                                    <div class="avatar box-shadow-1 avatar-border avatar-xl">
                                        <img src="../img/profile/<?= $row['pictures'] ?>" alt="user_avatar" height="70" width="70" />
                                        <?= $status?>
                                    </div>
                                    <h4 class="chat-user-name"><?= $row['fname']?></h4>
                                    <span class="user-post"><?= $row['company']?></span>
                                </div>
                                <!--/ User Profile image with name -->
                            </header>
                            <div class="user-profile-sidebar-area">
                                <!-- About User -->
                                <!-- About User -->
                                <!-- User's personal information -->
                                <div class="personal-info">
                                    <h6 class="section-label mb-1 mt-3">Personal Information</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-1">
                                            <i data-feather="mail" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle"><?= $row['email']?></span>
                                        </li>
                                        <li class="mb-1">
                                            <i data-feather="phone-call" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle"><?= $row['contact']?></span>
                                        </li>
                                        <li>
                                            <i data-feather="clock" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Mon - Fri 8AM - 9PM</span>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ User's personal information -->

                            </div>
                        </div>
                        <!--/ User Chat profile right area -->
                        <?php  }}?>
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
    <script src="../app-assets/js/scripts/pages/app-chat.js"></script>
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
    <script type="text/javascript">
    $(document).ready(function(){
        $("#submitForm").on("change", function(){
            var formData = new FormData(this);
            $.ajax({
            url  : "send-files-action.php",
            type : "POST",
            cache: false,
            contentType : false, // you can also use multipart/form-data replace of false
            processData: false,
            data: formData,
            success:function(response){
            document.getElementById('submitForm').reset();
            
            }
            });
        });
    });
    </script>
</body>
<!-- END: Body-->

</html>
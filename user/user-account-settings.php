<?php
    session_start();
    include "../auth/db.php";
    
    if (!isset($_SESSION['user_id'])){
        echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
        echo '<script>window.location.replace("../form/login.php");</script>';
    }
    $user_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM user WHERE user_id ='$user_id'";
    $result = $conn->query($sql_query);
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $fname = $row['fname'];
        $email = $row['email'];
        $address = $row['address'];
        $about = $row['about'];
        $contact = $row['contact'];
        $title = $row['title'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        require_once('../auth/db.php');
        if($_SESSION['type']==1){
        }
        else{
            header('location: ../form/login.php');
        }
    }

    $experience = "SELECT * FROM credentials WHERE user_id = '$user_id'";
    $result2 = $conn->query($experience);
    while($row  = $result2->fetch_array()){
        $exp_1 = $row['exp_1'];
        $exp_2 = $row['exp_2'];
        $exp_3 = $row['exp_3'];
        $exp_4 = $row['exp_4'];
        $exp_5 = $row['exp_5'];
        $educ_1 = $row['educ_1'];
        $educ_2 = $row['educ_2'];
        $educ_3 = $row['educ_3'];
        $educ_4 = $row['educ_4'];
        $educ_5 = $row['educ_5'];      
        $cert_1 = $row['cert_1'];
        $cert_2 = $row['cert_2'];
        $cert_3 = $row['cert_3'];
        $cert_4 = $row['cert_4'];
        $cert_5 = $row['cert_5'];
        $cert_6 = $row['cert_6'];
        $resume = $row['pdf_file'];
        $cover = $row['pdf_cover'];
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
    <title>Page Account</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/select/select2.min.css">
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-validation.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">       

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
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                <li class="nav-item dropdown dropdown-cart mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge badge-pill badge-primary badge-up cart-item-count"><?php 
                                $post = mysqli_query($conn, "SELECT * FROM cart WHERE `user_id` =".$user_id);
                                $rows1 = mysqli_num_rows($post);
                                echo ''.$rows1.''?></span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">My Cart</h4>
                                <div class="badge badge-pill badge-light-primary"><?php 
                                $post = mysqli_query($conn, "SELECT * FROM cart WHERE `user_id` =".$user_id);
                                $rows1 = mysqli_num_rows($post);
                                echo ''.$rows1.' Items'?></div>
                            </div>
                        </li>
                        <?php
                            $products_posted="SELECT * from cart WHERE user_id ='$user_id'";                
                            $results=mysqli_query($conn,$products_posted);      
                                $cartTotal = 0;           
                                while($row = $results -> fetch_assoc()){
                                    $user_cart = $row['user_id'];
                                    $products_ordered="SELECT * from products WHERE product_id = ".$row['product_id'];  
                                    $res=mysqli_query($conn,$products_ordered);
                                    while($fetch = $res-> fetch_assoc()){     
                                        $product_category = $fetch['product_category'];
                                        $file1 = $fetch['file1'];
                                        $cartTotal += ($fetch["price"] * $row["quantity"] );  
                                        // $totalPayment += ($cartTotal + $row['shipping_fee']);  
                                        $shipping_fee = $fetch['shipping_fee'];
                                        if($product_category > 0){
                                            if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
                                                if (array_key_exists($product_id, $_SESSION['cart'])){
                                                    $_SESSION['cart'][$product_id];
                                                }
                                            }
                                        }
                        ?> 
                            <li class="scrollable-container media-list">
                                <div class="media align-items-center"><img class="d-block rounded mr-1" src="../img/product/<?= $fetch['file1']?>"   width="62">
                                    <div class="media-body" id="remove<?php echo $item["brand"]; ?>" ><a href="ecommerce-details.php?p=<?= $fetch['product_id'];?>&seller=<?php echo $fetch['seller_id'] ?>" ></a>
                                        <div class="media-heading">
                                            <h6 class="cart-item-title"><a class="text-body" href="ecommerce-details.php"><?= $fetch['product_name']?></a></h6>
                                        </div>
                                        <div class="cart-item-qty">
                                            <div class="input-group">
                                                <?php echo $row['quantity'] ?>
                                            </div>
                                        </div>
                                        <h5 class="cart-item-price"><?php echo "₱".$fetch['price'] ?></h5>
                                        <h5><a class="badge badge-pill badge-light-danger" href="../auth/users/delete-item-cart.php?i=<?php echo $row['cart_id']?>">DELETE</a></h5>
                                    </div>
                                </div>
                            </li>
                            <?php }}?>
                            <li class="dropdown-menu-footer">
                                <div class="d-flex justify-content-between mb-1">
                                    <h6 class="font-weight-bolder mb-0">Total:</h6>
                                    <h6 class="text-primary font-weight-bolder mb-0">₱<?php echo number_format($cartTotal, 2, '.', ',') ?></h6>
                                </div><?php 
                                        if($cartTotal > 0){
                                            echo '<a href="ecommerce-checkout.php">
                                            <button name="check-out" class="btn btn-primary btn-block">
                                                Check Out
                                            </button>
                                        </a>';
                                        } else{
                                            echo '<a href="#_">
                                            <button name="check-out" class="btn btn-primary btn-block" disable>
                                                Check Out
                                            </button>
                                        </a>';
                                        }
                                    ?>
                            </li>
                    </ul>
                </li>
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
                        <h2 class="brand-text">JobEcom</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="#_"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item"><a class="d-flex align-items-center" href="../user/user-job.php"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Invoice">Job Portal</span></a>
                        </li>
                        <li class="nav-item"><a class="d-flex align-items-center" href="../user/ecommerce-shop.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">E-Commerce</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Cart</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../user/ecommerce-checkout.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Checkout</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="../user/user-order-history.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Order History</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="d-flex align-items-center" href="../user/user-jobs-applied-list.php"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="jobs_applied">Jobs Applied</span></a>
                </li>                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Account</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="../user/user-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Profile</span></a>
                        </li>
                        <li class="active"><a class="d-flex align-items-center" href="../user/user-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">General</span></a>
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
                            <h2 class="content-header-title float-left mb-0">Account Settings</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#_">General</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Account <?php
                                                                if(isset($_SESSION['success'])) {
                                                                    echo $_SESSION['success'];
                                                                    unset($_SESSION['success']);
                                                                }
                                                            ?>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">
                                <!-- general -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">General</span>
                                    </a>
                                </li>
                                <!-- change password -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-credentials" aria-expanded="false">
                                        <i data-feather="paperclip" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Credentials</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Change Password</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/ left menu section -->

                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- general tab -->
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <!-- header media -->
                                            <form action="../auth/users/update-account.php" method="POST" role="form" enctype="multipart/form-data">
                                                <div class="media">
                                                    <a class="mr-25">
                                                        <img src="../img/profile/<?= $pictures?>" class="rounded mr-50" alt="profile image" height="80" width="80" value="<?= $pictures?>" />
                                                    </a>
                                                    <!-- upload and reset button -->
                                                    <div class="media-body mt-75 ml-1">
                                                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                        <input name="profile" type="file" id="account-upload" value="../img/profile/<?= $pictures?>" hidden accept="image/*"/>
                                                        <p>Allowed JPG, GIF or PNG. Max size of 10mb</p>
                                                    </div>
                                                    <!--/ upload and reset button -->
                                                </div>
                                                <!--/ header media -->

                                                <!-- form -->
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-name">Full Name</label>
                                                            <input type="text" class="form-control" id="account-name" name="fname" value="<?= $fname?>" />
                                                            <input type="hidden" name="outdated_profile" value="<?=$pictures?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-name">Job Title</label>
                                                            <input type="text" class="form-control" id="account-name" name="title" value="<?= $title?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-address">Address</label>
                                                            <input list="City" type="text" class="form-control" id="account-address" name="address" value="<?= $address?>" />
                                                            <datalist id="City">
                                                                <option value="Agnas (San Miguel Island)">Agnas (San Miguel Island)</option>
                                                                <option value="Bacolod">Bacolod</option>
                                                                <option value="Bangkilingan">Bangkilingan</option>
                                                                <option value="Bantayan">Bantayan</option>
                                                                <option value="Baranghawon">Baranghawon</option>
                                                                <option value="Basagan">Basagan</option>
                                                                <option value="Basud (Pob.)">Basud (Pob.)</option>
                                                                <option value="Bogñabong">Bogñabong</option>
                                                                <option value="Bombon (Pob.)">Bombon (Pob.)</option>
                                                                <option value="Bonot">Bonot</option>
                                                                <option value="San Isidro">San Isidro</option>
                                                                <option value="Buang">Buang</option>
                                                                <option value="Buhian">Buhian</option>
                                                                <option value="Cabagñan">Cabagñan</option>
                                                                <option value="Cobo">Cobo</option>
                                                                <option value="Comon">Comon</option>
                                                                <option value="Cormidal">Cormidal</option>
                                                                <option value="Divino Rostro (Pob.)">Divino Rostro (Pob.)</option>
                                                                <option value="Fatima">Fatima</option>
                                                                <option value="Guinobat">Guinobat</option>
                                                                <option value="Hacienda (San Miguel Island)">Hacienda (San Miguel Island)</option>
                                                                <option value="Magapo">Magapo</option>
                                                                <option value="Mariroc">Mariroc</option>
                                                                <option value="Matagbac">Matagbac</option>
                                                                <option value="Oras">Oras</option>
                                                                <option value="Oson">Oson</option>
                                                                <option value="Panal">Panal</option>
                                                                <option value="Pawa">Pawa</option>
                                                                <option value="Pinagbobong">Pinagbobong</option>
                                                                <option value="Quinastillojan">Quinastillojan</option>
                                                                <option value="Rawis (San Miguel Island)">Rawis (San Miguel Island)</option>
                                                                <option value="Sagurong (San Miguel Island)">Sagurong (San Miguel Island)</option>
                                                                <option value="Salvacion">Salvacion</option>
                                                                <option value="San Antonio">San Antonio</option>
                                                                <option value="San Carlos">San Carlos</option>
                                                                <option value="San Juan (Pob.)">San Juan (Pob.)</option>
                                                                <option value="San Lorenzo">San Lorenzo</option>
                                                                <option value="San Ramon">San Ramon</option>
                                                                <option value="San Roque">San Roque</option>
                                                                <option value="San Vicente">San Vicente</option>
                                                                <option value="Santo Cristo">Santo Cristo</option>
                                                                <option value="Sua-Igot">Sua-Igot</option>
                                                                <option value="Tabiguian">Tabiguian</option>
                                                                <option value="Tagas">Tagas</option>
                                                                <option value="Tayhi (Pob.)">Tayhi (Pob.)</option>
                                                                <option value="Visita (San Miguel Island)">Visita (San Miguel Island)</option>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-e-mail">E-mail</label>
                                                            <input type="email" class="form-control" id="account-e-mail" name="email" value="<?= $email?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-contact">Contact Num.</label>
                                                            <input type="text" class="form-control" id="account-contact" name="contact" value="<?= $contact?>" pattern="[0-9]{11}" maxlength="11" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-mode">Account Mode: user|work</label>
                                                            <input list="Mode" type="text" class="form-control" id="account-mode" name="mode" value="" placeholder="<?= $mode?>" />
                                                                <datalist id="Mode">
                                                                    <option value="user">user</option>
                                                                    <option value="work">work</option>
                                                                </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="floatingTextarea2">About</label>
                                                            <textarea type="text" class="form-control" id="floatingTextarea2" name="about" value="<?= $about?>" ><?= $about?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <input name="user_id" type="text" class="hidden" value="user_id">
                                                        <button name="updateProfile" type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ general tab -->

                                        <!-- change password -->
                                        <div class="tab-pane fade" id="account-vertical-credentials" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <!-- form -->
                                            <form action="../auth/credentials.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-contact">Experience 1</label>
                                                            <input type="text" class="form-control" id="account-contact" name="exp_1" value="<?php if (!empty($exp_1)){ echo $exp_1;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Experience 2</label>
                                                            <input type="text" class="form-control" id="account-address" name="exp_2" value="<?php if (!empty($exp_2)){ echo $exp_2;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-contact">Experience 3</label>
                                                            <input type="text" class="form-control" id="account-contact" name="exp_3" value="<?php if (!empty($exp_3)){ echo $exp_3;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Experience 4</label>
                                                            <input type="text" class="form-control" id="account-address" name="exp_4" value="<?php if (!empty($exp_4)){ echo $exp_4;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Experience 5</label>
                                                            <input type="text" class="form-control" id="account-address" name="exp_5" value="<?php if (!empty($exp_5)){ echo $exp_5;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Education 1</label>
                                                            <input type="text" class="form-control" id="account-address" name="educ_1" value="<?php if (!empty($educ_1)){ echo $educ_1;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Education 2</label>
                                                            <input type="text" class="form-control" id="account-address" name="educ_2" value="<?php if (!empty($educ_2)){ echo $educ_2;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Education 3</label>
                                                            <input type="text" class="form-control" id="account-address" name="educ_3" value="<?php if (!empty($educ_3)){ echo $educ_3;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Education 4</label>
                                                            <input type="text" class="form-control" id="account-address" name="educ_4" value="<?php if (!empty($educ_4)){ echo $educ_4;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-company">Education 5</label>
                                                            <input type="text" class="form-control" id="account-address" name="educ_5" value="<?php if (!empty($educ_5)){ echo $educ_5;} else{ echo '';}?>" />
                                                        </div>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="cert_1" type="file" id="account-upload" value="<?php if (!empty($cert_1)){ echo $cert_1;} else{ echo '';}?>" accept="image/*" />
                                                        <p>Allowed JPG PNG. Max size of 10mb</p>
                                                    </div>                                                    
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="cert_2" type="file" id="account-upload" value="<?php if (!empty($cert_2)){ echo $cert_2;} else{ echo '';}?>" accept="image/*" />
                                                        <p>Allowed JPG PNG. Max size of 10mb</p>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="cert_3" type="file" id="account-upload" value="<?php if (!empty($cert_3)){ echo $cert_3;} else{ echo '';}?>" accept="image/*" />
                                                        <p>Allowed JPG PNG. Max size of 10mb</p>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="cert_4" type="file" id="account-upload" value="<?php if (!empty($cert_4)){ echo $cert_4;} else{ echo '';}?>" accept="image/*" />
                                                        <p>Allowed JPG PNG. Max size of 10mb</p>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="cert_5" type="file" id="account-upload" value="<?php if (!empty($cert_5)){ echo $cert_5;} else{ echo '';}?>"  accept="image/*" />
                                                        <p>Allowed JPG PNG. Max size of 10mb</p>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="cert_6" type="file" id="account-upload" value="<?php if (!empty($cert_6)){ echo $cert_6;} else{ echo '';}?>"  accept="image/*" />
                                                        <p>Allowed JPG PNG. Max size of 10mb </p>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <input name="pdf_file" accept=".pdf" type="file"/>
                                                        <p>Allowed only PDF file for resume</p>
                                                    </div>
                                                    <div class="media-body mt-75 ml-1">
                                                        <!-- <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Cover Letter</label> -->
                                                        <input name="pdf_cover" accept=".pdf" type="file"/>
                                                        <!-- <input type="file" accept=".pdf"> -->
                                                        <p>Allowed only PDF file for cover</p>
                                                    </div>
                                                    <input name="cert_1" type="hidden" value="<?php if (!empty($cert_1)){ echo $cert_1;} else{ echo '';}?>">
                                                    <input name="cert_2" type="hidden" value="<?php if (!empty($cert_2)){ echo $cert_2;} else{ echo '';}?>">   
                                                    <input name="cert_3" type="hidden" value="<?php if (!empty($cert_3)){ echo $cert_3;} else{ echo '';}?>">
                                                    <input name="cert_4" type="hidden" value="<?php if (!empty($cert_4)){ echo $cert_4;} else{ echo '';}?>">
                                                    <input name="cert_5" type="hidden" value="<?php if (!empty($cert_5)){ echo $cert_5;} else{ echo '';}?>">
                                                    <input name="cert_6" type="hidden" value="<?php if (!empty($cert_6)){ echo $cert_6;} else{ echo '';}?>">
                                                    <input name="cover" type="text" class="hidden" value="<?php if (!empty($cover)){ echo $cover;} else{ echo '';}?>"  />
                                                    <input name="resume" type="text" class="hidden" value="<?php if (!empty($resume)){ echo $resume;} else{ echo '';}?>"  />                           
                                                    <div class="col-12">
                                                        <input name="user_id" type="text" class="hidden" value="<?= $user_id?>">
                                                        <button name="qualification" type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <!-- form -->
                                            <form action="../auth/users/update-password.php" method="POST" role="form">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-old-password">Old Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input name="password" type="password" class="form-control" id="account-old-password" name="Opassword" placeholder="Old Password" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer">
                                                                        <i data-feather="eye"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-new-password">New Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" id="txtPassword" name="Npassword" class="form-control" placeholder="New Password" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer">
                                                                        <i data-feather="eye"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-retype-new-password">Retype New Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" class="form-control" id="txtConfirmPassword" name="Rpassword" placeholder="New Password" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button name="updatePassword" type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ change password -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- / account setting page -->

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
    
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        function saveCart(obj) {
            var quantity = $(obj).val();
            var brand = $(obj).attr("id");
            $.ajax({
                url: "?action=edit",
                type: "POST",
                data: 'brand='+brand+'&quantity='+quantity,
                success: function(data, status){$("#total_price").html(data)},
                error: function () {alert("Problen in sending reply!")}
            });
        }
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/page-account-settings.js"></script>
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
    unset($_SESSION['status_icon']);
    unset($_SESSION['status_title']);
    unset($_SESSION['status_text']);
}
?>   

<!-- END: Body-->

</html>
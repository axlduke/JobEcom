<?php
    session_start();
    include "../auth/db.php";
    include "../auth/dbController.php";
    $db_handle = new DBController();
    
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
        $contact = $row['contact'];
        $email = $row['email'];
        $title = $row['title'];
        $about = $row['about'];
        $address = $row['address'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        require_once('../auth/db.php');
        if($_SESSION['type']==1){
        }
        else{
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
    <title>Checkout</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-number-input.css">
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
                <li class=" nav-item"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Cart</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="d-flex align-items-center" href="../user/ecommerce-checkout.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Checkout</span></a>
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
                        <li><a class="d-flex align-items-center" href="../user/user-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">General</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Checkout</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">eCommerce</a>
                                    </li>
                                    <li class="breadcrumb-item active">Checkout
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="bs-stepper checkout-tab-steps">
                    <!-- Wizard starts -->
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-cart">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="shopping-cart" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Cart</span>
                                    <span class="bs-stepper-subtitle">Your Cart Items</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-address">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="home" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Address</span>
                                    <span class="bs-stepper-subtitle">Enter Your Address</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-payment">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="credit-card" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Payment</span>
                                    <span class="bs-stepper-subtitle">Select Payment Method</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- Wizard ends -->

                    <div class="bs-stepper-content">
                            <div id="step-cart" class="content">
                                <div id="place-order" class="list-view product-checkout">
                                    <!-- Checkout Place Order Left starts -->
                                    <div class="checkout-items">
                                        <?php
                                            $products_posted="SELECT * from cart WHERE user_id ='$user_id'  order by cart_id desc ";                
                                            $results=mysqli_query($conn,$products_posted);      
                                                $cartTotal = 0;           
                                                $shipping_total =0;
                                                while($row = $results -> fetch_assoc()){
                                                    $product_id = $row['product_id'];
                                                    $quantity = $row['quantity'];
                                                    $products_ordered="SELECT * from products WHERE product_id = $product_id";  
                                                    $res=mysqli_query($conn,$products_ordered);

                                                    while($fetch = $res-> fetch_assoc()){       
                                                        $cartTotal += ($fetch["price"] * $row["quantity"] );  
                                                        // $totalPayment += ($cartTotal + $row['shipping_fee']);  
                                                        $seller_id = $fetch['seller_id'];
                                                        $shipping_fee =  $fetch['shipping_fee'];
                                                        $shipping_total += $fetch['shipping_fee'];
                                                        $product_name = $fetch['product_name'];
                                                        $brand = $fetch['brand'];
                                                        $sql2="SELECT SUM(quantity) as sum from orders WHERE product_id ='$product_id'";                 
                                                        $sold=mysqli_query($conn,$sql2);
                                                        $val = $sold -> fetch_array();
                                                        $total = $val['sum'];                                                         
                                                            
                                        ?>
                                        <div class="card ecommerce-card">
                                            <div class="item-img">
                                                <a href="ecommerce-details.php?p=<?=$product_id?>&sell=<?=$total?>&seller=<?=$seller_id?>">
                                                    <img src="../img/product/<?= $fetch['file1']?>" alt="img-placeholder" />
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <div class="item-name">
                                                    <h6 class="mb-0"><a href="ecommerce-details.php?p=<?=$product_id?>&sell=<?=$total?>&seller=<?=$seller_id?>"><?= $product_name?></a></h6>
                                                    <span class="item-company">By <a href="javascript:void(0)" class="company-name"><? $fetch['brand']?></a></span>
                                                    <!-- <div class="item-rating">
                                                        <ul class="unstyled-list list-inline">
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                                <span class="text-success mb-1">In Stock</span>
                                                <div class="item-quantity">
                                                    <span class="quantity-title">Qty:</span>
                                                    <div class="input-group quantity-counter-wrapper">
                                                        <input type="text" class="quantity-counter" value="<?=$quantity?>"readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-options text-center">
                                                <div class="item-wrapper">
                                                    <div class="item-cost">
                                                        <h4 class="item-price"><?php echo "₱ ".$fetch['price'] ?></h4>
                                                        <p class="card-text shipping">
                                                            <span class="badge badge-pill badge-light-success">Free Shipping</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <a href="../auth/users/delete-item-cart.php?i=<?php echo $row['cart_id']?>" class="btn btn-danger mt-1 remove-wishlist">
                                                    <i data-feather="x" class="align-middle mr-25"></i>
                                                    <span>Remove</span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php }}?>
                                    </div>
                                    <!-- Checkout Place Order Left ends -->
    
                                    <!-- Checkout Place Order Right starts -->
                                    <div class="checkout-options">
                                        <div class="card">
                                            <div class="card-body">
                                                <label class="section-label mb-1">Options</label>
                                                <hr />
                                                <div class="price-details">
                                                    <h6 class="price-title">Price Details</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="price-detail">
                                                            <div class="detail-title">Total Item Cost</div>
                                                            <div class="detail-amt">₱<?php echo number_format($cartTotal, 2, '.', ',') ?></div>
                                                        </li>
                                                        <li class="price-detail">
                                                            <div class="detail-title">Delivery Charges</div>
                                                            <div class="detail-amt discount-amt text-success">Free</div>
                                                        </li>
                                                    </ul>
                                                    <hr />
                                                    <ul class="list-unstyled">
                                                        <li class="price-detail">
                                                            <div class="detail-title detail-total">Total</div>
                                                            <h3 class="detail-amt font-weight-bolder">₱<?php echo number_format($cartTotal, 2, '.', ',') ?></h3>
                                                        </li>
                                                    </ul>
                                                    <button type="button" class="btn btn-primary btn-block btn-next place-order">Place Order</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Checkout Place Order Right ends -->
                                    </div>
                                </div>
                                <!-- Checkout Place order Ends -->
                            </div>
                            <!-- Checkout Customer Address Starts -->
                            <div id="step-address" class="content">
                                <div id="checkout-address" class="list-view product-checkout">
                                    <!-- Checkout Customer Address Left starts -->
                                    <form action="../auth/users/place-orders.php" method="post">
                                        <div class="card">
                                            <div class="card-header flex-column align-items-start">
                                                <h4 class="card-title">Add New Address</h4>
                                                <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="checkout-name">Full Name:</label>
                                                            <input type="text" id="main1" class="form-control" name="fname" placeholder="John Doe" value="<?= $fname?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="checkout-number">Mobile Number:</label>
                                                            <input type="number" id="main2" class="form-control" name="contact" placeholder="0123456789" value="<?= $contact?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="checkout-apt-number">Flat, House No:</label>
                                                            <input type="text" id="main3" class="form-control" name="address" placeholder="9447 Glen Eagles Drive" value="<?= $address?>" required/>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="checkout-landmark">Landmark e.g. near apollo hospital:</label>
                                                            <input type="text" id="checkout-landmark" class="form-control" name="landmark" placeholder="Near Apollo Hospital" />
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="checkout-pincode">Zipcode:</label>
                                                            <input type="number" id="main4" class="form-control" name="zipcode" placeholder="201301" required/>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="checkout-state">State:</label>
                                                            <input type="text" id="checkout-state" class="form-control" name="state" placeholder="California" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="add-type">Address Type:</label>
                                                            <select class="form-control" id="add-type">
                                                                <option>Home</option>
                                                                <option>Work</option>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-12">
                                                        <button name="place-order-cod" type="submit" class="btn btn-primary ">Save And Deliver Here</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Checkout Customer Address Left ends -->
    
                                    <!-- Checkout Customer Address Right starts -->
                                    <!-- <div class="customer-card">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title" id="mirror1"></h4>
                                            </div>
                                            <div class="card-body actions">
                                                <p class="card-text mb-0" id="mirror2"></p>
                                                <p class="card-text" id="mirror3"></p>
                                                <p class="card-text" id="mirror4"></p>
                                                <p class="card-text" id="outputName"></p>
                                                <button disable type="button" class="btn btn-primary btn-block btn-next delivery-address mt-2">
                                                    Deliver To This Address
                                                </button>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Checkout Customer Address Right ends -->
                                </div>
                            </div>
                            <!-- Checkout Customer Address Ends -->
    
                            <!-- Checkout Payment Starts -->
                            <div id="step-payment" class="content">
                                <div id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
                                    <div class="payment-type">
                                        <div class="card">
                                            <div class="card-header flex-column align-items-start">
                                                <h1 class="card-title">Thank You for Order in JobsEcom</h1>
                                                <p class="card-text text-muted mt-25">order again have a great day</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="customer-cvv mt-1">
                                                    <div class="form-inline">
                                                        <label class="mb-50" for="card-holder-cvv">Enter CVV:</label>
                                                        <input type="password" class="form-control ml-sm-75 ml-0 mb-50 input-cvv" name="input-cvv" id="card-holder-cvv" />
                                                        <button type="button" class="btn btn-primary btn-cvv ml-0 ml-sm-1 mb-50">Continue</button>
                                                    </div>
                                                </div>
                                                <hr class="my-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
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
    <script src="../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="../app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Copytext -->
    <script src="../src/copy-text.js"></script>
    <!-- END: Copytext -->


    <script>
        var main1 = document.getElementById('main1');
        var mirror1 = document.getElementById('mirror1');

        main1.addEventListener('input', function(event) {
        mirror1.innerText = event.target.value.split('').join('');
        });

        var main2 = document.getElementById('main2');
        var mirror2 = document.getElementById('mirror2');

        main2.addEventListener('input', function(event) {
        mirror2.innerText = event.target.value.split('').join('');
        });

        var main3 = document.getElementById('main3');
        var mirror3 = document.getElementById('mirror3');

        main3.addEventListener('input', function(event) {
        mirror3.innerText = event.target.value.split('').join('');
        });

        var main4 = document.getElementById('main4');
        var mirror4 = document.getElementById('mirror4');

        main4.addEventListener('input', function(event) {
        mirror4.innerText = event.target.value.split('').join('');
        });
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
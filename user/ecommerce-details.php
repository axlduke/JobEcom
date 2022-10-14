<?php
    session_start();
    include "../auth/db.php";
    require_once("../auth/dbcontroller.php");
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


require_once("../auth/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE brand='" . $_GET["brand"] . "'");
                $itemArray = array($productByCode[0]["brand"]=>array('product_name'=>$productByCode[0]["product_name"], 'brand'=>$productByCode[0]["brand"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
                
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode[0]["brand"],$_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode[0]["brand"] == $k)
                                    $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                                    $referer = $_SERVER['HTTP_REFERER'];
                                    header("Location: $referer"); 
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        $referer = $_SERVER['HTTP_REFERER'];
                                    header("Location: $referer");
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                    $referer = $_SERVER['HTTP_REFERER'];
                                    header("Location: $referer");
                }
            }
        break;
    }
}

    $p = $_GET['p'];
    $sell = $_GET['sell']; 
    $seller = $_GET['seller'];

    $likes = 0;
    $dislikes=0;
    $count_likes="SELECT SUM(star_like) as sum_likes from product_reviews WHERE product_id = $p";
    $count=mysqli_query($conn,$count_likes);
    $value = $count -> fetch_array();
    $likes = $value['sum_likes'];
    // Count Dislikes
    $count_dislikes="SELECT SUM(star_dislike) as sum_dislikes from product_reviews WHERE product_id = $p";
    $cnt=mysqli_query($conn,$count_dislikes);
    $val = $cnt -> fetch_array();
    $dislikes = $val['sum_dislikes'];
    if (($likes!=NULL) or (($dislikes!=NULL))) {
        $averageScore = $calculatedRating = calculateStarRating($likes, $dislikes);
        // get integer value of $averageScore
        $wholeStarCount = (int) $averageScore;
         // get integer value of 5 - $averageScore
        $noStarCount    = (int) (5 - $averageScore);
        // is $averageScore - $wholeStarCount larger than 0?
        $hasHalfStar    = $averageScore - $wholeStarCount > 0;
        $stars = str_repeat('<li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>' . PHP_EOL, $wholeStarCount) .
        ($hasHalfStar ? '<i class="fas fa-star-half-alt text-yellow" style="color:#F28C28;"></i>' . PHP_EOL : '') .
        str_repeat('<i class="fas fa-star"></i>' . PHP_EOL, $noStarCount);  

    } else{

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
    <title>Product Details </title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/swiper.min.css">
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-ecommerce-details.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-number-input.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sliders.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    
    <!-- END: Custom CSS-->

    <!-- swiper bundle -->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-swiper.css">
    <!-- swiper bundle -->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">       

    <script src="https://cdn.tailwindcss.com"></script>

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
                        <li class="active"><a class="d-flex align-items-center" href="../user/ecommerce-shop.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">E-Commerce</span></a>
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
                            <h2 class="content-header-title float-left mb-0">Product Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#_">eCommerce</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#_">Shop</a>
                                    </li>
                                    <li class="breadcrumb-item active">Details
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- app e-commerce details start -->
                <section class="app-ecommerce-details">
                    <div class="card">
                    <?php 
                        $q = "SELECT * from products WHERE product_id = $p";
                        $r=mysqli_query($conn,$q);
                        while($get_product = $r -> fetch_assoc()){
                            $product = $get_product["product_name"];
                            $brand = $get_product['brand'];
                            $quantity = $get_product["quantity"];
                            $price = $get_product["price"];
                            $desc = $get_product["product_description"];
                            $cat = $get_product["product_category"];
                            $fee = $get_product["shipping_fee"];
                            $y = $get_product["file1"];
                            $b = $get_product["file2"];
                            $c = $get_product["file3"];
                            $d = $get_product["file4"];
                            $e = $get_product["file5"];                     
                    ?>
                        <!-- Product Details starts -->
                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="card">
                                        <div class="card-body">
                                            <img id="feature" src="../img/product/<?php echo $y?>" class="py-6 aspect-square w-96 lg:w-[26rem] lg:aspect-square" alt="item-photo">
                                            <div class="grid grid-cols-5 lg:grid-cols-5 lg:w-[26rem] lg:-mt-52 lg:px-5 -mb-10 pb-12">
                                                <div class="lg:mt-52 w-16 h-16 lg:w-18 lg:h-20 opacity-50 hover:opacity-100 lg:opacity-50  lg:hover:opacity-100">
                                                    <img class="thumbnail active rounded-md" src="../img/product/<?php echo $b?>" alt="item-photo">
                                                </div>
                                                <div class="lg:mt-52 w-16 h-16 lg:w-18 lg:h-20 opacity-50 hover:opacity-100 lg:opacity-50  lg:hover:opacity-100">
                                                    <img class="thumbnail active rounded-md" src="../img/product/<?php echo $c?>" alt="item-photo">
                                                </div>
                                                <div class="lg:mt-52 w-16 h-16 lg:w-18 lg:h-20 opacity-50 hover:opacity-100 lg:opacity-50  lg:hover:opacity-100">
                                                    <img class="thumbnail active rounded-md" src="../img/product/<?php echo $d?>" alt="item-photo">
                                                </div>
                                                <div class="lg:mt-52 w-16 h-16 lg:w-18 lg:h-20 opacity-50 hover:opacity-100 lg:opacity-50  lg:hover:opacity-100">
                                                    <img class="thumbnail active rounded-md" src="../img/product/<?php echo $e?>" alt="item-photo">
                                                </div>
                                                <div class="lg:mt-52 w-16 h-16 lg:w-18 lg:h-20 opacity-50 hover:opacity-100 lg:opacity-50  lg:hover:opacity-100">
                                                    <img class="thumbnail active rounded-md" src="../img/product/<?php echo $y?>" alt="item-photo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <h4><?= $product?></h4>
                                        <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name"><?= $brand?></a></span>
                                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                            <h4 class="item-price mr-1">₱<?= number_format($price, 2, '.', ',') ?></h4>
                                            <!-- <ul class="unstyled-list list-inline pl-1 border-left"> -->
                                            <?php 
                                            if (($likes!=null) or (($dislikes!=null))) {
                                            echo round($calculatedRating = calculateStarRating($likes, $dislikes),1).' out of 5';     
                                            } else {
                                                echo '0 out of 5';     
                                            }
                                            ?></p>
                                            <ul class="unstyled-list list-inline pl-1 border-left">
                                            <?php                                 
                                            if (($likes!=null) or (($dislikes!=null))) {
                                            echo $stars;    
                                            } else { echo '
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>'; 
                                            }  ?>
                                            </ul>
                                        </div>
                                        <p class="card-text">
                                        <?php if($quantity >0){
                                            echo 'Available - <span class="text-success">In stock</span>'.'<?= $quantity?>';
                                        }else{
                                            echo 'Not available - <span class="text-danger">Out of stock</span>';
                                        }?>
                                        </p>
                                        <p class="card-text">
                                            <?= $desc?>
                                        </p>
                                        <ul class="product-features list-unstyled">
                                            <li><i data-feather="shopping-cart"></i> <span>Sold <?= $sell?></span></li>
                                            <li><i data-feather="shopping-cart"></i> <span>Stock <?= $quantity?></span></li>
                                            <li><i data-feather="shopping-cart"></i> <span>Free Shipping</span></li>
                                        </ul>
                                        <hr />
                                            <form action="../auth/users/add-cart.php" method="post">
                                                <div class="product-color-options">
                                                    <h6 class="ml-1">Quantity</h6>
                                                    <div class="cart-item-qty">
                                                        <div class="input-group">
                                                        <input name="quantity" class="touchspin-cart" type="number" value="1" max="<?php echo $quantity?>">
                                                        <!-- <input type="text"  value="1" size="2" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="d-flex flex-column flex-sm-row pt-1">
                                                <input type="text" name="product_id" value="<?= $p?>" class="hidden">
                                                <input type="text" name="seller_id" value="<?= $seller?>" class="hidden">
                                                <input type="text" name="user_id" value="<?= $user_id?>" class="hidden">
                                                <button name="add-cart-action" type="submit" class="mr-0 mr-sm-1 mb-1 mb-sm-0 btn btn-primary"><i data-feather="shopping-cart" class="mr-50"></i>Add to Cart</button>
                                                <!-- <a href="#_" class=" mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                    <i data-feather="shopping-cart" class="mr-50"></i>
                                                </a> -->
                                                <button name="buy-now-action" type="submit" class="mr-0 mr-sm-1 mb-1 mb-sm-0 btn btn-danger"><i data-feather="heart" class="mr-50"></i>Buy Now</button>
                                                <!-- <a href="#_" class="mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                    <i data-feather="heart" class="mr-50"></i>
                                                </a> -->
                                            </form>
                                            <div class="btn-group dropdown-icon-wrapper btn-share">
                                                <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="share-2"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                        <i data-feather="facebook"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                        <i data-feather="twitter"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                        <i data-feather="youtube"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                        <i data-feather="instagram"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- Product Details ends -->

                        <!-- Item features starts -->
                        <div class="item-features">
                            <div class="row text-center">
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="award"></i>
                                        <h4 class="mt-2 mb-1">100% Original</h4>
                                        <p class="card-text">Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="clock"></i>
                                        <h4 class="mt-2 mb-1">10 Day Replacement</h4>
                                        <p class="card-text">Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="shield"></i>
                                        <h4 class="mt-2 mb-1">1 Year Warranty</h4>
                                        <p class="card-text">Cotton candy gingerbread cake I love sugar plum I love sweet croissant.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item features ends -->

                        <!-- Related Products starts -->
                        <div class="card-body">
                            <div class="mt-4 mb-2 text-center">
                                <h4>Related Products</h4>
                                <p class="card-text">People also search for this items</p>
                            </div>                          
                            <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                <div class="swiper-wrapper">
                                <?php
                                                $likes = 0;   
                                                $dislikes = 0;                                    
                                                $recommend = "SELECT * from products where not product_id=$p and product_category = '$cat'";
                                                $result = $conn->query($recommend);
                                                while($row = $result->fetch_assoc()){
                                                    $pid = $row['product_id'];
                                                    $seller_id = $row['seller_id'];
                                                    $product_name = $row['product_name'];
                                                    $brand = $row['brand'];
                                                    $quantity = $row['quantity'];
                                                    $price = $row['price'];
                                                    $product_description = $row['product_description'];
                                                    $product_category = $row['product_category'];
                                                    $shipping_fee = $row['shipping_fee'];
                                                    $file1 = $row['file1'];
                                                    $file2 = $row['file2'];
                                                    $file3 = $row['file3'];
                                                    $file4 = $row['file4'];
                                                    $file5 = $row['file5'];
                                                    $sql2="SELECT SUM(quantity) as sum from orders WHERE product_id ='$pid'";                 
                                                    $sold=mysqli_query($conn,$sql2);
                                                    $val = $sold -> fetch_array();
                                                    $total = $val['sum'];    
                                                    $sql3="SELECT SUM(star_like) as sum_likes, SUM(star_dislike) as sum_dislikes from product_reviews WHERE product_id ='$pid'";                 
                                                    $sold=mysqli_query($conn,$sql3);
                                                    $val = $sold -> fetch_array();
                                                    $likes = $val['sum_likes'];   
                                                    $dislikes = $val['sum_dislikes'];
                                                    if (($likes!=NULL) or (($dislikes!=NULL))) {

                                                    $averageScore = $calculatedRating = calculateStarRating($likes, $dislikes);
                                                    // get integer value of $averageScore
                                                    $wholeStarCount = (int) $averageScore;
                                                     // get integer value of 5 - $averageScore
                                                    $noStarCount    = (int) (5 - $averageScore);
                                                    // is $averageScore - $wholeStarCount larger than 0?
                                                    $hasHalfStar    = $averageScore - $wholeStarCount > 0;
                                                $stars = str_repeat('<li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>' . PHP_EOL, $wholeStarCount) .
                                                ($hasHalfStar ? '<li class="ratings-list-item"><i data-feather="star" class="half-star-ratings"></i></li>' . PHP_EOL : '') .
                                                str_repeat('<li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>' . PHP_EOL, $noStarCount);  
                                            } else{

                                            }                                                                                                                             
                                ?> 
                                    <div class="swiper-slide">
 
                                        <a href="ecommerce-details.php?p=<?=$pid?>&sell=<?=$total?>&seller=<?=$seller_id?>">
                                            <div class="img-container w-70 mx-auto py-75">
                                                <img src="../img/product/<?= $file1?>" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                            <?php                                 
                                            if (($likes!=null) or (($dislikes!=null))) {
                                            echo $stars;    
                                            } else { echo '<li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>'; 
                                            }  ?>
                                                    <li class="ratings-list-item"><?php if ($total == null) {  
                                            } else {echo $_SESSION['total'] = '<span class="badge badge-pill badge-light-warning">' .$total.' SOLD</span>'; }?></li>
                                                </ul>
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0"><?php echo $row['product_name']; ?></h5>
                                                <small class="text-body">Brand: <?= $brand?></small>
                                            </div>
                                                <p class="card-text text-primary mb-0">₱<?= $price?></p>
                                            </div>
                                        </a>

                                    </div>
                                <?php }                           
                                 ?>
                                </div>
                                
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <!-- Related Products ends -->
                    </div>
                </section>
                <!-- app e-commerce details end -->
                <section id="nested-media-list">
                    <div class="row match-height">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Reviews</h4>
                                </div>
                                <?php
                                    $sql_query = "SELECT * FROM user WHERE user_id ='$seller'";
                                    $result = $conn->query($sql_query);
                                    while($rows1 = $result->fetch_array()){
                                        $business = $rows1['business'];
                                        $prof = $rows1['pictures'];
                                ?>
                                <div class="card-body">
                                    <div class="media">
                                            <img src="../img/profile/<?= $prof?>" class="mr-1" alt="sellerAvatar" height="64" width="64" />
                                            <h4 class="card-title mr-1"><?= $rows1['business']?></h4>
                                            <a  href="../chat/app-chat.php?incoming_id=<?php echo $seller_id?>" class="btn btn-danger btn-sm">Message</a>
                                    </div>
                                                    <!-- Basic Progress start -->
<!--                 <section id="basic-progress">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Basic Progress</h4>
                                </div>
                                <div class="card-body">
                                    <div class="demo-vertical-spacing">
                                        <div class="progress-wrapper">
                                            <div id="example-caption-1">5 Star rates: 0</div>
                                            <div class="progress progress-bar-primary">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%" aria-describedby="example-caption-1"></div>
                                            </div>
                                        </div>
                                        <div class="progress-wrapper">
                                            <div id="example-caption-2">4 Star rates: 0</div>
                                            <div class="progress progress-bar-primary">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="25" aria-valuemax="100" style="width: 80%" aria-describedby="example-caption-2"></div>
                                            </div>
                                        </div>
                                        <div class="progress-wrapper">
                                            <div id="example-caption-3">3 Star rates: 0</div>
                                            <div class="progress progress-bar-primary">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 60%" aria-describedby="example-caption-3"></div>
                                            </div>
                                        </div>
                                        <div class="progress-wrapper">
                                            <div id="example-caption-4">2 Star rates: 0</div>
                                            <div class="progress progress-bar-primary">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="75" aria-valuemax="100" style="width: 40%" aria-describedby="example-caption-4"></div>
                                            </div>
                                        </div> 
                                        <div class="progress-wrapper">
                                            <div id="example-caption-5">1 Star rates: 0</div>
                                            <div class="progress progress-bar-primary">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width: 20%" aria-describedby="example-caption-5"></div>
                                            </div>
                                        </div>                                                                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->
                <!-- Basic Progress end -->
                                </div> 
                                <?php }?>
                                <div class="card-body">
                                    <!-- Review Button -->
                                    <?php 
                                        $q =mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' AND product_id = $p");
                                        $q1 =mysqli_query($conn, "SELECT * FROM product_reviews where user_id = '$user_id' AND product_id = $p");  
                                        if(mysqli_num_rows($q1) <=0) {
                                        if(mysqli_num_rows($q) >= 1) {
                                        echo '                                
                                                    <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter1">
                                                        Add Review
                                                    </button>';
                                            }
                                        }
                                        else{                                        
                                        }

                                    ?>
                                    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Review Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                            <style>
                                                                .rating {
                                                                display: flex;
                                                                width: 100%;
                                                                justify-content: center;
                                                                overflow: hidden;
                                                                flex-direction: row-reverse;
                                                                height: 150px;
                                                                position: relative;
                                                                }

                                                                .rating-0 {
                                                                filter: grayscale(100%);
                                                                }

                                                                .rating > input {
                                                                display: none;
                                                                }

                                                                .rating > label {
                                                                cursor: pointer;
                                                                width: 40px;
                                                                height: 40px;
                                                                margin-top: auto;
                                                                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
                                                                background-repeat: no-repeat;
                                                                background-position: center;
                                                                background-size: 76%;
                                                                transition: .3s;
                                                                }

                                                                .rating > input:checked ~ label,
                                                                .rating > input:checked ~ label ~ label {
                                                                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
                                                                }


                                                                .rating > input:not(:checked) ~ label:hover,
                                                                .rating > input:not(:checked) ~ label:hover ~ label {
                                                                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
                                                                }
                                                            </style>
                                                    <form action="../auth/e-commerce/add-review-auth.php" method="post" role="form" enctype="multipart/form-data">
                                                            <div class="rating mt-n5">
                                                                <input required type="radio" name="rating" id="rating-5" value="5">
                                                                <label for="rating-5"></label>
                                                                <input type="radio" name="rating" id="rating-4" value="4">
                                                                <label for="rating-4"></label>
                                                                <input type="radio" name="rating" id="rating-3" value="3">
                                                                <label for="rating-3"></label>
                                                                <input type="radio" name="rating" id="rating-2" value="2">
                                                                <label for="rating-2"></label>
                                                                <input type="radio" name="rating" id="rating-1" value="1">
                                                                <label for="rating-1"></label>
                                                            </div>
                                                        <div class="form-group">
                                                            <label class="form-label" for="basic-default-name">Name</label>
                                                            <input type="text" class="form-control" id="basic-default-name" name="fname" value="<?= $fname?>"/>
                                                            <input name="product_id" type="hidden" value="<?= $p?>">
                                                            <input name="profile_pict" type="hidden" value="<?= $row['pictures']?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label" for="basic-default-email">Product Review</label>
                                                            <input type="text" id="basic-default-email" name="user_review" class="form-control" required/>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="customFile" name="img1" accept="image/*" />
                                                                    <label class="custom-file-label" for="customFile">Review Pic</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="customFile" name="img2" accept="image/*" />
                                                                    <label class="custom-file-label" for="customFile">Review Pic</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="customFile" name="img3" accept="image/*" />
                                                                    <label class="custom-file-label" for="customFile">Review Pic</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="customFile" name="img4" accept="image/*"  />
                                                                    <label class="custom-file-label" for="customFile">Review Pic</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-danger" name="review_button" value="Submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="media"> -->
                                        <!-- <div class="media-list media-bordered"> -->
                                             <?php 
                                            $sql ="SELECT product_reviews.*, user.user_id as user_id_review, user.pictures as pict, user.fname as names FROM product_reviews inner join user on product_reviews.user_id = user.user_id where product_id = $p";
                                            $results = $conn->query($sql);
                                            while($reviews = $results->fetch_array()){
                                                $names = $reviews['names'];
                                                $uid = $reviews['user_id_review'];
                                                $star_like = $reviews['star_like'];
                                                $star_dislike = $reviews['star_dislike'];
                                                $user_review = $reviews['user_review'];
                                                $picture1 = $reviews['review_picture_1'];
                                                $picture2 = $reviews['review_picture_2'];
                                                $picture3 = $reviews['review_picture_3'];
                                                $picture4 = $reviews['review_picture_4'];
                                                $timestamp = $reviews['date_review'];
                                                $profile_pict=$reviews['pict'];
                                            ?>
                                                
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img src="../img/profile/<?=$profile_pict?>" alt="avatar" height="64" width="64" class="cursor-pointer" />
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading px-1"><?=$names?>  <?=$star_like?>                                  
                                                         <span class="text-sm px-1 w-0 ml-11 flex-1 text-gray-400 truncate"><?php echo $timestamp; ?></span>
                                                         <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                                            <ul class="unstyled-list list-inline mb-25">
                                                             <?php 
                                                                $a=5-$star_like;
                                                                $j=1;                                  
                                                                for ($i=1; $i<=$star_like; $i++) 
                                                                { 
                                                                    echo '<li class="ratings-list-item"><i class="fas fa-star text-yellow" style="color:#F28C28;"></i></li>'; 
                                                                    if($i==$star_like){
                                                                        for ($j=1; $j<=$a; $j++){
                                                                            echo '<li class="ratings-list-item"><i class="fas fa-star"></i></li>';
                                                                        }
                                                                    }
                                                                } 
                                                             ?>
                                                            </ul>
                                                        </div>                                                         
                                                        </h4>   
                                                        <div><?=$user_review?></div>
                                                        
                                                    <div class="row mt-2 mb-1">
                                                    <?php 
                                                        if($picture1!=null){
                                                        echo'
                                                        <div  class="p-1">
                                                        <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter'.$uid.'">
                                                            <img src="../img/products_review/'.$picture1.'" class="mr-1" alt="avatar" height="64" width="64" />
                                                        </button>
                                                        </div>';
                                                    }else{}
                                                    if($picture2!=null){
                                                       echo'
                                                        <div class="p-1">
                                                        <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter'.$uid.'">
                                                            <img src="../img/products_review/'.$picture2.'" class="mr-1" alt="avatar" height="64" width="64" />
                                                        </button>
                                                        ';
                                                    }else{}
                                                    if($picture3!=null){
                                                        echo '
                                                    </div>
                                                    <div class="p-1">
                                                        <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter'.$uid.'">
                                                            <img src="../img/products_review/'.$picture3.'" alt="avatar" height="64" width="64" />
                                                        </button>
                                                    </div>';
                                                    }else{}
                                                    if($picture4!=null){
                                                        echo '
                                                    <div class="p-1">
                                                        <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#exampleModalCenter'.$uid.'">
                                                            <img src="../img/products_review/'.$picture4.'" class="mr-1" alt="avatar" height="64" width="64" />
                                                        </button>
                                                    </div>';
                                                    }else{}
                                                    ?> </div>
                                                    <hr class="py-1">
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalCenter<?php echo $uid?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Reviews</h5>
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
                                                                        </ol>
                                                                        <div class="carousel-inner" role="listbox">
                                                                            <div class="carousel-item active">
                                                                                <img class="img-fluid" src="../img/products_review/<?= $picture1?>" alt="First slide" />
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img class="img-fluid" src="../img/products_review/<?= $picture2?>" alt="Second slide" />
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img class="img-fluid" src="../img/products_review/<?= $picture3?>" alt="Third slide" />
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <img class="img-fluid" src="../img/products_review/<?= $picture4?>" alt="Third slide" />
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
                                                <!-- <img src="../app-assets/images/portrait/small/avatar-s-13.jpg" class="mr-1" alt="avatar" height="64" width="64" />
                                                <img src="../app-assets/images/portrait/small/avatar-s-13.jpg" class="mr-1" alt="avatar" height="64" width="64" />
                                                <img src="../app-assets/images/portrait/small/avatar-s-13.jpg" class="mr-1" alt="avatar" height="64" width="64" />
                                                <img src="../app-assets/images/portrait/small/avatar-s-13.jpg" class="mr-1" alt="avatar" height="64" width="64" /> -->
                                                     
                                                </div>
                                            </div>                                       
                                        <?php }
                                        // if (($likes!=NULL) or (($dislikes!=NULL))) {
                                        function calculateStarRating($likes, $dislikes){ 
                                            $maxNumberOfStars = 5; // Define the maximum number of stars possible.
                                            $totalRating = $likes + $dislikes; // Calculate the total number of ratings.
                                            $likePercentageStars = ($likes / $totalRating) * $maxNumberOfStars;
                                            return $likePercentageStars;
                                            }                                    
                                        ?> 
                                        <!-- </div> -->
                                        <!-- </div> -->

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

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
    <script src="../app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/wNumb.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/nouislider.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
    <script src="../app-assets/js/scripts/forms/form-number-input.js"></script>
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

        let thumbnails = document.getElementsByClassName('thumbnail');
        let activeImages = document.getElementsByClassName('active');
        for(var i = 0; i < thumbnails.length; i++){
            thumbnails[i].addEventListener('mouseover', function(){
                /*
                if (activeImages.length > 0) {
                    activeImages[0].classList.remove('active');
                }
                */
                this.classList.add('active')
                document.getElementById('feature').src = this.src;
            })
        }
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
    unset($_SESSION['status_icon']);
    unset($_SESSION['status_title']);
    unset($_SESSION['status_text']);
}
?>      
</body>
<!-- END: Body-->

</html>
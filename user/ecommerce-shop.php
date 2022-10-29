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
        $title = $row['title'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        $theme = $row['theme'];
        require_once('../auth/db.php');
        if($_SESSION['type']==1){
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
    <title>Shop Page</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/swiper.min.css">    
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sliders.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-swiper.css">    
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
 
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <!-- Bootstrap Css -->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-detached-left-sidebar navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-left-sidebar">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
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
                                        <h5><a class="badge badge-pill badge-light-danger" href="../auth/users/delete-item-cart.php?i=<?php echo $row['cart_id']?>"><i data-feather='x'></i></a></h5>
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
                            <h2 class="content-header-title float-left mb-0">Shop</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#_">eCommerce</a>
                                    </li>
                                    <li class="breadcrumb-item active">Shop
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-detached">
                <div class="content-body">


                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Search Bar Starts -->
                    <form action="ecommerce-shop-search.php" method="post">
                        <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-merge">
                                        <!-- <input name="search" type="text" class="form-control search-product" id="search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" /> -->                      
                                        <input class="form-control search-product" list="search" type="text" class="form-control" placeholder="Search Here" name="search" aria-describedby="shop-search" autocomplete="off" />
                                            <datalist id="search">
                                                <?php
                                                    $search_sql = "SELECT product_name FROM products";
                                                    $search_result=mysqli_query($conn,$search_sql); 
                                                    while($row = $search_result->fetch_array())
                                                    {
                                                        echo "<option value='".$row['product_name']."'></option>";
                                                    }                                                    
                                                ?>
                                            </datalist>
                                        <div class="input-group-append">
                                            <button name="search_products" type="submit" class="input-group-text"><i data-feather="search" class="text-muted"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                    <!-- E-commerce Search Bar Ends -->
                        <!-- Related Products starts -->
                        <br>
                        <div class="card">
                        <div class="card-body">
                            <div class="mt-4 mb-2 text-center">
                                <h4>Trends</h4>
                                <p class="card-text">People also search for this items</p>
                            </div>                          
                            <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                <div class="swiper-wrapper">
                                <?php
                                    $collab = "SELECT * from orders WHERE user_id = '$user_id'";
                                    $q=mysqli_query($conn,$collab);
                                    if($c = $q->fetch_array()){
                                    $p=$c['product_id'];
                                    }
                                    if (empty($p)) {
                                        // code...
                                    }
                                    else{
                                    $maketemp = "
                                    CREATE temporary table ub_rank as 
                                    select similar.user_id,count(*) rank
                                    from orders target 
                                    join orders similar on target.product_id= similar.product_id and target.user_id != similar.user_id
                                    where target.user_id = $user_id and target.product_id = $p
                                    group by similar.user_id;
                                    "; 
                                    $results=mysqli_query($conn,$maketemp);

                                    $sql = "SELECT similar.product_id, sum(ub_rank.rank) total_rank
                                    from ub_rank
                                    join orders similar on ub_rank.user_id = similar.user_id
                                    left join orders target on target.user_id = $user_id and target.product_id = similar.product_id
                                    where target.product_id is null 
                                    group by similar.product_id 
                                    order by rand() desc";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_array()){
                                        $p_id = $row['product_id'];
                                        // $products_posted="SELECT * from products WHERE product_id =$p_id and product_category ='$cat'";
                                        $products_posted="SELECT * from products WHERE product_id ='$p_id'";
                                        $results=mysqli_query($conn,$products_posted); 
                                            while($get_products = $results -> fetch_assoc()){
                                                $product_id = $get_products['product_id'];
                                                $seller_id = $get_products['seller_id'];
                                                $product_name = $get_products['product_name'];
                                                $brand = $get_products['brand'];
                                                $quantity = $get_products['quantity'];
                                                $price = $get_products['price'];
                                                $product_description = $get_products['product_description'];
                                                $product_category = $get_products['product_category'];
                                                $shipping_fee = $get_products['shipping_fee'];
                                                $file1 = $get_products['file1'];
                                                $file2 = $get_products['file2'];
                                                $file3 = $get_products['file3'];
                                                $file4 = $get_products['file4'];
                                                $file5 = $get_products['file5'];
                                                $sql2="SELECT SUM(quantity) as sum from orders  WHERE product_id ='$product_id'";                 
                                                $sold=mysqli_query($conn,$sql2);
                                                $val = $sold -> fetch_array();
                                                $total = $val['sum']; 
                                                $rate="SELECT SUM(star_like) as sum_likes, SUM(star_dislike) as sum_dislikes from product_reviews  WHERE product_id ='$product_id'";                 
                                                $s=mysqli_query($conn,$rate);
                                                $v = $s -> fetch_array();
                                                $likes = $v['sum_likes'];
                                                $dislikes = $v['sum_dislikes'];  
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
 
                                        <a href="ecommerce-details.php?p=<?=$product_id?>&sell=<?=$total?>&seller=<?=$seller_id?>">
                                            <div class="card-body">
                                                <div class="item-wrapper">
                                            <div class="img-container w-60 mx-auto py-75">
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
                                                    } else {echo $_SESSION['total'] = '<span class="badge badge-pill badge-light-warning">' .$total.' SOLD</span>'; }?>
                                                    </li>
                                                </ul>
                                                <div class="item-heading">
                                                <h5 class="text-truncate mb-0"><?php echo $get_products['product_name']; ?></h5>
                                                <small class="text-body">Brand: <?= $brand?></small>
                                            </div>
                                                <h6 class="badge badge-pill badge-light-info">₱<?= number_format($price, 2, '.', ',') ?></h6>
                                            </div>
                                            </div></div>
                                        </a>

                                    </div>
                                <?php }}}  ?>
                                </div>
                                
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            </div>
                        </div>
                        <!-- Related Products ends -->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                        <?php 
                            $sql = "SELECT * FROM products ORDER BY rand()";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_array()){
                                    $product_id = $row['product_id'];
                                    $sql2="SELECT SUM(quantity) as sum from orders WHERE product_id ='$product_id'";                 
                                    $sold=mysqli_query($conn,$sql2);
                                    $val = $sold -> fetch_array();
                                    $total = $val['sum'];
                                    
                                    $brand = $row['brand'];
                                    $seller_id = $row['seller_id'];
                                    $product_name = $row['product_name'];
                                    $product_description = $row['product_description'];
                                    $product_category = $row['product_category'];
                                    $file1 = $row['file1'];
                                    $price = $row['price'];
                                    $sql2 = "SELECT *,sum(star_like) as sum_likes, sum(star_dislike) as sum_dislikes FROM product_reviews where product_id = '$product_id'";
                                    $res = $conn->query($sql2); 
                                    while($r = $res->fetch_array()){
                                    $likes = $r['sum_likes'];
                                    $dislikes = $r['sum_dislikes']; 
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
                        <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="ecommerce-details.php?p=<?= $product_id?>&sell=<?= $total?>&seller=<?= $seller_id?>">
                                    <img class="img-fluid card-img-top" src="../img/product/<?= $file1?>" style="height: 20rem; width: 27.5rem;" alt="img-products" /></a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                            <ul class="unstyled-list list-inline pl-1 border-left">
                                            <?php                                 
                                            if (($likes!=null) or (($dislikes!=null))) {
                                            echo $stars;    
                                            } else { echo '<li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>'; 
                                            }  ?><li class="ratings-list-item"><?php if ($total == null) {  
                                            } else {echo $_SESSION['total'] = '<span class="badge badge-pill badge-light-warning">' .$total.' SOLD</span>'; }?></li>
                                            </ul>
                                        <ul class="unstyled-list list-inline">
                                    </div>
                                    <div>
                                        <h6 class="badge badge-pill badge-light-info">₱<?= number_format($price, 2, '.', ',') ?></h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="ecommerce-details.php?p=<?= $product_id?>&sell=<?= $total?>&seller=<?= $seller_id?>"><?= $product_name?></a>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name"><?= $brand?></a></span>
                                </h6>
                                <p class="card-text item-description">
                                    <?= $product_description?><br>
                                    <?php if ($total == null) {  
                                    } else {echo $total," SOLD"; }?>
                                </p>
                            </div>
                            <form action="ecommerce-shop.php?action=add&brand=<?php echo $brand ?>" method="post">
                                <div class="item-options text-center">
                                    <div class="item-wrapper">
                                        <div class="item-cost">
                                            <h4 class="item-price">₱<?= number_format($price, 2, '.', ',') ?></h4>
                                        </div>
                                        <input name="quantity" class="hidden" type="number" value="1">
                                    </div>
<!--                                     <a href="ecommerce-details.php?p=<?= $product_id?>&sell=<?= $total?>" class="btn btn-light btn-wishlist">
                                        <i data-feather="heart"></i>
                                        <span>View</span>
                                    </a> -->
                                </div>
                            </form>
                        </div>
                        <?php 
                        }               
                        }            
                            function calculateStarRating($likes, $dislikes){ 
                            $maxNumberOfStars = 5; // Define the maximum number of stars possible.
                            $totalRating = $likes + $dislikes; // Calculate the total number of ratings.
                            $likePercentageStars = ($likes / $totalRating) * $maxNumberOfStars;
                            return $likePercentageStars;
                        }
                     ?>
                    </section>
                    <!-- E-commerce Products Ends -->
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
    <script>

    </script>

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
    <script src="../app-assets/js/scripts/pages/app-ecommerce.js"></script>
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
    </script>

</body>
<!-- END: Body-->

</html>
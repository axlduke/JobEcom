<?php
    session_start();
    include "../auth/db.php";
    
    if (!isset($_SESSION['user_id'])){
        echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
        echo '<script>window.location.replace("login.php");</script>';
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
    
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>Jobs</title>
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">   
    <!-- autocomplete search -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
    <!-- autocomplete search -->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-detached-left-sidebar navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-left-sidebar">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <?php
                $session_items = 0;
                if(!empty($_SESSION["cart_item"])){
                    $session_items = count($_SESSION["cart_item"]);
                }   
            ?>
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
                        <li class=" active"><a class="d-flex align-items-center" href="../user/user-job.php"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Invoice">Job Portal</span></a>
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
                            <h2 class="content-header-title float-left mb-0">JOBS</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#_">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#_">Jobs Search</a>
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
                    <form action="user-job-search.php" method="post">
                        <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                            <div class="row mt-1">
                                <div class="col-sm-12 search-box">
                                    <div class="input-group input-group-merge">
                                        <!-- autocomplete -->
                                        <input class="form-control search-product" list="search" type="text" class="form-control" placeholder="Search Here" name="search" aria-describedby="shop-search" autocomplete="off" />
                                            <datalist id="search">
                                                <?php
                                                    $search_sql = "SELECT job_title FROM jobs_post";
                                                    $search_result=mysqli_query($conn,$search_sql); 
                                                    while($row = $search_result->fetch_array())
                                                    {
                                                        echo "<option value='".$row['job_title']."'></option>";
                                                    }                                                    
                                                ?>
                                            </datalist>                                        
                                        <!-- <input type="text" id="txtCountry"> -->
                                        <div class="input-group-append">
                                            <button name="search_position" class="input-group-text"><i data-feather="search" class="text-muted"></i></button>
                                        </div>
                                    </div>
                                    <!-- <div id="show-list"></div> -->
                                </div>
                            </div>
                        </section>
                    </form>
                    <br>
                    <!-- E-commerce Search Bar Ends -->
                        <!-- Related Products starts -->
                        <!-- <div class="row match-height"> -->
                        <div class="card">
                        <div class="card-body">
                            <div class="mt-4 mb-2 text-center">
                                <h4>Trending Jobs</h4>
                            </div>                          
                            <div class="swiper-responsive-breakpoints swiper-container px-12 py5">
                                <div class="swiper-wrapper">
                                <?php
                                    $collab = "SELECT * from applicants WHERE user_id = '$user_id'";
                                    $q=mysqli_query($conn,$collab);
                                    if($c = $q->fetch_array()){
                                    $p=$c['job_id'];
                                    }
                                    if (empty($p)) {
                                        // code...
                                    }
                                    else{
                                    $maketemp = "
                                    CREATE temporary table ub_rank as 
                                    select similar.user_id,count(*) rank
                                    from applicants target 
                                    join applicants similar on target.job_id= similar.job_id and target.user_id != similar.user_id
                                    where target.user_id = '$user_id' and target.job_id = '$p'
                                    group by similar.user_id;
                                    "; 
                                    $results=mysqli_query($conn,$maketemp);

                                    $sql = "SELECT similar.job_id, sum(ub_rank.rank) total_rank
                                    from ub_rank
                                    join applicants similar on ub_rank.user_id = similar.user_id
                                    left join applicants target on target.user_id = '$user_id' and target.job_id = similar.job_id 
                                    where target.job_id is null 
                                    group by similar.job_id 
                                    ";
                                    $result = $conn->query($sql);
                                    while($rows = $result->fetch_array()){
                                        $jid = $rows['job_id'];
                                        $jobs_related="SELECT *,SUBSTRING(jobs_post.job_about, 1, 170) as job_about,SUBSTRING_INDEX(jobs_post.job_qualification, ',', 3) as qualification,SUBSTRING(jobs_post.job_title, 1, 45) as job_title from jobs_post inner join user on user.user_id = jobs_post.employer_id where jobs_post.post_id = '$jid' order by rand()"; 
                                         $results=mysqli_query($conn,$jobs_related);           
                                         while($row = mysqli_fetch_array($results)) { 
                                            $post_id = $row['post_id'];
                                            $date_posted = $row['date_posted'];
                                            $employer_id = $row['employer_id'];                                               
                                ?>  
                                <div class="swiper-slide">
                                <div class="border">
                                    <div class="card card-apply-job">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="media">
                                                    <div class="avatar mr-1">
                                                        <img src="../img/profile/<?=$row['pictures']?>" alt="Avatar" width="42" height="42" />
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="mb-0"><?=$row['fname']?></h5>
                                                        <small class="text-muted"><?=$row['date_posted']?></small><br><div class="badge badge-pill badge-light-primary"><?=$row['job_company']?></div> 
                                                    </div>
                                                </div>                    
                                            </div>
                                            <h5 class="apply-job-title"><?=$row['job_title']?></h5>
                                            <p class="card-text mb-2">
                                                <?=$row['job_about']?>
                                            </p>
                                            <div class="apply-job-package bg-light-primary rounded">
                                                <div><div class="badge badge-pill badge-light-primary">Qualifications :</div>
                                                    <div>
                                                    <sub class="text-body"><small><?=$row['qualification']?></small></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="../auth/jobs/apply-auth.php" method="post" role="form">
                                                <input name="employer_id" class="hidden" type="text" value="<?=$employer_id?>">
                                                <input name="job_id" class="hidden" type="text" value="<?php echo $post_id?>">
                                                <input name="user_id" class="hidden" type="text" value="<?php echo $user_id?>">
                                                <input name="fname" class="hidden" type="text" value="<?php echo $fname ;?>">
                                                <?php 
                                                if($mode == 'work'){
                                                    echo '<a href="user-view-job-post.php?post='.$row['post_id'].'" class="btn btn-primary mr-1">&nbsp;&nbsp;  Details  &nbsp; </a>
                                                        <button name="apply" type="submit" class="btn btn-primary mr-12">&nbsp; &nbsp; Apply&nbsp; &nbsp; </button>';
                                                } elseif($mode != 'work'){
                                                    echo '&nbsp Your account is not on work mode';
                                                }

                                                ?>
                                            </form>                                        
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php }
                                     // }}
                                    }
                                }  ?>
                                </div>
                                
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            </div>
                            </div>
                         </div>   
                        <!-- Related Jobs ends -->
                <!-- Card Advance -->
                <div class="row match-height">
                    <!-- Apply Job Card -->
                <?php
                    $jobs_posted="SELECT *,SUBSTRING(jobs_post.job_about, 1, 177) as job_about,SUBSTRING_INDEX(jobs_post.job_qualification, ',', 3) as qualification,SUBSTRING(jobs_post.job_title, 1, 60) as job_title from jobs_post inner join user on user.user_id = jobs_post.employer_id order by rand()";
                    $result=mysqli_query($conn,$jobs_posted);
                    if (mysqli_num_rows($result) > 0) {
                    $i=0;
                    $b = "&#8226;    ";
                    $dot = ".";                     
                    while($row = mysqli_fetch_array($result)) {
                        $post_id = $row['post_id'];
                        $date_posted = $row['date_posted'];
                        $employer_id = $row['employer_id'];
                        $arr_string = explode(",",$row['qualification']);                        
                ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-apply-job">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="media">
                                        <div class="avatar mr-1">
                                            <img src="../img/profile/<?=$row['pictures']?>" alt="Avatar" width="42" height="42" />
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-0"><?=$row['fname']?></h5>
                                            <small class="text-muted"><?=$date_posted?></small><br><div class="badge badge-pill badge-light-primary"><?=$row['company']?></div> 
                                        </div>
                                    </div>                    
                                </div>
                                <h5 class="apply-job-title"><?=$row['job_title']?></h5>
                                <p class="card-text mb-2">
                                    <?=$row['job_about']?>
                                </p>
                                <div class="apply-job-package bg-light-primary rounded">
                                    <div><div class="badge badge-pill badge-light-primary">Qualifications :</div>
                                        <div>
                                        <sub class="text-body"><small>
                                            <?php   
                                          foreach($arr_string as $str){
                                                echo $b. $str . "<br />";
                                            }
                                            ?>  
                                            </small></sub>
                                        </div>
                                    </div>
                                </div>
                                <form action="../auth/jobs/apply-auth.php" method="post" role="form">
                                    <input name="employer_id" class="hidden" type="text" value="<?=$employer_id?>">
                                    <input name="job_id" class="hidden" type="text" value="<?php echo $post_id?>">
                                    <input name="user_id" class="hidden" type="text" value="<?php echo $user_id?>">
                                    <input name="fname" class="hidden" type="text" value="<?php echo $fname ;?>">
                                        <?php 
                                        if($mode == 'work'){
                                            echo '<a href="user-view-job-post.php?post='.$row['post_id'].'" class="btn btn-primary mr-1">More Details</a>
                                                <button name="apply" type="submit" class="btn btn-primary mr-12">&nbsp &nbsp  Apply  &nbsp &nbsp</button>';
                                        } elseif($mode != 'work'){
                                            echo '&nbsp &nbsp Your account is not on work mode';
                                        }

                                        ?>
                                </form>                                        
                            </div>
                        </div>
                    </div>
                    <?php }}?>
                    <!--/ Apply Job Card -->
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

    <!-- autocomplete -->
    <script>
        $(document).ready(function () {
            $('#txtCountry').typeahead({
                source: function (query, result) {
                    $.ajax({
                        url: "script.php",
                        data: 'query=' + query,            
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            result($.map(data, function (item) {
                                return item;
                            }));
                        }
                    });
                }
            });
        });
    </script>
    <!-- autocomplete -->
    
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
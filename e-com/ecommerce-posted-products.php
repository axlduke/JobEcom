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
        $theme =$row['theme'];
        $shop_name = $row['business'];
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
?>
<!DOCTYPE html>
<html class="<?=$theme?>" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>Products Posted</title>
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
                <li class=" active"><a class="d-flex align-items-center" href="ecommerce-posted-products.php"><i data-feather='shopping-bag'></i><span class="menu-title text-truncate" data-i18n="eCommerce">Products</span></a>
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Products</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard-ecommerce.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Ecommerce</a>
                                    </li>
                                    <li class="breadcrumb-item active">Products Posted
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body"> 
            <!-- Create Post        -->
                <div style="text-align: right;">
                    <div class="disabled-backdrop-ex">
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="false" data-target="#backdrop">
                        Create Post
                    </button>
                    <!-- Modal -->
                            <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel4">Create Post</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <section id="multiple-column-form">
                                                <div class="row">
                                                    <div class="col-12">
                                                            <div class="card-body">
                                                                <form action="../auth/e-commerce/ecommerce-post-product-action.php" method="POST" role="form" enctype="multipart/form-data">
                                                                    <div class="row">                                            
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="product-name-column">Product Name</label>
                                                                                <input type="text" id="product-name-column" class="form-control" placeholder="Product Name" name="product_name" / required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="brand-name-column">Brand</label>
                                                                                <input list="brand" type="text" id="brand-name-column" class="form-control" placeholder="Brand" name="brand" required autocomplete="off" />
                                                                                <datalist id="brand">
                                                                                    <?php
                                                                                        $search_sql = "SELECT brand FROM products";
                                                                                        $search_result=mysqli_query($conn,$search_sql); 
                                                                                        while($row = $search_result->fetch_array())
                                                                                        {
                                                                                            echo "<option value='".$row['brand']."'></option>";
                                                                                        }                                                    
                                                                                    ?>
                                                                                </datalist>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="category-column">Category</label>
                                                                                <input list="categories" type="text" id="category-column" class="form-control" placeholder="Category" name="product_category" required/>
                                                                                <datalist id="categories">
                                                                                    <option value="women clothes">
                                                                                    <option value="men clothes">
                                                                                    <option value="beauty">
                                                                                    <option value="health">
                                                                                    <option value="fashion accessories">
                                                                                    <option value="home appliances">
                                                                                    <option value="men shoes">
                                                                                    <option value="mobile & gadget">
                                                                                    <option value="travel & luggage">
                                                                                    <option value="women bags">
                                                                                    <option value="women accessories">
                                                                                    <option value="women shoes">
                                                                                    <option value="men bags">
                                                                                    <option value="men accessories">
                                                                                    <option value="watches">
                                                                                    <option value="audio">
                                                                                    <option value="shoes unisex">
                                                                                    <option value="bags unisex">
                                                                                    <option value="food & beverage">
                                                                                    <option value="pets">
                                                                                    <option value="mom & baby">
                                                                                    <option value="baby & kids fashion">
                                                                                    <option value="gaming & consoles">
                                                                                    <option value="cameras & drones">
                                                                                    <option value="home & living">
                                                                                    <option value="sports & outdoors">
                                                                                    <option value="stationary">
                                                                                    <option value="hobbies & collections">
                                                                                    <option value="automobiles">
                                                                                    <option value="motorcycles">
                                                                                    <option value="books & magazines">
                                                                                    <option value="computers & accessories">
                                                                                </datalist>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="quantity-column">Quantity</label>
                                                                                <input type="number" id="quantity-column" class="form-control" name="quantity" placeholder="Quantity" required/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="weight-column">Weight</label>
                                                                                <input type="text" id="weight-column" class="form-control" name="weight" placeholder="Weight" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="price-column">Price</label>
                                                                                <input type="text" id="price-column" class="form-control" name="price" placeholder="Price" required/>
                                                                            </div>
                                                                        </div>
                                                                        <label for="email-id-column">Description</label>
                                                                        <textarea name="product_description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type here."required></textarea>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                            <input type="file" class="file-input h-full w-full" name="img1" accept="image/*">
                                                                            <input type="file" class="file-input h-full w-full" name="img2" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                            <input type="file" class="file-input h-full w-full" name="img3" accept="image/*">
                                                                            <input type="file" class="file-input h-full w-full" name="img4" accept="image/*">
                                                                            <input type="file" class="file-input h-full w-full" name="img5" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                            <div style="text-align:right;" class="col-12">
                                                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                                                            <button name="post_product" type="btn" class="btn btn-primary mr-1">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                            </div>
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
        <!-- Create Post        -->  
                <!-- Basic table -->
<!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Category</th>                                                                                      
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        $products_posted="SELECT  *  from products where seller_id = '$user_id'";
                                        $results=mysqli_query($conn,$products_posted);
                                            while($row = $results -> fetch_assoc()){
                                                $product_id = $row['product_id'];
                                                $product_name = $row['product_name'];
                                                $quantity = $row['quantity'];
                                                $product_category = $row['product_category'];
                                                $product_description = $row['product_description'];
                                                $price = $row['price'];
                                                $brand = $row['brand'];
                                                echo '                                        <tr>
                                            <td>
                                                '.$i.'
                                            </td>                                            
                                            <td>
                                                <span class="badge badge-pill badge-light-primary">'.substr($product_name, 0, 25).'</span>
                                            </td>                                             
                                            <td>
                                                <span class="badge badge-pill badge-light-info">'.$quantity.'</span>
                                            </td>                                                                                        
                                            <td>
                                                <span class="badge badge-pill badge-light-warning">₱ '.number_format($price, 2, '.', ',').'</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light-secondary">'.$product_category.'</span>
                                            </td>                                                                                      
                                            <td style="text-align: center;">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#backdrop2'.$product_id.'">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a>  
                                                        <a class="dropdown-item"  href="../auth/e-commerce/delete-product.php?id='.$product_id.'">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>                                                                                    
                                            <!-- Update Post        -->                                                           
                                            <div style="text-align: right;">
                                                <div class="disabled-backdrop-ex">
                                                <!-- Modal -->
                                                <div class="modal fade text-left" id="backdrop2'.$product_id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel4">Update Post</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <section id="multiple-column-form">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                                <div class="card-body">
                                                                                    <form action="../auth/e-commerce/ecommerce-post-product-action.php" method="POST" role="form" enctype="multipart/form-data">
                                                                                        <div class="row">                                            
                                                                                            <div class="col-md-6 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="product-name-column">Product Name</label>
                                                                                                    <input type="text" id="product-name-column" class="form-control" value="'.$product_name.'" name="product_name" / required>
                                                                                                    <input type="hidden" class="form-control" value="'.$product_id.'" name="product_id" />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="brand-name-column">Brand</label>
                                                                                                    <input type="text" id="brand-name-column" class="form-control" 
                                                                                                    value="'.$brand.'" name="brand" required />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="category-column">Category</label>
                                                                                                    <input list="categories" type="text" id="category-column" class="form-control" value="'.$product_category.'" name="product_category" required/>
                                                                                                    <datalist id="categories">
                                                                                                        <option value="women clothes">
                                                                                                        <option value="men clothes">
                                                                                                        <option value="beauty">
                                                                                                        <option value="health">
                                                                                                        <option value="fashion accessories">
                                                                                                        <option value="home appliances">
                                                                                                        <option value="men shoes">
                                                                                                        <option value="mobile & gadget">
                                                                                                        <option value="travel & luggage">
                                                                                                        <option value="women bags">
                                                                                                        <option value="women accessories">
                                                                                                        <option value="women shoes">
                                                                                                        <option value="men bags">
                                                                                                        <option value="men accessories">
                                                                                                        <option value="watches">
                                                                                                        <option value="audio">
                                                                                                        <option value="shoes unisex">
                                                                                                        <option value="bags unisex">
                                                                                                        <option value="food & beverage">
                                                                                                        <option value="pets">
                                                                                                        <option value="mom & baby">
                                                                                                        <option value="baby & kids fashion">
                                                                                                        <option value="gaming & consoles">
                                                                                                        <option value="cameras & drones">
                                                                                                        <option value="home & living">
                                                                                                        <option value="sports & outdoors">
                                                                                                        <option value="stationary">
                                                                                                        <option value="hobbies & collections">
                                                                                                        <option value="automobiles">
                                                                                                        <option value="motorcycles">
                                                                                                        <option value="books & magazines">
                                                                                                        <option value="computers & accessories">
                                                                                                    </datalist>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="quantity-column">Quantity</label>
                                                                                                    <input type="number" id="quantity-column" class="form-control" name="quantity" value="'.$quantity.'" required/>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="weight-column">Weight</label>
                                                                                                    <input type="text" id="weight-column" class="form-control" name="weight" placeholder="Weight" />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="price-column">Price</label>
                                                                                                    <input type="text" id="price-column" class="form-control" name="price" value="'.$price.'" required/>
                                                                                                </div>
                                                                                            </div>
                                                                                            <label for="email-id-column">Description</label>
                                                                                            <textarea name="product_description" class="form-control" id="exampleFormControlTextarea1" rows="3" value="'.$product_description.'" required>'.$product_description.'</textarea>
                                                                                                <div style="text-align:right;" class="col-12">
                                                                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                                                                                <button name="post_update" type="btn" class="btn btn-primary mr-1">Submit</button>
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
                                    <!-- Update Post        -->   
                                                </div>                                                
                                            </td>            
                                        </tr>  ';
                                        ?>             
                                    <?php $i += 1; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table head options end -->
                <!--/ Basic table -->


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
    <script src="../app-assets/js/scripts/tables/table-datatables-basic.js"></script>
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
<!--     <script>
        $('.prod_id').click(function(){
    //get cover id
    var id=$(this).data('id');
    //set href for cancel button
    $('#backdrop2').attr('href','delete-cover.php?id='+id);
})
    </script> -->
</body>
<!-- END: Body-->

</html>
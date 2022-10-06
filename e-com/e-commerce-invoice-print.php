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
    $order_id = $_GET['order_id'];

    $query = "SELECT orders.order_id, orders.user_id, orders.fname as fname, orders.phone, orders.complete_address as complete_address, orders.zip_code, orders.product_id as product_id, orders.quantity, orders.trx_id, orders.order_status, orders.date_ordered,products.product_id, products.product_name as product_name FROM orders INNER JOIN products ON orders.product_id=products.product_id WHERE orders.order_id= '$order_id'"; 
    // $query = "SELECT * FROM products where product_id = '$pid'";
    $res = $conn->query($query);
    if($get = $res->fetch_array()){ 
        $name = $get['fname'];
        $phone = $get['phone'];
        $complete_address = $get['complete_address'];
        // $product_name= $get['product_name'];
        $zipcode = $get['zip_code'];
        $product_id = $get['product_id'];
        $quantity = $get['quantity'];
        $trx_id = $get['trx_id'];
        $order_status = $get['order_status'];
        $date_ordered = $get['date_ordered'];
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
    <title>Invoice Print </title>
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-invoice-print.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="invoice-print p-3">
                    <div class="d-flex justify-content-between flex-md-row flex-column pb-2">
                        <div>
                            <div class="d-flex mb-1">
                                <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <linearGradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </linearGradient>
                                        <linearGradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </linearGradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <h3 class="text-primary font-weight-bold ml-1">JobsEcom</h3>
                            </div>
                            <p class="mb-25">Office 149, 450 South Brand Brooklyn</p>
                            <p class="mb-25">San Diego County, CA 91905, USA</p>
                            <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="font-weight-bold text-right mb-1">INVOICE</h4>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Date Issued:</p>
                                <p class="invoice-date"><?php if(empty($date_ordered)){echo '25/08/2020'; }else {echo $date_ordered;} ?></p>
                            </div> 
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">TRX ID:</p>
                                <p class="invoice-date"><?php if(empty($trx_id)){echo '#3492'; }else {echo $trx_id;} ?></p>
                            </div>                                
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row pb-2">
                        <div class="col-sm-6">
                            <h6 class="mb-1">Invoice To:</h6>
                            <h6 class="mb-25"><?php if(empty($name)){echo 'Name Here'; }else {echo $name;} ?></h6>
                            <p class="mb-25"><?php if(empty($complete_address)){echo 'Address here'; }else {echo $complete_address,', ',$zipcode;} ?></p>
                        </div>
                        <div class="col-sm-6 mt-sm-0 mt-2">
                            <h6 class="mb-1">Mode of Payment:</h6>
                            <table>
                                <tbody>
                                        <tr>
                                            <h6 class="mb-25">Cash on Delivery</h6>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th class="py-1">Product Name</th>
                                    <th class="py-1">Price</th>
                                    <th class="py-1">Quantity</th>
                                    <th class="py-1">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(empty($trx_id)){}
                                else{   
                                $cartTotal = 0;
                                    $sql1 = "SELECT products.product_id, products.price,products.shipping_fee ,products.product_name, products.seller_id, orders.trx_id, orders.quantity FROM products inner join orders on  products.product_id = orders.product_id inner join user on products.seller_id = user.user_id Where orders.trx_id = '$trx_id' AND products.seller_id = $user_id";
                                        $results = $conn->query($sql1);
                                        while($fetch = $results->fetch_array()){
                                            $sql="SELECT SUM(quantity) as sum from orders WHERE product_id = ".$fetch['product_id'];
                                            $sold=mysqli_query($conn,$sql);
                                            $val = $sold -> fetch_array();
                                            $total = $val['sum'];                                                             
                                            $cartTotal += ($fetch["price"] * $fetch["quantity"]);
                                ?>                                  
                                <tr>
                                    <td class="py-1 pl-4">
                                        <?php echo $fetch['product_name'];?>
                                    </td>
                                    <td class="py-1">
                                        <strong>₱<?php echo number_format($fetch['price'], 2, '.', ',') ?></strong>
                                    </td>
                                    <td class="py-1">
                                        <strong><?php echo $fetch['quantity'];?></strong>
                                    </td>
                                    <td class="py-1">
                                        <strong>₱<?php echo number_format($fetch['price']*$fetch['quantity'], 2, '.', ',') ?></strong>
                                    </td>
                                </tr>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>

                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            <p class="card-text mb-0">
                                                <span class="font-weight-bold">Shopname:</span> <span class="ml-75"><?php if(empty($shop_name)){echo 'Disney'; }else {echo $shop_name;} ?></p></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Total:</p>
                                                    <p class="invoice-total-amount">₱<?php if(empty($cartTotal)){}else{ echo number_format($cartTotal, 2, '.', ',');} ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                    <hr class="my-2" />

                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Note:</span>
                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                projects. Thank You!</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


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
    <script src="../app-assets/js/scripts/pages/app-invoice-print.js"></script>
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
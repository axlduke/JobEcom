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
        $contact = $row['contact'];
        $email = $row['email'];
        $title = $row['title'];
        $about = $row['about'];
        $address = $row['address'];
        $company = $row['company'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        $theme =$row['theme'];
        require_once('../auth/db.php');
        if($_SESSION['type']==3){
        }
        else{
            header('location: ../form/login.php');
        }
    }
    $jobs_posted="SELECT *,SUBSTRING(job_about, 1, 300) as job_about, SUBSTRING_INDEX(job_qualification, ',', 3) as qualification from jobs_post where employer_id = ".$_SESSION['user_id'];
    $result=mysqli_query($conn,$jobs_posted);
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
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">  

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
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?= $fname ?></span><span class="user-status"><?= $company?></span></div><span class="avatar"><img class="round" src="../img/profile/<?= $pictures?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
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
                <li class=" nav-item"><a class="d-flex align-items-center" href="dashboard-analytics.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="available-user.php"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="jobseekers">Job Seekers</span></a>
                </li>  
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="../chat/app-chat.php"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="Invoice">Manage Jobs</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="d-flex align-items-center" href="posted-jobs.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Posted Job List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="applicants-list.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Applicants</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Account</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="employer-profile.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="employer-account-settings.php"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">General</span></a>
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
                            <h2 class="content-header-title float-left mb-0">Jobs</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Manage Jobs</a>
                                    </li>
                                    <li class="breadcrumb-item active">Posted Jobs
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div style="text-align: right;">
                    <div class="disabled-backdrop-ex">
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="false" data-target="#backdrop">
                        Create Jobs
                    </button>
                    <!-- Modal -->
                            <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel4">Create Jobs</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <section id="multiple-column-form">
                                                <div class="row">
                                                    <div class="col-12">
                                                            <div class="card-body">
                                                                <form action="../auth/jobs/post-jobs.php" method="POST">
                                                                            <div class="form-group">
                                                                                <label for="brand-name-column">Job Company</label>
                                                                                <input type="text" class="form-control" value="<?=$company?>"name="job_company" disabled />
                                                                            </div>                     
                                                                            <div class="form-group">
                                                                                <label for="product-name-column">Job Title</label>
                                                                                <input list="search" type="text" class="form-control"  name="job_title" required  autocomplete="off"/>
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
                                                                            </div>
                                                                        <label for="email-id-column">Job Experience</label>
                                                                        <textarea name="job_experience" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type here."required></textarea>
                                                                        <label for="email-id-column">Qualification</label>
                                                                        <textarea name="job_qualification" class="form-control" id="exampleFormControlTextarea2" rows="3" placeholder="Type here."required></textarea>
                                                                        <label for="email-id-column">Description</label>
                                                                        <textarea name="job_about" class="form-control" id="exampleFormControlTextarea3" rows="3" placeholder="Type here."required></textarea><br>
                                                                        <!-- <button name="post" type="btn" class="btn btn-primary mr-1">Submit</button> -->
                                                                        <button type="btn" name="post" class="btn btn-primary mr-1">Submit</button>
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
            <div class="content-body">
                <!-- Card Advance -->
                <div class="row match-height">
                    <!-- Apply Job Card -->
                <?php
                    if (mysqli_num_rows($result) > 0) {
                    $i=0;
                    $b = "&#8226;    ";
                    $dot = "."; 
                    while($row = mysqli_fetch_array($result)) {
                        $post_id = $row['post_id'];
                        $date_posted = $row['date_posted'];
                         $arr_string = explode(",",$row['qualification']);
                ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-apply-job">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="media">
                                        <div class="avatar mr-1">
                                            <img src="../img/profile/<?=$pictures?>" alt="Avatar" width="42" height="42" />
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-0"><?=$fname?></h5>
                                            <small class="text-muted"><?=$date_posted?></small><br><div class="badge badge-pill badge-light-primary"><?=$company?></div> 
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
                                        <sub class="text-body"><small><?php   
                                          foreach($arr_string as $str){
                                                echo $b. $str . "<br />";
                                            }
                                            ?>
                                        </small></sub>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-1" data-toggle="modal" data-target="#backdrop<?php echo $row['post_id']?>"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Edit &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;'; ?></button>
                                <a href="../auth/jobs/delete-job-action.php?post_id=<?=$post_id?>" type="submit" class="btn btn-primary mr-1"><?php echo '&nbsp;&nbsp; Delete  &nbsp;&nbsp;'; ?></a>

                                <!-- UPDATE POST -->
                                <div class="modal fade text-left" id="backdrop<?php echo $row['post_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
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
                                                                <form action="../auth/jobs/post-jobs.php" method="POST">
                                                                            <div class="form-group">
                                                                                <label for="brand-name-column">Job Company</label>
                                                                                <input type="text" class="form-control" value="<?=$company?>"name="job_company" disabled />
                                                                                <input type="hidden" value="<?=$post_id?>" class="form-control" placeholder="About" name="job_id" />
                                                                            </div>                     
                                                                            <div class="form-group">
                                                                                <label for="product-name-column">Job Title</label>
                                                                                <input type="text" class="form-control" value="<?=$row['job_title']?>" name="job_title" required />
                                                                            </div>
                                                                        <label for="email-id-column">Job Experience</label>
                                                                        <textarea name="job_experience" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type here."required><?=$row['job_experience']?></textarea>
                                                                        <label for="email-id-column">Qualification</label>
                                                                        <textarea name="job_qualification" class="form-control" id="exampleFormControlTextarea2" rows="3" placeholder="Type here."required><?=$row['job_qualification']?></textarea>                      
                                                                        <label for="email-id-column">Description</label>
                                                                        <textarea name="job_about" class="form-control" id="exampleFormControlTextarea3" rows="3" placeholder="Type here."required><?=$row['job_about']?></textarea><br>
                                                                        <!-- <button name="post" type="btn" class="btn btn-primary mr-1">Submit</button> -->
                                                                        <button type="btn" name="update" class="btn btn-primary mr-1">Submit</button>
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
                    </div>
                    <?php }}                        
                       
                        ?>
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
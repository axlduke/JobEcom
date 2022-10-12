<?php
session_start();
include '../db.php';
if (isset($_POST['verify'])) {
$uid = $_POST['uid'];
$email = $POST['user_email'];
$sql = "UPDATE user SET verification_status = 'Verified', front_id = '', back_id='' WHERE user_id = '$uid'";
        $result = mysqli_query($conn, $sql); 
        if($result){
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status_text'] = "Account Verified"; 
            $_SESSION['user_email'] = $_POST['user_email'];           
            header('location: ../../auth/admin/send-verification-email.php');

    }
}
if (isset($_POST['reject'])) {
$uid = $_POST['uid'];
$email = $POST['user_email'];
$sql = "UPDATE user SET verification_status = 'Rejected', front_id = '', back_id='' WHERE user_id = '$uid'";
        $result = mysqli_query($conn, $sql); 
        if($result){
            $_SESSION['status_icon'] = "error";
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status_text'] = "Account Verification Rejected";
            $_SESSION['user_email'] = $_POST['user_email'];
            header('location: ../../auth/admin/reject-verification-email.php');

    }
}

?>
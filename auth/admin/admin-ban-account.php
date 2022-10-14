<?php 
session_start();
include_once '../db.php';
    if (!isset($_SESSION['user_id'])){
		echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
		echo '<script>window.location.replace("../form/login.php");</script>';
	}

$user = $_SESSION['user_id'];
$uid = $_GET['uid'];
$sql = "UPDATE user SET restriction = 'Banned' WHERE user_id = '$uid'";
        $result = mysqli_query($conn, $sql); 
        if($result){
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Account Banned!";
            $_SESSION['status_text'] = "You have successfully banned the user";
            header('location: ../../admin/admin-users-list.php');

    }

?>
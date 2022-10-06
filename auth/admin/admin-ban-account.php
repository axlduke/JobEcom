<?php 
session_start();
include_once '../db.php';
    if (!isset($_SESSION['user_id'])){
		echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
		echo '<script>window.location.replace("../login.php");</script>';
	}

$user = $_SESSION['user_id'];
$uid = $_GET['uid'];
$sql = "UPDATE user SET restriction = 'Banned' WHERE user_id = '$uid'";
        $result = mysqli_query($conn, $sql); 
        if($result){
            header('location: ../../admin/admin-users-list.php');

    }

?>
<?php 
session_start();
include_once '../db.php';
    if (!isset($_SESSION['user_id'])){
		echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
		echo '<script>window.location.replace("../form/login.php");</script>';
	}

$user = $_SESSION['user_id'];
$job_post = $_GET['job_post'];
$status = 'Accepted';
$sql = "DELETE FROM applicants WHERE `user_id` ='$user' and job_id =$job_post";
        $result = mysqli_query($conn, $sql);
        if($result){
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            header('location: ../../user/user-jobs-applied-list.php');
            // echo "Error";
        }

?>
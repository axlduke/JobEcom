<?php 
session_start();
include_once '../db.php';
    if (!isset($_SESSION['user_id'])){
		echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
		echo '<script>window.location.replace("../../form/login.php");</script>';
	}

$user = $_GET['user'];
$job = $_GET['job'];
$status = 'Accepted';
$email = $_GET['email'];
$job_title = $_GET['job_title'];
$employer_name = $_GET['employer_name'];
$sql = "UPDATE applicants SET status = '$status' WHERE `user_id` ='$user' and job_id =$job";
        $result = mysqli_query($conn, $sql);
        if($result){
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $_SESSION['user_email'] = $_GET['email'];
            $_SESSION['applicant_status'] = $status;
            $_SESSION['job_title'] = $_GET['job_title'];
            $_SESSION['employer_name'] = $_GET['employer_name'];            
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Accepted!";
            $_SESSION['status_text'] = "Application Accepted!";            
            header('location: applicant-accept-decline-email.php');
            // echo "Error";
        }

?>
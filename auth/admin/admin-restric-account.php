<?php 
session_start();
include '../db.php';
$admin_id = $_SESSION['user_id'];
if(isset($_POST['restrict_button'])){
 	$uid = $_POST['uid'];
 	$add_violation = 1;
    $starting_date=  trim(mysqli_real_escape_string($conn, $_POST['starting_date']));
    $ending_date=  trim(mysqli_real_escape_string($conn, $_POST['ending_date']));
        $sql = "UPDATE user SET restriction = 'Restricted', starting_date='$starting_date', ending_date='$ending_date', total_violation=total_violation+'$add_violation' WHERE user_id = '$uid'";
        $result = mysqli_query($conn, $sql); 
        if($result){
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Account Restricted!";
            $_SESSION['status_text'] = "You have successfully restricted the user";
            header('location: ../../admin/admin-users-list.php');

    }
}    
?>
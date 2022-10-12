<?php
    include "../db.php";
    session_start();
    $id = $_GET['post_id'];
    $query = "DELETE FROM jobs_post WHERE post_id ='$id'";
    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_title'] = "Success!";
        $_SESSION['status_text'] = "Job Deleted.";         
        header("Location: ../../job/posted-jobs.php");      
    }    
?>
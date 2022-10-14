<?php
    include "../db.php";
    session_start();
    $id = $_GET['post_id'];
    $query = "DELETE FROM jobs_post WHERE post_id ='$id'";
    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_title'] = "Deleted!";
        $_SESSION['status_text'] = "Job Deleted.";         
        header("Location: ../../job/posted-jobs.php");      
    }    
?>
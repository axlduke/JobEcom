<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "db.php";
            $status = "Offline now";        
            $sql = mysqli_query($conn, "UPDATE user SET status = '{$status}' WHERE user_id=".$_SESSION['user_id']);
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../form/login.php");
            }
        }
?>
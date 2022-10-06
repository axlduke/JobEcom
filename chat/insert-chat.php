<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "../auth/db.php";
        date_default_timezone_set('Asia/Manila');
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = trim(mysqli_real_escape_string($conn, $_POST['message']));
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_message_id, outgoing_message_id, message, chat_date_time)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', CURRENT_TIMESTAMP)") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>
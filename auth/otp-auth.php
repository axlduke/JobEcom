<?php
session_start();
$email = $_SESSION['email'];

include 'db.php';

if(isset($_POST['code'])){
        $otp = $_POST['otp'];
        $_SESSION['otp'] =  $_POST['otp'];
        $check_otp = "SELECT * FROM user WHERE email = '$email' AND otp = '$otp'";
            $result_otp = mysqli_query($conn, $check_otp);
            
            if ($result_otp->num_rows > 0) {
            // header("Location ../create-pass.php");
            echo "<script>
            alert('You may now enter your new password');
            document.location.href = '../form/reset-password.php?otp=$otp'
            </script>";
        } else{echo "<script>
            alert('OTP does not match');
            document.location.href = '../form/otp-code.php';
            </script>";}   
    } 
    else{
        echo "<script>
            alert('OTP does not match');
            document.location.href = '../form/otp-code.php';
            </script>";
    }

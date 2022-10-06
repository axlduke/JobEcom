<?php

include 'db.php';

if(isset($_POST['code'])){
        
        $otp = $_POST['otp'];

        $check_otp = "SELECT otp FROM user WHERE otp = '$otp'";
            $result_otp = mysqli_query($conn, $check_otp);
            
            if ($result_otp->num_rows > 0) {
            // header("Location ../create-pass.php");
            echo "<script>
            alert('You may now enter your new password');
            document.location.href = '../create-pass.php?otp=$otp'
            </script>";
        } else{echo "<script>
            alert('OTP does not match');
            document.location.href = '../form/forgot-password.php';
            </script>";}   
    } else{
        echo "<script>
            alert('OTP does not match');
            document.location.href = '../form/forgot-password.php';
            </script>";
}

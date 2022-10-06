<?php
session_start();
include 'db.php';
$otp = $_SESSION['otp'];
$email = $_SESSION['email'];
if(isset($_POST['reset-pass'])){
    // $otp = $_POST['otp'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    if($password != $password2){
        $errors['password'] = '<p class="bg-bg-orange-300 border border-orange-600 text-red-600">Confirm password not matched!</p>';
        echo "<script>
        alert('Password does not Match Please try again!');
        document.location.href = '../form/reset-password.php?otp='.$otp.';
        window.history.go(-1);
        </script>";
        echo "<script>window.history.go(-1);</script>";
    } else{
        $password = $_POST['password'];
        $otp = $_POST['otp'];
        $check_otp = "SELECT * FROM user WHERE email = '$email' AND otp = '$otp'";
        $result_otp = mysqli_query($conn, $check_otp);
        while($row = $result_otp->fetch_array()){
            $user_id = $row['user_id'];
            $otpverf = $row['otp'];
            // echo $user_id;
            // echo $otp;
            $update = "UPDATE user SET password = '$password'  WHERE email = '$email' AND otp ='$otp'";
            $res_newpass = mysqli_query($conn,$update);
            // while($fetch = $res_newpass->fetch_array()){
            //     $user_id = $fetch;
            //     echo $user_id;
            // }
            if ($res_newpass) {
                $clear_otp = mysqli_query($conn, "UPDATE user SET otp = ' ' WHERE email = '$email' AND otp =$otp");
                session_unset();
                session_destroy();
                echo "<script>
                alert('Successfully Change password');
                document.location.href = '../form/login.php';
                </script>";
            }

        }
    }
}
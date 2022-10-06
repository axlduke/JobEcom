<?php
session_start();
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
  $email = $_POST['email'];
  $_SESSION['email'] = $email = $_POST['email'];

    $sql_query = "SELECT * FROM user WHERE email ='$email'";
    $result = $conn->query($sql_query);
    if($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $fname = $row['fname'];
        $contact = $row['contact'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];

      $otp = mt_rand(100000,999999);
      $mail = new PHPMailer(true);
    
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'jobsecom2@gmail.com'; // Your gmail
      $mail->Password = 'jlppxzdnwdxcmoln'; // Your gmail app password
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;
    
      $mail->setFrom('jobsecom2@gmail.com'); // Your gmail
    
      $mail->addAddress($_POST["email"]);
    
      $mail->addAddress($_POST["email"]);
    
      $mail->isHTML(true);
    
      $mail->Subject = 'Verification code to reset JobEcom password '.$otp.'';
      $mail->Body = '
      Hi '.$fname.'!
      
      Your verification code is '.$otp.'.
      
      Enter this code in our OTP verifier to reset your password.
      
      If you have any questions, send us an email jobsecom2@gmail.com.
      
      Were glad youre here!
      The JobEcom team';
    
      $mail->send();
    
      if ($mail ->send()) {
    
        $send_otp = mysqli_query($conn,"UPDATE user SET otp = $otp WHERE email='$email'");
      } else{}
    //   echo
    // "
    // <script>
    // alert('Sent Successfully on you're email please check right a way');
    // document.location.href = '../verification.php';
    // </script>
    // ";
      header("Location: ../form/otp-code.php");
    } else{
      echo $_SESSION['failed'] = '<span class="badge badge-pill badge-light-danger">No Email found on our lists</span>';
                header("location: ../form/forgot-password.php");
    }
  }

  
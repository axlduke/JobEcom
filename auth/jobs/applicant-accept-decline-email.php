<?php
session_start();
include '../db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if(isset($_SESSION['user_email'])){
  $email = $_SESSION['user_email'];
  $status = $_SESSION['applicant_status'];
  $job_title = $_SESSION['job_title'];
  $employer_name= $_SESSION['employer_name']; 
    $sql_query = "SELECT * FROM user WHERE email ='$email'";
    $result = $conn->query($sql_query);
    if($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $fname = $row['fname'];
        $contact = $row['contact'];

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
    
      $mail->addAddress($email);
    
      $mail->addAddress($email);
    
      $mail->isHTML(true);
    
      $mail->Subject = 'Job Application';
      $mail->Body = '
      Hi '.$fname.'!<br>
      <br>
      Your job application on '.$job_title.' posted by '.$employer_name.'<br>
      <br>
      has been '.$status.'. You can check your account for more information.<br>
      <br>
      If you have any questions, send us an email jobsecom2@gmail.com.<br>
      <br>
      Were glad youre here!
      The JobEcom team';
    
      $mail->send();

    //   echo
    // "
    // <script>
    // alert('Sent Successfully on you're email please check right a way');
    // document.location.href = '../verification.php';
    // </script>
    // ";
      header('location: ../../job/applicants-list.php');
    } 
  }
  

  ?>
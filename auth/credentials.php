<?php
    session_start();
    include 'db.php';

    if(isset($_POST['qualification'])){
        // $user_id = $_POST['user_id'];
        
        $exp_1 = trim(mysqli_real_escape_string($conn, $_POST['exp_1']));
        $exp_2 = trim(mysqli_real_escape_string($conn, $_POST['exp_2']));
        $exp_3 = trim(mysqli_real_escape_string($conn, $_POST['exp_3']));
        $exp_4 = trim(mysqli_real_escape_string($conn, $_POST['exp_4']));
        $exp_5 = trim(mysqli_real_escape_string($conn, $_POST['exp_5']));
        $educ_1 = trim(mysqli_real_escape_string($conn, $_POST['educ_1']));
        $educ_2 = trim(mysqli_real_escape_string($conn, $_POST['educ_2']));
        $educ_3 = trim(mysqli_real_escape_string($conn, $_POST['educ_3']));
        $educ_4 = trim(mysqli_real_escape_string($conn, $_POST['educ_4']));
        $educ_5 = trim(mysqli_real_escape_string($conn, $_POST['educ_5']));         
        $location="../img/credentials/";
        if(empty($_FILES['pdf_certificate']['tmp_name']) || !is_uploaded_file($_FILES['pdf_certificate']['tmp_name'])){
            $pdf_certificate = $_POST['resume'];}
        else{$pdf_certificate=$_FILES['pdf_certificate']['name'];trim(mysqli_real_escape_string($conn, $file_tmpcert=$_FILES['pdf_certificate']['tmp_name']));} 

        if(empty($_FILES['pdf_file']['tmp_name']) || !is_uploaded_file($_FILES['pdf_file']['tmp_name'])){
            $pdf_resume = $_POST['resume'];}
        else{$pdf_resume=$_FILES['pdf_file']['name'];trim(mysqli_real_escape_string($conn, $file_tmpresume=$_FILES['pdf_file']['tmp_name']));}

        if(empty($_FILES['pdf_cover']['tmp_name']) || !is_uploaded_file($_FILES['pdf_cover']['tmp_name'])){
            $pdf_cover_file = $_POST['cover'];}
        else{$pdf_cover_file=$_FILES['pdf_cover']['name'];trim(mysqli_real_escape_string($conn, $file_tmpcover=$_FILES['pdf_cover']['tmp_name']));}

        $user_id = $_POST['user_id'];
        $query = mysqli_query($conn, "SELECT * FROM credentials WHERE user_id = '$user_id'");
        if(mysqli_num_rows($query) > 0){
        $sql = "UPDATE credentials SET exp_1 = '$exp_1', exp_2 = '$exp_2', exp_3='$exp_3', exp_4='$exp_4', exp_5='$exp_5', educ_1='$educ_1', educ_2='$educ_2', educ_3='$educ_3', educ_4='$educ_4', educ_5='$educ_5', pdf_file='$pdf_resume',pdf_cover='$pdf_cover_file' , pdf_certificate='$pdf_certificate' where user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
                if($result){
                    move_uploaded_file($file_tmpcert, $location.$pdf_certificate);
                    move_uploaded_file($file_tmpresume, $location.$pdf_resume);
                    move_uploaded_file($file_tmpcover, $location.$pdf_cover_file);
                    $_SESSION['status_icon'] = "success";
                    $_SESSION['status_title'] = "Credentials Updated";
                    $_SESSION['status_text'] = "You have successfully updated your credentials";                       
                    header('Location: ../user/user-profile.php');

                }

        }
        else{        

        $sql1 = "INSERT INTO `credentials`(user_id, exp_1, exp_2, exp_3, exp_4, exp_5, educ_1, educ_2, educ_3, educ_4, educ_5,pdf_file,pdf_cover, pdf_certificate)
        VALUES ('$user_id','$exp_1','$exp_2','$exp_3','$exp_4','$exp_5','$educ_1','$educ_2','$educ_3','$educ_4','$educ_5','$pdf_resume','$pdf_cover','$pdf_certificate')";
        $result = mysqli_query($conn, $sql1);
            if($result){
                move_uploaded_file($file_tmpcert, $location.$pdf_certificate);
                move_uploaded_file($file_tmpresume, $location.$pdf_resume);
                move_uploaded_file($file_tmpcover, $location.$pdf_cover);
                    $_SESSION['status_icon'] = "success";
                    $_SESSION['status_title'] = "Credentials Updated";
                    $_SESSION['status_text'] = "You have successfully updated your credentials";                  
                header('Location: ../user/user-profile.php');

            }
        }
   
    }    

?>

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
        $location="../job/img/";
    
        if(empty($_FILES['cert_1']['tmp_name']) || !is_uploaded_file($_FILES['cert_1']['tmp_name'])){$cert_1 = $_POST['cert_1'];}else{$cert_1=$_FILES['cert_1']['name']; $file_tmp1=$_FILES['cert_1']['tmp_name'];}
        if(empty($_FILES['cert_2']['tmp_name']) || !is_uploaded_file($_FILES['cert_2']['tmp_name'])){$cert_2 = $_POST['cert_2'];}else{$cert_2=$_FILES['cert_2']['name']; $file_tmp2=$_FILES['cert_2']['tmp_name'];}
        if(empty($_FILES['cert_3']['tmp_name']) || !is_uploaded_file($_FILES['cert_3']['tmp_name'])){$cert_3 = $_POST['cert_3'];}else{$cert_3=$_FILES['cert_3']['name']; $file_tmp3=$_FILES['cert_3']['tmp_name'];}
        if(empty($_FILES['cert_4']['tmp_name']) || !is_uploaded_file($_FILES['cert_4']['tmp_name'])){$cert_4 = $_POST['cert_4'];}else{$cert_4=$_FILES['cert_4']['name']; $file_tmp4=$_FILES['cert_4']['tmp_name'];}
        if(empty($_FILES['cert_5']['tmp_name']) || !is_uploaded_file($_FILES['cert_5']['tmp_name'])){$cert_5 = $_POST['cert_5'];}else{$cert_5=$_FILES['cert_5']['name']; $file_tmp5=$_FILES['cert_5']['tmp_name'];}
        if(empty($_FILES['cert_6']['tmp_name']) || !is_uploaded_file($_FILES['cert_6']['tmp_name'])){$cert_6 = $_POST['cert_6'];}else{$cert_6=$_FILES['cert_6']['name']; $file_tmp6=$_FILES['cert_6']['tmp_name'];}

        if(empty($_FILES['pdf_file']['tmp_name']) || !is_uploaded_file($_FILES['pdf_file']['tmp_name'])){
            $pdf_resume = $_POST['resume'];}
        else{$pdf_resume=$_FILES['pdf_file']['name'];trim(mysqli_real_escape_string($conn, $file_tmpresume=$_FILES['pdf_file']['tmp_name']));}

        if(empty($_FILES['pdf_cover']['tmp_name']) || !is_uploaded_file($_FILES['pdf_cover']['tmp_name'])){
            $pdf_cover_file = $_POST['cover'];}
        else{$pdf_cover_file=$_FILES['pdf_cover']['name'];trim(mysqli_real_escape_string($conn, $file_tmpcover=$_FILES['pdf_cover']['tmp_name']));}                 

        // trim(mysqli_real_escape_string($conn, $pdf_file=$_FILES['pdf_file']['name']));
        // trim(mysqli_real_escape_string($conn, $file_tmpresume=$_FILES['pdf_file']['tmp_name']));
        // trim(mysqli_real_escape_string($conn, $pdf_cover=$_FILES['pdf_cover']['name']));
        // trim(mysqli_real_escape_string($conn, $file_tmpcover=$_FILES['pdf_cover']['tmp_name']));
        $user_id = $_POST['user_id'];
        $query = mysqli_query($conn, "SELECT * FROM credentials WHERE user_id = '$user_id'");
        if(mysqli_num_rows($query) > 0){
        $sql = "UPDATE credentials SET exp_1 = '$exp_1', exp_2 = '$exp_2', exp_3='$exp_3', exp_4='$exp_4', exp_5='$exp_5', educ_1='$educ_1', educ_2='$educ_2', educ_3='$educ_3', educ_4='$educ_4', educ_5='$educ_5', cert_1='$cert_1', cert_2='$cert_2', cert_3='$cert_3', cert_4='$cert_4', cert_5='$cert_5', cert_6='$cert_6',pdf_file='$pdf_resume',pdf_cover='$pdf_cover_file' where user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
                if($result){
                    move_uploaded_file($file_tmp1, $location.$cert_1);
                    move_uploaded_file($file_tmp2, $location.$cert_2);
                    move_uploaded_file($file_tmp3, $location.$cert_3);
                    move_uploaded_file($file_tmp4, $location.$cert_4);
                    move_uploaded_file($file_tmp5, $location.$cert_5);
                    move_uploaded_file($file_tmp6, $location.$cert_6);
                    move_uploaded_file($file_tmpresume, $location.$pdf_resume);
                    move_uploaded_file($file_tmpcover, $location.$pdf_cover_file);
                    header('Location: ../user/user-profile.php');

                }

        }
        else{        

        $sql1 = "INSERT INTO `credentials`(user_id, exp_1, exp_2, exp_3, exp_4, exp_5, educ_1, educ_2, educ_3, educ_4, educ_5, cert_1, cert_2, cert_3, cert_4, cert_5, cert_6,pdf_file,pdf_cover)
        VALUES ('$user_id','$exp_1','$exp_2','$exp_3','$exp_4','$exp_5','$educ_1','$educ_2','$educ_3','$educ_4','$educ_5','$cert_1','$cert_2','$cert_3','$cert_4','$cert_5','$cert_6','$pdf_resume','$pdf_cover')";
        $result = mysqli_query($conn, $sql1);
            if($result){
                move_uploaded_file($file_tmp1, $location.$cert_1);
                move_uploaded_file($file_tmp2, $location.$cert_2);
                move_uploaded_file($file_tmp3, $location.$cert_3);
                move_uploaded_file($file_tmp4, $location.$cert_4);
                move_uploaded_file($file_tmp5, $location.$cert_5);
                move_uploaded_file($file_tmp6, $location.$cert_6);
                move_uploaded_file($file_tmpresume, $location.$pdf_resume);
                move_uploaded_file($file_tmpcover, $location.$pdf_cover);
                header('Location: ../user/user-profile.php');

            }
        }
   
    }    

?>

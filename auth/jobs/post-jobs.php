<?php
    include "../db.php";
    session_start();
    $employer_id=$_SESSION['user_id'];
    if(isset($_POST['post'])){
        $job_title = trim(mysqli_real_escape_string($conn, $_POST['job_title']));
        $job_experience = trim(mysqli_real_escape_string($conn, $_POST['job_experience']));
        $job_company = trim(mysqli_real_escape_string($conn, $_POST['job_company']));
        $job_qualification = trim(mysqli_real_escape_string($conn, $_POST['job_qualification']));
        $date = date('Y-m-d H:i:s');
        $job_about = trim(mysqli_real_escape_string($conn, $_POST['job_about']));
        $post ="INSERT INTO jobs_post (employer_id, job_company, job_title, job_experience, job_qualification, date_posted, job_about) VALUES ('$employer_id','$job_company','$job_title','$job_experience','$job_qualification','$date','$job_about')";
        $result = mysqli_query($conn, $post);
        if($result){
            header("Location: ../../job/posted-jobs.php");
        }
         else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if(isset($_POST['update'])){
        $job_title = trim(mysqli_real_escape_string($conn, $_POST['job_title']));
        $job_id = trim(mysqli_real_escape_string($conn, $_POST['job_id']));
        $job_experience = trim(mysqli_real_escape_string($conn, $_POST['job_experience']));
        $job_company = trim(mysqli_real_escape_string($conn, $_POST['job_company']));
        $job_qualification = trim(mysqli_real_escape_string($conn, $_POST['job_qualification']));
        $date = date('Y-m-d H:i:s');
        $job_about = trim(mysqli_real_escape_string($conn, $_POST['job_about']));
        $post ="UPDATE jobs_post SET job_company='$job_company', job_title='$job_title', job_experience='$job_experience', job_qualification='$job_qualification', date_posted = '$date', job_about='$job_about' WHERE employer_id ='$employer_id' and post_id ='$job_id'";
        $result = mysqli_query($conn, $post);
        if($result){
            header("Location: ../../job/posted-jobs.php");
        }
         else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    $id = $_GET['post_id'];
    $query = "DELETE FROM jobs_post WHERE post_id ='$id' ";
    if($conn->query($query) === TRUE){
        header("Location: ../../job/posted-jobs.php");
    }    
?>


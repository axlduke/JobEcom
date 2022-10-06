<?php
    include "../db.php";
    session_start();
    $employer_id=$_SESSION['user_id'];
    
    $type = explode('.', $_FILES['job_logo']['name']);
    $type = $type[count($type) - 1];
    $logo = '../../img/job-logo/'.uniqid(rand()).'.'.$type;

    if(isset($_POST['post'])){
        $job_title = trim(mysqli_real_escape_string($conn, $_POST['job_title']));
        $job_experience = trim(mysqli_real_escape_string($conn, $_POST['job_experience']));
        $job_company = trim(mysqli_real_escape_string($conn, $_POST['job_company']));
        $job_qualification = trim(mysqli_real_escape_string($conn, $_POST['job_qualification']));
        $date = date('Y-m-d H:i:s');
        $job_about = trim(mysqli_real_escape_string($conn, $_POST['job_about']));

        if (in_array($type, array('jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
            if (is_uploaded_file($_FILES['job_logo']['tmp_name'])) {
                if (move_uploaded_file($_FILES['job_logo']['tmp_name'], $logo)) {

                    $post ="INSERT INTO jobs_post (employer_id, job_company, job_title, job_experience, job_qualification, logo, date_posted, job_about) VALUES ('$employer_id','$job_company','$job_title','$job_experience','$job_qualification','$logo','$date','$job_about')";
                    $result = mysqli_query($conn, $post);
                    if($result){
                        header("Location: ../../job/posted-job-list.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }else {
                    echo "Error while uploading post jobs.";
                }
            }
            else {
                echo "Error while updating profile photo.";
            }
        }
    }
    
            
    // if (!mysqli_query($conn,$post))
    // {
    // echo("Error description: " . mysqli_error($conn));
    // }
    // else{
    //     header('location: post.php');
    //     }
    // }
?>


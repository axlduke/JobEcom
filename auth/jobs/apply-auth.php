<?php
session_start();
include '../db.php';

    if(isset($_POST['apply'])){
        $user_id = $_POST['user_id'];
        $employer_id = $_POST['employer_id'];
        $fnamev = $_POST['fname'];
        $job_id = $_POST['job_id'];
        $date_applied = date('Y-m-d H:i:s');
        $status = 'Pending';
        $query =mysqli_query($conn, "SELECT * FROM applicants WHERE user_id = '$user_id' AND job_id = '$job_id'");
        if(mysqli_num_rows($query) > 0){
                    $_SESSION['status_icon'] = "error";
                    $_SESSION['status_title'] = "Error";
                    $_SESSION['status_text'] = "You have already applied for this job.";

                 header("Location: ../../user/user-job.php");
        }
        else{                
                $sql = "INSERT INTO applicants VALUES ('','$user_id','$fname','$employer_id','$job_id','$date_applied', '$status')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $_SESSION['status_icon'] = "success";
                    $_SESSION['status_title'] = "Applied";
                    $_SESSION['status_text'] = "You have successfully applied for the job";                      
                    header("Location: ../../user/user-job.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }                        

?>
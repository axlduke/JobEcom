<?php
    session_start();
    include "../auth/db.php";

    $outgoing_id = 2;
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM user WHERE NOT user_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= '<p style="text-align:center;">No user found related to your search term</p>';
    }
    echo $output;
?>
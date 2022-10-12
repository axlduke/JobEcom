<?php
    $conn = new PDO("mysql:host=localhost;dbname=propose", 'root', '');
    $stmt = $conn->prepare('SELECT SUM(`total_violation`) as Number FROM `user`  GROUP BY `total_violation`');
    $stmt->execute();
    $results = $stmt->fetchAll($conn::FETCH_OBJ);
    echo json_encode($results);
    ?>
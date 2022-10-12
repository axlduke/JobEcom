<?php
    $conn = new PDO("mysql:host=localhost;dbname=propose", 'root', '');
    $stmt = $conn->prepare('SELECT `business`,count(`fname`) as Number FROM `user` WHERE type = 2  GROUP BY `business`');
    $stmt->execute();
    $results = $stmt->fetchAll($conn::FETCH_OBJ);
    echo json_encode($results);
    ?>
<?php
    $conn = new PDO("mysql:host=localhost;dbname=propose", 'root', '');
    $stmt = $conn->prepare('SELECT `company`,count(`fname`) as Number FROM `user` WHERE type = 3  GROUP BY `company`');
    $stmt->execute();
    $results = $stmt->fetchAll($conn::FETCH_OBJ);
    echo json_encode($results);
    ?>
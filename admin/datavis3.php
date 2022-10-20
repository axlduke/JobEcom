<?php
    $conn = new PDO("mysql:host=localhost;dbname=propose", 'root', '');
    $stmt = $conn->prepare('SELECT `fname`,count(`fname`) as Number FROM `user` WHERE type = 3  GROUP BY `fname`');
    $stmt->execute();
    $results = $stmt->fetchAll($conn::FETCH_OBJ);
    echo json_encode($results);
    ?>
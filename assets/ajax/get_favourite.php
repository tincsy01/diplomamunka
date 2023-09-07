<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

session_start(); // Indítsd el a session-t, ha még nem történt meg

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_GET['attraction_id'])) {
        $attraction_id = $_GET['attraction_id'];
        $query = "SELECT * FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
        $result = $pdo->prepare($query);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
        $result->execute();

        if ($result->rowCount() > 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    } else {
        echo json_encode(false);
    }
} else {
    echo json_encode(false);
}
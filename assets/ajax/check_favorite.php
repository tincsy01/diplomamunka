<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $attraction_id = $_GET['attraction_id'];

    $is_favorite = checkIfFavorite($user_id, $attraction_id);

    header('Content-Type: application/json');
    echo json_encode(['is_favorite' => $is_favorite]);
} else {
    echo json_encode(['error' => 'User not logged in']);
}

function checkIfFavorite($user_id, $attraction_id) {
    global $pdo;
    $query = "SELECT * FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
    $result = $pdo->prepare($query);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
    $result->execute();

    if ($result->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
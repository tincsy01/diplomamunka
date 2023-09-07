<?php

require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Az AJAX kérés POST metódussal érkezett, tehát a kedvencekhez adás vagy eltávolítás műveletre kerül sor.
        $attraction_id = $_POST['attraction_id'];

        if (isFavorite($user_id, $attraction_id)) {
            // Az adott látványosság már a kedvencek között van, így törölnünk kell azt.
            removeFromFavorites($user_id, $attraction_id);
            echo json_encode(['is_favorite' => false]);
        } else {
            // Az adott látványosság még nincs a kedvencek között, hozzáadjuk.
            addToFavorites($user_id, $attraction_id);
            echo json_encode(['is_favorite' => true]);
        }
    }
} else {
    echo json_encode(['error' => 'User not logged in']);
}

function isFavorite($user_id, $attraction_id)
{
    global $pdo;
    $query = "SELECT * FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
    $result = $pdo->prepare($query);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
    $result->execute();

    return $result->rowCount() > 0;
}

function addToFavorites($user_id, $attraction_id)
{
    global $pdo;
    $query = "INSERT INTO favourites (user_id, attraction_id) VALUES (:user_id, :attraction_id)";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
    $statement->execute();
}

function removeFromFavorites($user_id, $attraction_id)
{
    global $pdo;
    $query = "DELETE FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
    $statement->execute();
}


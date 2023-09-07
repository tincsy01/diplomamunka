<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// Ellenőrizzük, hogy az AJAX kérés POST metódussal érkezett-e
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ellenőrizzük, hogy a szükséges adatokat elküldték-e
    if (isset($_POST['comment']) && isset($_POST['attraction_id']) && isset($_POST['rate'])) {
        // A POST adatokat változókba mentjük
        $comment = $_POST['comment'];
        $attraction_id = $_POST['attraction_id'];
        $rate = $_POST['rate'];

        // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User is not logged in']);
            exit;
        }

        $user_id = $_SESSION['user_id'];

        // Az aktuális dátum és idő lekérdezése
        $datetime = date('Y-m-d H:i:s');

        // Írd meg a SQL lekérdezést a komment hozzáadásához és az értékelés mentéséhez az adatbázisban

        // Példa SQL lekérdezés az INSERT utasítás használatával
        $sql = "INSERT INTO comments (user_id, attraction_id, comment, date, evaluation) VALUES (:user_id, :attraction_id, :comment, :date, :rating)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);
        $query->bindParam(':date', $datetime);
        $query->bindParam(':rating', $rate, PDO::PARAM_INT);

        try {
            // Kísérlet a komment beszúrására az adatbázisba
            $query->execute();

            // Ellenőrizzük, hogy a beszúrás sikeres volt-e, és válasz üzenetet küldünk vissza
            if ($query->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Comment added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add comment']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>

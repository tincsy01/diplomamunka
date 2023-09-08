<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment']) && isset($_POST['attraction_id']) && isset($_POST['rate'])) {
        $comment = $_POST['comment'];
        $attraction_id = $_POST['attraction_id'];
        $rate = $_POST['rate'];

        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User is not logged in']);
            exit;
        }
        $user_id = $_SESSION['user_id'];
        $datetime = date('Y-m-d H:i:s');


        $sql = "INSERT INTO comments (user_id, attraction_id, comment, date, evaluation) VALUES (:user_id, :attraction_id, :comment, :date, :rating)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);
        $query->bindParam(':date', $datetime);
        $query->bindParam(':rating', $rate, PDO::PARAM_INT);

        try {
            $query->execute();

            if ($query->rowCount() > 0) {
                $average = calculateAttractionAverageRating($attraction_id, $pdo);

                $updateSql = "UPDATE attractions SET popular = :average WHERE attraction_id = :attraction_id";
                $updateQuery = $pdo->prepare($updateSql);
                $updateQuery->bindParam(':average', $average, PDO::PARAM_STR);
                $updateQuery->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
                $updateQuery->execute();

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
function calculateAttractionAverageRating($attractionId, $pdo) {
    $sqlEvaluation = "SELECT SUM(evaluation) FROM comments WHERE attraction_id = :attraction_id";
    $queryEvaluation = $pdo->prepare($sqlEvaluation);
    $queryEvaluation->bindParam(':attraction_id', $attractionId, PDO::PARAM_INT);
    $queryEvaluation->execute();
    $evaluations = $queryEvaluation->fetchAll(PDO::FETCH_COLUMN);

    $sqlCount = "SELECT COUNT(*) AS count FROM comments WHERE attraction_id = :attraction_id";
    $queryCount = $pdo->prepare($sqlCount);
    $queryCount->bindParam(':attraction_id', $attractionId, PDO::PARAM_INT);
    $queryCount->execute();
    $resultCount = $queryCount->fetch(PDO::FETCH_ASSOC);

    $count = $resultCount['count'];
    $total = array_sum($evaluations);

    if ($count > 0) {
        $average = $total / $count;
    } else {
        $average = 0;
    }

    return $average;
}
?>

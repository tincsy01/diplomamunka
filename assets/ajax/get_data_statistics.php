<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["option"])) {
    $option = $_POST["option"];
    $data = array();
    $attraction_id = $_SESSION['working_at'];

    if ($option === "days") {
        $sql = "SELECT DAYNAME(date) AS day, SUM(num_of_visitors) AS visitors FROM visitors WHERE attraction_id = :attraction_id GROUP BY DAYNAME(date)";
    } elseif ($option === "months") {
        $sql = "SELECT MONTHNAME(date) AS month, SUM(num_of_visitors) AS visitors FROM visitors WHERE attraction_id = :attraction_id GROUP BY MONTH(date)";
    }

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':attraction_id', $attraction_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            if ($option === "days") {
                $data["labels"][] = $row["day"];
                $data["data"][] = $row["visitors"];
            } elseif ($option === "months") {
                $data["labels"][] = $row["month"];
                $data["data"][] = $row["visitors"];
            }
        }
    } catch (PDOException $e) {
        echo "Hiba az adatok lekérésekor: " . $e->getMessage();
    }

    echo json_encode($data);
} else {
    echo "Hibás kérés.";
}

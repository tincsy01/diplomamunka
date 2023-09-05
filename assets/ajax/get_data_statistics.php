<?php
session_start();
require_once '../../config/config.php';
require_once '../../config/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// Ellenőrizzük, hogy a napok vagy hónapok vannak-e kiválasztva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["option"])) {
    $option = $_POST["option"];
    $data = array();

    if ($option === "days") {
        // Ha a napok vannak kiválasztva, akkor napok alapján kérjük le az adatokat
        $sql = "SELECT DAYNAME(date) AS day, SUM(num_of_visitors) AS visitors FROM visitors GROUP BY DAYNAME(date)";
    } elseif ($option === "months") {
        // Ha a hónapok vannak kiválasztva, akkor hónapok alapján kérjük le az adatokat
        $sql = "SELECT MONTHNAME(date) AS month, SUM(num_of_visitors) AS visitors FROM visitors GROUP BY MONTH(date)";
    }

    try {
        $stmt = $pdo->prepare($sql);
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

//require_once '../../config/config.php';
//require_once '../../config/db_config.php';
//require_once '../php/includes/functions.php';
//$pdo = connectDatabase($dsn, $pdoOptions);
//
//if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["option"])) {
//    $option = $_POST["option"];
//    $data = array();
//
//    if ($option === "days") {
//        // Ha a napok vannak kiválasztva, akkor napok alapján kérjük le az adatokat
//        $sql = "SELECT DAYNAME(date) AS day, COUNT(*) AS visitors FROM visitors GROUP BY DAYNAME(date)";
//    } elseif ($option === "months") {
//        // Ha a hónapok vannak kiválasztva, akkor hónapok alapján kérjük le az adatokat
//        $sql = "SELECT MONTHNAME(date) AS month, COUNT(*) AS visitors FROM visitors GROUP BY MONTH(date)";
//    }
//
//    try {
//        $stmt = $pdo->prepare($sql);
//        $stmt->execute();
//        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        foreach ($result as $row) {
//            if ($option === "days") {
//                $data["labels"][] = $row["day"];
//                $data["data"][] = $row["visitors"];
//            } elseif ($option === "months") {
//                $data["labels"][] = $row["month"];
//                $data["data"][] = $row["visitors"];
//            }
//        }
//    } catch (PDOException $e) {
//        echo "Hiba az adatok lekérésekor: " . $e->getMessage();
//    }
//
//    echo json_encode($data);
//} else {
//    echo "Hibás kérés.";
//}
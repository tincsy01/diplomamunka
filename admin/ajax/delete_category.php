<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['category_id'])) {
        try {
            $category_id = $_POST['category_id'];

            $sql = "DELETE FROM categories WHERE category_id = :category_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();

            $response = array("success" => true, "message" => "Category deleted successfully.");
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("success" => false, "error" => "Error deleting Category: " . $e->getMessage());
            echo json_encode($response);
        }
    } else {
        $response = array("success" => false, "error" => "Missing data.");
        echo json_encode($response);
    }
} else {
    $response = array("success" => false, "error" => "Invalid request method.");
    echo json_encode($response);
}
<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
//var_dump($_POST); die();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["userId"]) && isset($_POST["updatedName"]) && isset($_POST["updatedEmail"]) && isset($_POST["updatedPermission"])) {
        try {
            $userId = $_POST["userId"];
            $updatedName = $_POST["updatedName"];
            $updatedEmail = $_POST["updatedEmail"];
            $updatedPermission = $_POST["updatedPermission"];
            $updatedActive = $_POST["updatedActive"];

            $sql = "UPDATE users SET name = :updated_name, email = :updated_email, permission = :updated_permission, active = :updatedActive WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':updated_name', $updatedName, PDO::PARAM_STR);
            $stmt->bindParam(':updated_email', $updatedEmail, PDO::PARAM_STR);
            $stmt->bindParam(':updated_permission', $updatedPermission, PDO::PARAM_INT);
            $stmt->bindParam(':updatedActive', $updatedActive, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $response = array("success" => true, "message" => "User updated successfully.");
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("success" => false, "error" => "Error updating user: " . $e->getMessage());
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
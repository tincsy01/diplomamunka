<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
require_once '../php/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$category = $_POST['category'];

$sql = "INSERT INTO categories (category)
        VALUES (:category)";
$query = $pdo->prepare($sql);

$query->bindParam(':category', $category, PDO::PARAM_STR);
$query->execute();

$response = array('success' => true, 'message' => 'Successfully added');
echo json_encode($response);
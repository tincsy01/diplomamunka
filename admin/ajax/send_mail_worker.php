<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
require_once '../php/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$email = $_POST['email'];

if(!existsEmail($email)){
    $code = createCode(40);
    $permission = 3;
    $sql = "INSERT INTO users (email, code, permission) VALUES (:email, :code, :permission)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':permission', $permission, PDO::PARAM_STR);
    sendRequestWorker($email, $code);
    $response = array('success' => true, 'message' => 'Successfully added');
    echo json_encode($response);
}
else{
    $response = array('success' => true, 'message' => 'This email is already exists');
    echo json_encode($response);
}
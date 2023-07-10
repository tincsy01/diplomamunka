<?php
require_once '../../config/config.php';
require_once '../../config/db_config.php';
require_once '../php/includes/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$permission = 2;
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
if(!existsUser($username, $email)){
    $sql = "INSERT INTO users
        (name, username, email, password, address, reg_expire, active, code, permission)
         VALUES
        (:name,:username,:email, :password, :address, :reg_expire, :active, :code, :permission)";

    $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
    $active = 0;
    $code = createCode(40);
    $datetime = new DateTime('tomorrow');
    $reg_expire= $datetime->format('Y-m-d H:i:s');

    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
    $query->bindParam(':active', $active, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':permission', $permission, PDO::PARAM_STR);
    $query->execute();

    sendData($email, $code);

    $response = array('success' => true, 'message' => 'Registrated');
    echo json_encode($response);
}
else{
    $response = array('success' => true, 'message' => 'This username or email is already exists');
    echo json_encode($response);
}




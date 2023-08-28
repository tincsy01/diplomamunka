<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
require_once '../php/functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$permission = 3;
$datetime = new DateTime('tomorrow');
$reg_expire= $datetime->format('Y-m-d H:i:s');
if(!existsUser($username, $email)){
    $sql = "INSERT INTO users
        (name, username, email, password, address, phone, reg_expire, active, code,  permission)
         VALUES
        (:name,:username,:email, :password, :address, :phone, :reg_expire, :active, :code, :permission)";
    $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
    $active = 1;
    $code = createCode(40);


    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
    $query->bindParam(':active', $active, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':permission', $permission, PDO::PARAM_INT);
    $query->execute();

    sendData($email, $code);

    $response = array('success' => true, 'message' => 'Successfully added');
    echo json_encode($response);
}

else{
    $response = array('success' => true, 'message' => 'This username or email is already exists');
    echo json_encode($response);
}

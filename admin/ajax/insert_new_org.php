<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
require_once '../php/functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['orgName']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['description'])) {
        $orgName = $_POST['orgName'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $username = $_POST['username'];
        $password = $_POST['password']; // Ez itt még nem biztonságos, jelszó hashelés szükséges
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $permission = 3;
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $active = 0;
        $code = createCode(40);
        $datetime = new DateTime('tomorrow');
        $reg_expire= $datetime->format('Y-m-d H:i:s');

        $pdo = connectDatabase($dsn, $pdoOptions);

        $sql = "INSERT INTO organizations(org_name, city_id, username, email, password, phone, address, code, reg_expire, active) VALUES 
                            (:org_name, :city_id, :username, :email, :password, :phone, :address, :code, :reg_expire, :active)";

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $active = 0;
        $datetime = new DateTime('tomorrow');
        $reg_expire= $datetime->format('Y-m-d H:i:s');

        $query = $pdo->prepare($sql);
        $query->bindParam(':org_name', $orgName, PDO::PARAM_STR);
        $query->bindParam(':city_id', $city, PDO::PARAM_INT);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
        $query->bindParam(':active', $active, PDO::PARAM_STR);
        $query->bindParam(':code', $code, PDO::PARAM_STR);

        $query->execute();

        $sql2 = "UPDATE cities SET organization_name = :org_name WHERE city_id = :city_id";
        $query = $pdo->prepare($sql2);
        $query->bindParam(':org_name', $orgName, PDO::PARAM_STR);
        $query->bindParam(':city_id', $city, PDO::PARAM_INT);
        $query->execute();

        if ($query->execute()) {
                $response = array('success' => true, 'message' => 'Organization added successfully.');
            } else {
                $response = array('success' => false, 'error' => 'Error adding organization.');
            }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(array('success' => false, 'error' => 'Missing required fields.'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Invalid request.'));
}
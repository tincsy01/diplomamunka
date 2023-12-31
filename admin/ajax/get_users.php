<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT name, user_id, permission, email, active FROM users";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$ret = [];
foreach ($result as $row) {
    $ret[] = [
      'user_id' => $row['user_id'],
      'name' => $row['name'],
      'email' => $row['email'],
      'active' => $row['active'],
      'permission' => $row['permission']
    ];
}
header('Content-Type: application/json');
echo json_encode($ret);

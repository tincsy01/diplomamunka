<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$sql = "SELECT org_id, c.city_name, org_name, phone, status, description, address, active FROM organizations o INNER JOIN cities c
        ON c.city_id = o.city_id";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$ret = []; // Új tömb a válasznak

foreach ($result as $row) {
    $ret[] = [
        "org_id" => $row['org_id'],
        "org_name" => $row['org_name'],
        "city_name" => $row['city_name'],
        'phone' => $row['phone'],
        'status' => $row['status'],
        'description' => $row['description'],
        'active' => $row['active'],
        'address' => $row['address']
    ];
}
header('Content-Type: application/json');
echo json_encode($ret);
?>
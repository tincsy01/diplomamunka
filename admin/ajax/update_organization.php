<?php
require_once '../php/config.php';
require_once '../php/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizd, hogy a szükséges adatok érkeztek-e
    if (isset($_POST['orgId']) && isset($_POST['updatedName']) && isset($_POST['updatedPhone'])  && isset($_POST['updatedAddress']) && isset($_POST['updatedDescription'])) {
        $orgId = $_POST['orgId'];
        $updatedName = $_POST['updatedName'];
        $updatedPhone = $_POST['updatedPhone'];
        $updatedStatus = $_POST['updatedStatus'];
        $updatedActive = $_POST['updatedActive'];
        $updatedAddress = $_POST['updatedAddress'];
        $updatedDescription = $_POST['updatedDescription'];

        try {
            // SQL lekérdezés az adatok frissítéséhez
            $sql = "UPDATE organizations 
                    SET org_name = :updatedName, 
                        phone = :updatedPhone, 
                        status = :updatedStatus, 
                        active = :updatedActive, 
                        address = :updatedAddress, 
                        description = :updatedDescription
                    WHERE org_id = :orgId";

            $query = $pdo->prepare($sql);

            // Változók kötése a lekérdezéshez
            $query->bindParam(':orgId', $orgId, PDO::PARAM_INT);
            $query->bindParam(':updatedName', $updatedName);
            $query->bindParam(':updatedPhone', $updatedPhone);
            $query->bindParam(':updatedStatus', $updatedStatus, PDO::PARAM_INT);
            $query->bindParam(':updatedActive', $updatedActive, PDO::PARAM_INT);
            $query->bindParam(':updatedAddress', $updatedAddress);
            $query->bindParam(':updatedDescription', $updatedDescription);

            // Lekérdezés végrehajtása
            if ($query->execute()) {
                $response = array('success' => true, 'message' => 'Organization updated successfully.');
            } else {
                $response = array('success' => false, 'error' => 'Error updating organization.');
            }
        } catch (PDOException $e) {
            $response = array('success' => false, 'error' => 'Database error: ' . $e->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(array('success' => false, 'error' => 'Missing required fields.'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Invalid request.'));
}
?>

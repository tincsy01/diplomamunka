<?php
require_once '../php/config.php';
require_once '../php/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['org_id'])) {
        $orgId = $_POST['org_id'];
        try {
            $pdo = connectDatabase($dsn, $pdoOptions);

            $checkOrgSql = "SELECT COUNT(*) FROM organizations WHERE org_id = :orgId";
            $checkOrgQuery = $pdo->prepare($checkOrgSql);
            $checkOrgQuery->bindParam(':orgId', $orgId, PDO::PARAM_INT);
            $checkOrgQuery->execute();
            $orgExists = $checkOrgQuery->fetchColumn();

            if ($orgExists) {
                $deleteAttractionsSql = "DELETE FROM attractions WHERE org_id = :orgId";
                $deleteAttractionsQuery = $pdo->prepare($deleteAttractionsSql);
                $deleteAttractionsQuery->bindParam(':orgId', $orgId, PDO::PARAM_INT);
                $deleteAttractionsQuery->execute();

                $deleteOrgSql = "DELETE FROM organizations WHERE org_id = :orgId";
                $deleteOrgQuery = $pdo->prepare($deleteOrgSql);
                $deleteOrgQuery->bindParam(':orgId', $orgId, PDO::PARAM_INT);

                if ($deleteOrgQuery->execute()) {
                    $response = array('success' => true, 'message' => 'Organization and associated attractions deleted successfully.');
                } else {
                    $response = array('success' => false, 'error' => 'Error deleting organization and attractions.');
                }
            } else {
                $response = array('success' => false, 'error' => 'Organization does not exist.');
            }
        } catch (PDOException $e) {
            $response = array('success' => false, 'error' => 'Database error: ' . $e->getMessage());
        }
    } else {
        $response = array('success' => false, 'error' => 'Missing required fields.');
    }
} else {
    $response = array('success' => false, 'error' => 'Invalid request.');
}

header('Content-Type: application/json');
echo json_encode($response);
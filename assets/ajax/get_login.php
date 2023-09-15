<?php
session_start(); // Indítsd el a session-t

$response = array();

if (isset($_SESSION['user_id'])) {
    $response = true;
} else {
    $response = false;
}
header('Content-Type: application/json');
echo json_encode($response);
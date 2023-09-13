<?php
session_start(); // Indítsd el a session-t

$response = array();

if (isset($_SESSION['user_id'])) {
    // A felhasználó be van jelentkezve, a session user_id létezik
    $response = true;
} else {
    // A felhasználó nincs bejelentkezve, a session user_id nem létezik
    $response = false;
}

header('Content-Type: application/json');
echo json_encode($response);
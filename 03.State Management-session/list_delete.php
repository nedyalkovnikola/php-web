<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

try {
    $result = $userLifecycle->deleteUser($_SESSION['delete_user']);
    if ($result) {
        header("Location: profile.php");
        exit;   
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


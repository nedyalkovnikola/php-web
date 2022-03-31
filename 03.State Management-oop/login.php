<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

try {
    if($userLifecycle->login($_POST, $_SESSION)) {
        header("Location: profile.php");
        exit;
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}







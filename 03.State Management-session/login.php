<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

if (isset($_POST['submit'])) {
    try {
        if ($userLifecycle->login($_POST, $_SESSION)) {
            header("Location: profile.php");
            exit;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

include 'views/login_frontend.php';





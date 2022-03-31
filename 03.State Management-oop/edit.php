<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

if (isset($_SESSION['user'])) {
    if (isset($_POST['edit'])) {
        $result = $userLifecycle->edit($_SESSION['user'], $_POST, $_SESSION);
        if ($result) {
            header("Location: profile.php");
            exit;
        }
    }
} else {
    header('Location: login_frontend.php');
    exit;
}

include 'edit_frontend.php';

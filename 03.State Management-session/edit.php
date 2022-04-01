<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

if (isset($_SESSION['user'])) {
    if (isset($_POST['edit'])) {
        try {
            $result = $userLifecycle->edit($_SESSION['user'], $_POST, $_SESSION);
            if ($result) {
                header("Location: profile.php");
                exit;
            }
        } catch (Exception $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }
} else {
    header('Location: login.php');
    exit;
} 

include 'views/edit_frontend.php';

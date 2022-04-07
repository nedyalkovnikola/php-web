<?php
require_once 'app.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    
    if (!$userService->isPasswordMatch($password, $confirm)) {
        throw new Exception("Password mismatch");
    }

    if ($userService->userExists($username)) {
        throw new Exception("Username already exists");
    }

    $userService->register($username, $password);
    header("Location: login.php");
    exit;
}

$app->loadTemplate('register_view');
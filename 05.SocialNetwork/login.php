<?php
use Service\User\UserService;

require_once 'app.php';


if(isset($_POST['login'])) {
    $userService = new UserService($db, $encryptionService);
    $username = $_POST['nickname'];
    $password = $_POST['password'];

    if (!$userService->login($username, $password)) {
        throw new Exception("Password mismatch");
    }

    header("Location: profile.php");
    exit;

}

$app->loadTemplate('login_view');
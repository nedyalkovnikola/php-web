<?php
use Service\User\UserService;

require_once 'app.php';


if(isset($_POST['login'])) {
    $userService = new UserService($db, $encryptionService);
    $username = $_POST['nickname'];
    $password = $_POST['password'];

    if (!$userService->login($username, $password)) {
        throw new \Exceptions\LoginException("Password mismatch");
    }

    header("Location: profile.php");
    exit;

}

$viewData = new \Data\Users\UserLoginViewData();
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    $viewData = new \Data\Users\UserLoginViewData($error);
}

$app->loadTemplate('login_view', $viewData);
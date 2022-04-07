<?php
require_once 'app.php';

if (isset($_POST['login'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $_SESSION['user_id'] = $userService->login($username, $password);
        header("Location: welcome.php");
        exit;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }

}

$app->loadTemplate('login_view');
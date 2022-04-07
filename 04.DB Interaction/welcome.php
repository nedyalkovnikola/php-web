<?php
require_once 'app.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];
$info = $userService->getInfo($id);
$app->loadTemplate('welcome_view', $info);


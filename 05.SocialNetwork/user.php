<?php
require_once 'app.php';
$app->checkLogin();

if (!isset($_GET['id'])) {
    header("Location: users.php");
}

$id = $_GET['id'];

$userService = new \Service\User\UserService($db, $encryptionService);
$user = $userService->findOne($id);

if (isset($_POST['send'])){
    $message = $_POST['message'];
    $fromId = $_SESSION['user_id'];
    $toId = $_GET['id'];

    $messageService = new \Service\Message\MessageService($db);
    $messageService->send($fromId, $toId, $message);

    header("Location: user.php?id=" . $_GET['id']);
    exit;
}

$app->loadTemplate('user_view', $user);

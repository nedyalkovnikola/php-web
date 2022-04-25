<?php
require_once 'app.php';
$app->checkLogin();

if (!isset($_GET['id'])) {
    header("Location: profile.php");
}

$messageId = $_GET['id'];
$recipientId = $_SESSION['user_id'];

$messageService = new \Service\Message\MessageService($db);
$message = $messageService->findOne($messageId, $recipientId);

$app->loadTemplate('message_view', $message);
<?php
require_once 'app.php';
$app->checkLogin();

$userService = new \Service\User\UserService($db, $encryptionService);

$currentUser = $userService->findOne($_SESSION['user_id']);

$app->loadTemplate('messages_view', $currentUser);
<?php
use Service\User\UserService;

require_once 'app.php';

$userService = new UserService($db, $encryptionService);

if (isset($_POST['register'])) {
    $uploadService = new \Service\Upload\UploadService();

    $avatarUrl = null;
    if ($_FILES['avatar']['error'] === 0) {

        $avatarUrl = $uploadService->upload(
            $_FILES['avatar'], 
            'avatars'
        );
    }

    $userService->register(
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['nickname'],
        $_POST['email'],
        $_POST['password'],
        $_POST['confirm'],
        $_POST['phone'],
        new DateTime($_POST['birthday']),
        intval($_POST['gender']),
        intval($_POST['country']),
        intval($_POST['city']),
        $_POST['description'],
        $avatarUrl
    );
    header("Location: login.php");
    exit;
}


$infoForTemplate = $userService->getRegisterViewData();

$app->loadTemplate('register_view', $infoForTemplate);
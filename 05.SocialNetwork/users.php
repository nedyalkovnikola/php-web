<?php
require_once 'app.php';
$app->checkLogin();

$userService = new \Service\User\UserService($db, $encryptionService);

if (isset($_POST['filter'])) {
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $minAge = $_POST['minAge'];
    $maxAge = $_POST['maxAge'];
    $users = $userService->findByFilter(
        $gender,
        $country,
        $city,
        $minAge,
        $maxAge);
} else {
    $users = $userService->findAll();
}

$app->loadTemplate('users_view', $users);
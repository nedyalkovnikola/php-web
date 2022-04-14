<?php
require_once 'app.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
    throw new Exception("This page is restricted to logged in users");
}

$app->loadTemplate('profile_view');
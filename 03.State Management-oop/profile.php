<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

if (isset($_SESSION['user'])) {
    echo "<h3>Hello " . $userLifecycle->getFullName($_SESSION['user']) . "</h3><br>";
    echo "Days until your birthday: " . $userLifecycle->daysUntilBirthday(($_SESSION['user']));
} else {
    header('Location: login_frontend.php');
    exit;
}

?>

<div>
    <a href="edit.php">Edit profile</a>
</div>
<div>
    <a href="logout.php">Logout</a>
</div>


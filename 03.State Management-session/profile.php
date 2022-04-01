<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

if (isset($_SESSION['user'])) {
    echo "<h3>Hello " . $userLifecycle->getFullName($_SESSION['user']) . "</h3>";
    echo "Days until your birthday: " . $userLifecycle->daysUntilBirthday(($_SESSION['user'])) . "<br>";
} else {
    header('Location: login.php');
    exit;
}

?>
<div>----------------------</div>
<?php if ($userLifecycle->getRole($_SESSION['user']) == 'admin') : ?>
    <div>
        Admin panel: <a href="list.php">Manage users</a>
    </div>
<?php endif; ?>  
<div>
    <a href="edit.php">Edit profile</a>
</div>  
<div>
    <a href="logout.php">Logout</a>
</div>


<?php /** @var $data \Data\Users\User */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="bootstrap.css">
    <title>User</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-primary">   
        <div class="container-fluid">
            <a class="navbar-brand">Social App</a>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="text-decoration:underline">Logout</a>
                    </li>
                </ul> 
        </div>
    </nav>
    <br>
    <div class="container">
        <div>
            <img src="<?=$data->getPicture(); ?>" 
            width="100px"
            height="100px">
        </div>
        <div>
            First name: <?=$data->getFirstName(); ?>
        </div>
        <div>
            Last name: <?=$data->getLastName(); ?>
        </div>
        <div>
            Nickname: <?=$data->getNickname(); ?>
        </div>
        <div>
            Description: <?=$data->getDescription(); ?>
        </div>
        <br>
        Message <?=$data->getNickname();?>:
        <form method="post">
            <textarea name="message" rows="3" cols="35"></textarea>
            <br>
            <input type="submit" name="send" value="Send">
        </form>
        <br>
        <h5><a href="users.php">Go back</a></h5>
    </div>
    
<?php /** @var $data \Data\Message\Message */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="bootstrap.css">
    <title>Message</title>
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
                        <a class="nav-link" href="#">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="text-decoration:underline">Logout</a>
                    </li>
                </ul> 
        </div>
    </nav>
    <br>
    <div class="container">
        <hr>
        <?= $data->getMessage(); ?>
        <hr>
        <h5>From: <a href="user.php?id=<?=$data->getSenderId();?>">
                    <?=$data->getNickname(); ?>
                </a></h5>
        <hr>
        <form method="post" action="user.php?id=<?=$data->getSenderId();?>">
            <textarea name="message" rows="3" cols="35"></textarea>
            <br>
            <input type="submit" name="send" value="Reply">
        </form>
        <br>
        <h5><a href="profile.php">Go back</a></h5>
    </div>
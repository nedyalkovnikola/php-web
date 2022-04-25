<?php /** @var $data \Data\Users\User */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="bootstrap.css">
    <title>Messages</title>
    <style>table, thead, th, td {border: 1px solid; padding: 2px;}</style>
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
                        <a class="nav-link" href="messages.php" style="font-weight:500; color:white">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="text-decoration:underline">Logout</a>
                    </li>
                </ul> 
        </div>
    </nav>
    <div class="container">
        All Messages:
        <table border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->getAllMessages()->getMessages() as $message) : ?>
                    <tr>
                        <td><a href="user.php?id=<?=$message->getSenderId();?>">
                                <?= $message->getNickname(); ?>
                            </a>
                        </td>
                        <td>
                            <?= $message->getMessage(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
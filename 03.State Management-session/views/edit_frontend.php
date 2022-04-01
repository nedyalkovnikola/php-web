<form method="POST">
    <div>
        <label>Username:</label>
        <input type="text" name="username" value="<?= $_SESSION['user']; ?>">
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" value="<?= $userLifecycle->getPassword($_SESSION['user']); ?>">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $userLifecycle->getEmail($_SESSION['user']); ?>">
    </div>
    <div>
        <label>Birthday:</label>
        <input type="text" name="birthday" value="<?= $userLifecycle->getBirthday($_SESSION['user']); ?>">
    </div>
    <input type="submit" name="edit" value="Edit">
</form>
<div>
    <a href="profile.php">Go Back</a>
</div>
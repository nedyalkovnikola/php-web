<?php
    session_start();
?>
<form method="POST" action="login.php">
    <div>
        <label>Username:</label>
        <input type="text" name="username">
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password">
    </div>
    <div>
        <input type="submit" name="submit" value="Login">
    </div>   
</form>
<div>
    <a href="register.php">Or you can register here</a>
</div>
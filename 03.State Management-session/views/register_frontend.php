<form method="POST">
    <div>
        <label>Username:</label>
        <input type="text" name="username" placeholder="Enter username">
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter password">
    </div>
    <div>
        <label>Confirm:</label>
        <input type="password" name="confirm" placeholder="Confirm password">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter valid email">
    </div>
    <div>
        <label>Birthday:</label>
        <input type="text" name="birthday" placeholder="Enter birthday dd/mm/yyyy">
    </div>
    <div>
        <label>Full name:</label>
        <input type="text" name="full_name" placeholder="Enter full name">
    </div>
    <div>
        <label>Role:</label>
        <select name="role">
            <option value="-1">-- Select role --</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <input type="submit" name="register" value="Register">
</form>
<div>
    <?php if(isset($success)) : ?>
        <h3 style='color:green'><?=$success; ?></h3><br>
        <a href='login.php'>Go to Login page</a>
    <?php endif;?>
</div>
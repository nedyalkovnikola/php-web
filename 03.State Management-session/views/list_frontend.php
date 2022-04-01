<style> td {border: 1px solid black; padding: 5px}</style>

<form method="POST" onsubmit="return confirm('Are you sure?')">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Full name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key=>$v) : ?>
                <tr>
                    <td><?= $key; ?></td>
                    <td><?= $v['email']; ?></td>
                    <td><?= $v['birthday']; ?></td>
                    <td><?= $v['full_name']; ?></td>
                    <td><?= $v['role']; ?></td>
                    <td><input type="submit" name="<?= $key ?>" value="Delete" ></td>
                </tr>
            <?php if (isset($_POST[$key])) :
                    $_SESSION['delete_user'] = $key;
                    header("Location: list_delete.php");
                    exit;
                endif;
            endforeach; ?>
        </tbody>
    </table>
</form>
<div>
    <a href="profile.php">Go Back</a>
</div>
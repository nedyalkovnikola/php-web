<?php /** @var $data \Data\Users\UserLoginViewData */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="bootstrap.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <?php if($data->getError()) : ?>
            <h3><?= $data->getError(); ?></h3>
        <?php endif; ?>    
        <form method="post">
            <fieldset>
                <legend>Login</legend>
                <div class="form-group">
                    <label for="nickname" class="col-lg-2 control-label">Nickname</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="nickname" id="nickname" placeholder="Your nickname" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-2">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                        <button type="reset" class="btn btn-default">Cancel</button> 
                    </div>
                </div>
            </fieldset>
        </form>
        <br>
        <a href="register.php">Or register here</a>
    </div>
</body>
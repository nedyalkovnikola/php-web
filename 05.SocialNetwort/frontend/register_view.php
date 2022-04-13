<?php /** @var $data \Data\Users\UserRegisterViewData */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <title>Registration form</title>
    <style>.form-group {padding-top: 6px} </style>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Social App</a>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Register</legend>
                <div class="form-group">
                    <label for="firstName" class="col-lg-2 control-label">First name</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="firstName" id="firstName" placeholder="First name..." type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="col-lg-2 control-label">Last name</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="lastName" id="lastName" placeholder="Last name..." type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nickname" class="col-lg-2 control-label">Nickname</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="nickname" id="nickname" placeholder="Nickname..." type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Email address</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="email" id="email" placeholder="Email..." type="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-lg-2 control-label">Phone number</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="phone" id="phone" placeholder="Phone" type="tel">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="password" id="password" placeholder="Password..." type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm" class="col-lg-2 control-label">Confirm password</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="confirm" id="confirm" placeholder="Confirm password..." type="password">
                    </div>
                </div>
                <br>
                <hr class="my-1">
                <div class="form-group">
                    <label class="col-lg-2 control-label">Gender</label>
                    <div class="col-lg-4">
                        <div class="radio">
                        <?php foreach ($data->getGenders() as $gender) : ?>    
                            <label class="form-check-label">
                                <input class="form-check-input" name="gender" id="gender" value="<?=$gender->getId();?>" type="radio"> <?= $gender->getName(); ?>
                            </label>  
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday" class="col-lg-2 control-label">Birthday</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="birthday" id="birthday" placeholder="birthday" type="date">
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-lg-2 control-label">Country</label>
                    <div class="col-lg-4">
                        <select name="country" class="form-select" id="country">
                            <option value="-1">--Select country--</option>
                            <?php foreach($data->getCountries() as $country) : ?>
                            <option value="<?=$country->getId();?>"><?=$country->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-lg-2 control-label">City</label>
                    <div class="col-lg-4">
                        <select name="city" class="form-select" id="city">
                            <option value="-1">--Select city--</option>
                            <?php foreach($data->getCities() as $city) : ?>
                            <option value="<?=$city->getId();?>"><?=$city->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="avatar" class="col-lg-2 control-label">Avatar</label>
                    <div class="col-lg-4">
                        <input class="form-control" name="avatar" id="avatar" placeholder="Avatar" type="file">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="3" name="description" id="description" placeholder="A short description of yourself..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <br>
    </div>
    <hr class="my-2">
</body>
</html>
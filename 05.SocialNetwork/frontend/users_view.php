<?php /** @var $data \Data\Users\AllUsersViewData */ ?>
<?php $found = false; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="bootstrap.css">
    <title>All Users</title>
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
                        <a class="nav-link" href="users.php" style="font-weight:500; color:white">Users</a>
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
    <div class="container">
        <br/>
        <form method="post">
            Filter by:
            <hr>
            Gender: <select name="gender">
            <option value="-1"> -- Select gender -- </option>
            <?php foreach($data->getAdditionalData()->getGenders() as $gender) : ?>
                <option value="<?= $gender->getId(); ?>">
                    <?= $gender->getName();?>
                </option>
            <?php endforeach; ?>
            </select>
            <br/>
            Country: <select name="country">
            <option value="-1"> -- Select country -- </option>
            <?php foreach($data->getAdditionalData()->getCountries() as $country) : ?>
                <option value="<?= $country->getId(); ?>">
                    <?= $country->getName();?>
                </option>
            <?php endforeach; ?>
            </select>
            <br/>
            City: <select name="city">
            <option value="-1"> -- Select city -- </option>
            <?php foreach($data->getAdditionalData()->getCities() as $city) : ?>
                <option value="<?= $city->getId(); ?>">
                    <?= $city->getName();?>
                </option>
            <?php endforeach; ?>
            </select>
            <hr>
            Age:
            <br>
            From:
            <select name="minAge">
                <?php for ($i = $data->getMinYears(); $i <= $data->getMaxYears(); $i++): ?>
                    <option value="<?=$i; ?>"><?= $i; ?> Years</option>
                <?php endfor; ?>
            </select>
            To:
            <select name="maxAge">
                <?php for ($i = $data->getMinYears(); $i <= $data->getMaxYears(); $i++): ?>
                    <option value="<?=$i; ?>"><?= $i; ?> Years</option>
                <?php endfor; ?>
            </select>
            <br>
            <button class="btn btn-secondary" type="submit" name="filter">Filter</button>
        </form>
        <br>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Nickname</th>
                    <th>Birthday</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Country</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data->getUsers() as $user): ?>
            <?php $found = true; ?>
                <tr>
                    <td>
                        <a href="user.php?id=<?=$user->getId();?>">
                            <img src="<?=$user->getPicture();?>"
                                width="60px"
                                height="60px"
                            />
                        </a>
                    </td>
                    <td><?=$user->getFirstName();?></td>
                    <td><?=$user->getLastName();?></td>
                    <td><?=$user->getNickname();?></td>
                    <td><?=$user->getBornOn();?></td>
                    <td><?=$user->getPhone();?></td>
                    <td><?=$user->getEmail();?></td>
                    <td><?=$user->getGender();?></td>
                    <td><?=$user->getCountry();?></td>
                    <td><?=$user->getCity();?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if(!$found): ?>
        <h3>No people match your preferences.</h3>
        <?php endif; ?>
    </div>
</body>
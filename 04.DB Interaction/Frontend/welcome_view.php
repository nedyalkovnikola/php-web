<?php /** @var $data \Models\User */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome page</title>
</head>
<body>
    <h1>WELCOME <?=$data->getId() . ' - ' . $data->getName();?></h1>
</body>
</html>
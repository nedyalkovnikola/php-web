<?php
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

if (isset($_POST['register'])) {
    try {
        $result = $userLifecycle->register($_POST);
        if ($result) {
            $success = "Successful registraion!";
        }
    } catch (Exception $e) {
        echo "Something went wrong: " . $e->getMessage();
    }
}

include 'views/register_frontend.php';
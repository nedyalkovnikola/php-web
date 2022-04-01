<?php
session_start();
require_once 'UserLifecycle.php';

$userLifecycle = new UserLifecycle();

$users = $userLifecycle->getUsers();

include 'views/list_frontend.php';
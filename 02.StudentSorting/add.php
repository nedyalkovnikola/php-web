<?php
session_start();

array_map("trim", $_POST);

if (isset($_POST['add'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $score = intval($_POST['score']);

    $_SESSION['student'][] = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'score' => $score
    ];

    header("Location: list.php");
    exit;
}

include 'add_view.php';
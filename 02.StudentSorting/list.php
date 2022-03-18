<?php
session_start();

if (!isset($_SESSION['student'])) {
    $_SESSION['student'] = [];
}

$sortBy = "";

if (isset($_POST['sort'])) {
    try {
        $sortBy = $_POST['sortBy'];
        $order = $_POST['order'];

        $_SESSION['student'] = sortStudents($_SESSION['student'], $sortBy);

        if ($order == "desc") {
            $_SESSION['student'] = array_reverse($_SESSION['student']);
        }

    } catch (Exception $ex) {
        echo "Caught exception ", $ex->getMessage();
    }
}


function sortStudents(array $students, string $sortBy): array {
    switch($sortBy) {
        case "fname":
            usort($students, function($a, $b) {
                return $a['firstName'] <=> $b['firstName'];
            });
            break;
        case "lname":
            usort($students, function($a, $b) {
                return $a['lastName'] <=> $b['lastName'];
            });
            break;
        case "email":
            usort($students, function($a, $b) {
                return $a['email'] <=> $b['email'];
            });
            break;
        case "exam":
            usort($students, function($a, $b) {
                return $a['score'] <=> $b['score'];
            });
            break;
        default:
            throw new Exception("Please select valid filter");
    }

    return $students;
}

include 'list_view.php';

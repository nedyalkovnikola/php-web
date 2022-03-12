<?php
declare(strict_types=1);

define("CURRENCIES", ["usd" => "$", "eur" => "€", "bng" => "lv."]);
define("PERIODS", [6, 12, 24, 60]);

if (isset($_GET['submit'])) {
    
    array_map('trim', $_GET);

    $amount = filter_var($_GET["amount"], FILTER_VALIDATE_INT);
    if ($amount === false || $amount <= 0) {
        throw new Exception("Invalid amount to calculate");
    }

    $currency = strtolower($_GET["currency"]);
    if(!array_key_exists($currency, CURRENCIES)) {
        throw new Exception("Currency not supported");
    }

    $interest = filter_var($_GET["interest"], FILTER_VALIDATE_INT);
    if ($interest === false || $interest <= 0) {
        throw new Exception("Invalid interest");
    }

    $period = $_GET["period"];
    if (!in_array($period, PERIODS)) {
        throw new Exception("Invalid period");
    }

    $amount = intval($amount);
    $currency = CURRENCIES[$currency];
    $interest = intval($interest);
    $period = intval($period);
}




require_once 'view.php';
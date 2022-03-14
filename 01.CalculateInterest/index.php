<?php
declare(strict_types=1);
session_start();

$validCurrencies = ["USD" => "$", "EUR" => "€", "BGN" => "lv."];
$validPeriods = [6 => "6 months", 12 => "1 Year", 24 => "2 Years", 60 => "5 Years"];

$amount = "";
$interest = "";
$currency = "";

if (isset($_GET["submit"])) {
    
    array_map("trim", $_GET);

    $amount = filter_var($_GET["amount"], FILTER_VALIDATE_INT);
    if ($amount === false || $amount <= 0) {
        throw new Exception("Invalid amount to calculate");
    }

    $currency = $_GET["currency"];
    if(!array_key_exists($currency, $validCurrencies)) {
        throw new Exception("Currency not supported");
    }

    $interest = filter_var($_GET["interest"], FILTER_VALIDATE_INT);
    if ($interest === false || $interest <= 0) {
        throw new Exception("Invalid interest");
    }

    $period = filter_var($_GET["period"], FILTER_VALIDATE_INT);
    if ($period === false || !array_key_exists($period, $validPeriods)) {
        throw new Exception("Invalid period");
    }

    $amount = intval($amount);
    $currencySign = $validCurrencies[$currency];
    $interest = intval($interest);
    $period = intval($period);

    $compoundInterest = calculateInterest($amount, $interest, $period);
    $compoundInterest = number_format($compoundInterest, 2, ".", " "); 

}

function calculateInterest(int $amount, int $interest, int $period): float
    {
        $monthlyInterest = $interest / 12;
        for ($month = 0; $month < $period; $month++) {
            $amount = ($amount * (100 + $monthlyInterest)) / 100;
        }

        return $amount;
    }

require_once 'view.php';
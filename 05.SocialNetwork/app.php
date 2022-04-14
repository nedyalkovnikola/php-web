<?php
use Service\Encryption\BCryptEncryptionService;

session_start();

set_exception_handler(function(Exception $e) {
    if ($e instanceof \Exceptions\RegisterException) {
        header("Location: register.php?error=1");
        exit;
    }

    if ($e instanceof \Exceptions\LoginException) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: login.php");
        exit;
    }
});

spl_autoload_register(function($class) {
    require_once $class . '.php';
});

$db = new \Adapter\PDODatabase(
                    \Config\DbConfig::DB_HOST,
                    \Config\DbConfig::DB_NAME,
                    \Config\DbConfig::DB_USER,
                    \Config\DbConfig::DB_PASS
);

$app = new \Core\Application();
$encryptionService = new BCryptEncryptionService();
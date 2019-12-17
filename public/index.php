<?php
session_start();

// all config stuff
require '../src/config/config.php';

// all helper function
require SRC . 'helper.php';

//database connexion
try {
    $pdo = new PDO("mysql:host=".DATABASE_HOST.";dbname=".DATABASE_NAME.";charset=utf8", DATABASE_USER, DATABASE_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Impossible de se connecter à la base de donnée");
}

// parsing URL
require SRC . 'router.php';

run();

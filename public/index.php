<?php

session_start();

// all config stuff
require '../src/config/config.php';

try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // all helper function
    require SRC . 'helper.php';

    // parsing URL
    require SRC . 'router.php';

    run();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//database connexion

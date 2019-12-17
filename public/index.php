<?php

// all config stuff
require '../src/config/config.php';

// all helper function
require SRC . 'helper.php';

//database connexion
try
{
    //bdd conection
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();

    //Use rooter
    require SRC . 'router.php';
    run();

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

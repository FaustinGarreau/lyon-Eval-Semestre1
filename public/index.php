<?php
session_start();
// all config stuff
require '../src/config/config.php';

// all helper function
require SRC . 'helper.php';

//database connexion
$bdd = new PDO('mysql:host=localhost;dbname=eval_s1;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

define('CONTROLLER', __DIR__ . '/../src/Controller/');
define('MODEL', __DIR__ . '/../src/Model/');
define('VIEW', __DIR__ . '/../src/Views/books/');


// parsing URL
require SRC . 'router.php';

run();
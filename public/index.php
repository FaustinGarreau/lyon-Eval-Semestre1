<?php

session_start();
define('SRC',__DIR__.'/../src/');
define('CONTROLLER',__DIR__.'/../src/Controller/');
define('MODEL',__DIR__.'/../src/Models/');
define('VIEW',__DIR__.'/../src/Views/');

define('USER','root');
define('DATABASE','eval_s1');
define('PASSWORD','root');

// all config stuff
require '../src/config/config.php';

// all helper function
require SRC . 'helper.php';

//database connexion
$bdd = new PDO('mysql:host=127.0.0.1;dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// parsing URL
require SRC . 'router.php';

run();
<?php
echo 2;
// all config stuff
require '../src/config/config.php';

// all helper function
require SRC . 'helper.php';

//database connexion
$bdd = new PDO('mysql:host=127.0.0.1;dbname=' . DATABASE . ';charset=utf8;port=8888;' , USER, PASSWORD);

// parsing URL
require SRC . 'router.php';

run();
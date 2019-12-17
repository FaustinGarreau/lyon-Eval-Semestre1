<?php
// paths
define('SRC', "../src/");
define('CONTROLLERS', SRC.'Controllers/');
define('MODELS', SRC.'Models/');
define('VIEWS', SRC.'Views/');

// Database
define('DATABASE_HOST', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', 'root');
define('DATABASE_NAME', 'eval_s1');

// Informations
define('REQUEST_PATH', explode("?", ($_SERVER["REQUEST_URI"]."?"))[0]); // REQUEST_URI without GET parameters

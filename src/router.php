<?php

/*
*  Url : the url to match, like "/abcdef".
*  Path : the user path
*  Matches : return matches defined by ? in url
*/
function match($url, $path, &$matchs=[]) {
    $bool = preg_match('#^'.str_replace('?', '([\w-]+)', str_replace('/', '\/', $url)).'/?$#', $path, $parts);
    $matchs = $parts;
    return $bool;
}

function run() {
    $url = REQUEST_PATH;
    $method = $_SERVER['REQUEST_METHOD'];
    // Is get request
    if ($method == "GET") {
        if (match("/nouveau", $url)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookCreate();
        }
    }
    // Is post request
    else {
        if (match("/nouveau", $url)) {
            // Store
            require CONTROLLERS."BookController.php";
            bookStore();
        }
    }
}

<?php

/**
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
        } elseif (match("/livres", $url)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookIndex();
        } elseif (match("/livres/?", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookShow($matchs[1]);
        } elseif (match("/livres/?/edit", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookEdit($matchs[1]);
        } elseif (match("/livres/?/edit", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookEdit($matchs[1]);
        } elseif (match("/login", $url)) {
            // Create page
            require CONTROLLERS."AuthController.php";
            login();
        } elseif (match("/register", $url)) {
            // Create page
            require CONTROLLERS."AuthController.php";
            register();
        } elseif (match("/logout", $url)) {
            // Create page
            require CONTROLLERS."AuthController.php";
            logout();
        } else {
            header("Location: /livres/");
        }
    }
    // Is post request
    else {
        if (match("/nouveau", $url)) {
            // Store
            require CONTROLLERS."BookController.php";
            bookStore();
        } elseif (match("/livres/?/edit", $url, $matchs)) {
            // Update page
            require CONTROLLERS."BookController.php";
            bookUpdate($matchs[1]);
        } elseif (match("/livres/?/delete", $url, $matchs)) {
            // Delete page
            require CONTROLLERS."BookController.php";
            bookDelete($matchs[1]);
        } elseif (match("/login", $url)) {
            // Create page
            require CONTROLLERS."AuthController.php";
            loginUser();
        } elseif (match("/register", $url)) {
            // Create page
            require CONTROLLERS."AuthController.php";
            registerUser();
        }
    }
}

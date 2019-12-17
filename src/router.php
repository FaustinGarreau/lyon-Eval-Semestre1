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
        } elseif (match("/categories", $url)) {
            // Create page
            require CONTROLLERS."CategoriesController.php";
            categoriesIndex();
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
            // Update
            require CONTROLLERS."BookController.php";
            bookUpdate($matchs[1]);
        } elseif (match("/livres/?/delete", $url, $matchs)) {
            // Delete
            require CONTROLLERS."BookController.php";
            bookDelete($matchs[1]);
        } elseif (match("/login", $url)) {
            // Login
            require CONTROLLERS."AuthController.php";
            loginUser();
        } elseif (match("/register", $url)) {
            // Register
            require CONTROLLERS."AuthController.php";
            registerUser();
        } elseif (match("/categories/nouvelle", $url)) {
            // New category
            require CONTROLLERS."CategoriesController.php";
            categoryStore();
        }
    }
}

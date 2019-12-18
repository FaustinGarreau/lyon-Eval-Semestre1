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
        } elseif (match("/livres/categories/?", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookIndexCategory($matchs[1]);
        } elseif (match("/livres/tags/?", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookIndexTag($matchs[1]);
        } elseif (match("/livres/livre/?", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookShow($matchs[1]);
        } elseif (match("/livres/livre/?/edit", $url, $matchs)) {
            // Create page
            require CONTROLLERS."BookController.php";
            bookEdit($matchs[1]);
        } elseif (match("/livres/livre/?/edit", $url, $matchs)) {
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
        } elseif (match("/tags", $url)) {
            // Create page
            require CONTROLLERS."TagsController.php";
            tagsIndex();
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
        } elseif (match("/livres/livre/?/edit", $url, $matchs)) {
            // Update
            require CONTROLLERS."BookController.php";
            bookUpdate($matchs[1]);
        } elseif (match("/livres/livre/?/delete", $url, $matchs)) {
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
        } elseif (match("/categories/edit/?", $url, $matchs)) {
            // Edit category
            require CONTROLLERS."CategoriesController.php";
            categoryEdit($matchs[1]);
        } elseif (match("/categories/delete/?", $url, $matchs)) {
            // Delete category
            require CONTROLLERS."CategoriesController.php";
            categoryDelete($matchs[1]);
        } elseif (match("/tags/nouvelle", $url)) {
            // New tag
            require CONTROLLERS."TagsController.php";
            tagStore();
        } elseif (match("/tags/edit/?", $url, $matchs)) {
            // Edit tag
            require CONTROLLERS."TagsController.php";
            tagEdit($matchs[1]);
        } elseif (match("/tags/delete/?", $url, $matchs)) {
            // Delete tag
            require CONTROLLERS."TagsController.php";
            tagDelete($matchs[1]);
        } else {
            header("Location: /livres/");
        }
    }
}

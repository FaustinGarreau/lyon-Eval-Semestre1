<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($_SERVER["REQUEST_URI"] == '/') {
        require CONTROLLER . 'IndexController.php';
        book();
    }
    elseif ($_SERVER["REQUEST_URI"] == '/livres/nouveau' && $_SERVER['REQUEST_METHOD'] == 'GET') {
        require CONTROLLER . 'BookController.php';
        bookCreate();
    }
    elseif ($_SERVER["REQUEST_URI"] == '/livres/nouveau' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        require CONTROLLER . 'BookController.php';
        bookStore(); 
    }




} 

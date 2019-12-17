<?php

function errors($data) {
    if (isset($_SESSION["errors"][$data])) {
        echo $_SESSION["errors"][$data];
    }
}

function old($data) {
    if (isset($_SESSION["old"][$data])) {
        echo $_SESSION["old"][$data];
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
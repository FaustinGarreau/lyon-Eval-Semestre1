<?php

function error($field) {
    if (isset($_SESSION["errors"][$field])) {
        return $_SESSION["errors"][$field];
    }
}

function old($field) {
}

function escape($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
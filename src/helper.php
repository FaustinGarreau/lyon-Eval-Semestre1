<?php

function error($field) {
    if (isset($_SESSION["errors"][$field])) {
        return $_SESSION["errors"][$field];
    }
}

function old($field) {
    if (isset($_SESSION['old'][$field])) {
        $old = $_SESSION['old'][$field];
        return escape($old);
    }
}
function escape($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
    
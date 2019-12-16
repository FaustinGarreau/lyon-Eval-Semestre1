<?php

function error($field) {
    return escape($_SESSION['errors'][$field] ?? "");
}

function old($field) {
    return escape($_SESSION['old'][$field] ?? "");
}

function escape($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
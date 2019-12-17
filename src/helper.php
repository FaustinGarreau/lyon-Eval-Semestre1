<?php

function error($where, $field) {
    if (isset($_SESSION["error"][$where][$field])) {
        ?>
            <span class="text-red-500 font-bold"><?php echo $_SESSION["error"][$where][$field]; ?></span>
        <?php
    }
}

function old($where, $field) {
    if (isset($_SESSION["value"][$where][$field])) {
        echo $_SESSION["value"][$where][$field];
    }
}

function escape($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES);
}
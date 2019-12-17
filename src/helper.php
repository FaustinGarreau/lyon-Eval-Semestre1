<?php

function getError($field) {
    if(isset($_SESSION['errors'][$field])) {
        $error = $_SESSION['errors'][$field];
        return $error;
    }
  }

  
  function getold($field) {
    if(isset($_SESSION['old'][$field])) {
        $error = $_SESSION['old'][$field];
        return $error;
    }
  }

function escape($data) {
}
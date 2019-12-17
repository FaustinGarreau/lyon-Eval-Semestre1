<?php

function error($field) {
  if (isset($_SESSION['errors'][$field])) {
    return $_SESSION['errors'][$field];
  }
  return '';
}

function old($field) {
  if (isset($_SESSION['old'][$field])) {
    return $_SESSION['old'][$field];
  }
  return '';
}

function escape($data) {
  return stripslashes(trim(htmlspecialchars($str)));
}

function slugify($text) {
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // trim
  $text = trim($text, '-');
  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

<?php

// Return old value
function getOld($value) {
    return escape($_SESSION["old"][$value] ?? "");
}

// Return error message
function getError($value) {
    return escape($_SESSION["errors"][$value] ?? "");
}

function escape($string) {
    return htmlspecialchars(stripslashes(trim($string)));
}

// FROM STACKOVERFLOW
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

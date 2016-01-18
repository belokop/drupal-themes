<?php
/* 
 * Nordita template
 */
$releaseDate = '2012-01-16';
define('THEME_VERSION','2.1');

// Nordita theme works better with myPear module
if (class_exists('myPear',False)){
  define('myPear_enabled_theme',True);
  myPear::myPear_enabled_theme();
}

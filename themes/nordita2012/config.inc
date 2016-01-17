<?php
/* 
 * Nordita template
 */
$releaseDate = '2015-04-16';
define('THEME_VERSION','2012-01.7');

// Nordita theme works better with myPear module
if (class_exists('myPear',False)){
  define('myPear_enabled_theme',True);
  myPear::myPear_enabled_theme();
}

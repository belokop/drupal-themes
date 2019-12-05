<?php
/* 
 * Nordita template, second generation as from 2012
 */
$releaseDate = '2019-02-11';
define('THEME_VERSION','0.1-dev');

// Nordita theme works better with myPear module
if (class_exists('myPear',False)){
  if (!defined('myPear_enabled_theme'))  define('myPear_enabled_theme',True);
  myPear::myPear_enabled_theme();
}

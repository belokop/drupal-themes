<?php
/*
 * regions are 
 *  left
 *  right
 *  footer
 */
function nordita_blocks($region) {
  if (preg_match('/(nor2007|nor2011|admin|edit)/', $_GET['q']) || 
      preg_match(";/(admin|edit)(/|\b);",$_SERVER["REQUEST_URI"])) // && $region == 'right' 
    return theme_blocks($region);
  else
    return False;
}

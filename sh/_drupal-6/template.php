<?php

require_once(dirname(__FILE__).'/template-6.php');
drupal6_preprocess_block($vars, $hook);

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function sh_preprocess_page(&$vars, $hook) {

  $color_theme = 'th-red';
  $color_theme = 'th-frost';

  // To remove a class from $body_classes, use array_diff().
  if (empty($vars['body_classes']))     $vars['body_classes'] = array();
  if (!is_array($vars['body_classes'])) $vars['body_classes'] = explode(' ',$vars['body_classes']);
  $vars['body_classes'] = array_diff($vars['body_classes'], array('not-logged-in'));
  $vars['body_classes'][] = 'logged-in';
  if     (defined('cnf_inside_fb')    && cnf_inside_fb)   {$vars['body_classes'][] =    'wide'; $vars['body_classes'][] = 'height_auto'; }
  else                                                     $vars['body_classes'][] = 'medwide';
  if (!empty($color_theme))                                $vars['body_classes'][] = $color_theme;
}

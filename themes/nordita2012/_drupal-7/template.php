<?php
/**
 * @file
 * Contains theme pre-process functions
 */
 
 /**
  * Override or insert variables into the html template.
  */
function nordita_preprocess_html(&$vars) {

  // Add Hans' color model
  $color_theme = 'th-frost';
  $vars['classes_array'][] = $color_theme;

  // Remove drupal login information, use myPear
  $vars['classes_array'] = array_diff($vars['classes_array'], array('not-logged-in'));
  $vars['classes_array'][] = 'logged-in';

  if    (defined('cnf_inside_fb')    && cnf_inside_fb){  $vars['classes_array'][] =    'wide'; $vars['classes_array'][] = 'height_auto'; }
  else                                                   $vars['classes_array'][] = 'medwide';

  // Remove 'theme_hook_suggestions'
  $vars['theme_hook_suggestions'] = array();

  // Add conditional CSS for IE6.
  drupal_add_css(path_to_theme() . '/ie6.css',
		 array('group' => CSS_THEME,
		       'browsers' => array('IE' => 'lt IE 7', '!IE' => FALSE),
		       'preprocess' => FALSE));
}

/**
 */
function nordita_preprocess_page(&$vars){
  global $nordita_nav_level2;
 
  // Build the list of second level links, it will be shown in the "Hans' tab"
  $nordita_nav_level2 = array();
  if (isset($vars['page']['sidebar_first']['system_navigation'])){
    foreach ($vars['page']['sidebar_first']['system_navigation'] as $k=>$nav){
      if (is_numeric($k) && isset($nav['#below'])){
	foreach($nav['#below'] as $k2=>$nav2){
	  if (is_numeric($k2) && is_array($nav2)){
	    $nordita_nav_level2[] = array('#href' => $nav2['#href'],
					  '#title'=> $nav2['#title']);
	  }
	}
      }
    }
  }
}

/*
 * Add page load spinner for the slow pages
 */
function nordita_menu_tree($vars) {
  $tree  = str_replace("><ul",">\n<ul",str_replace("><li",">\n<li",$vars['tree']));
  return "<ul class='menu page_load_progress'>$tree</ul>";
}

/**
 * Change button to Post instead of Save
 */
function nordita_form_comment_form_alter(&$form, &$form_state, &$form_id) {
 $form['actions']['submit']['#value'] = t('Post');
 $form['comment_body']['#after_build'][] = 'configure_comment_form'; 
}

function configure_comment_form(&$form) {
  $form['und'][0]['format']['#access'] = FALSE;
  return $form;
}

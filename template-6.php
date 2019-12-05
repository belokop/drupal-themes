<?php
/**
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 */

function drupal6_preprocess_block(&$vars, $hook) {
  $GLOBALS['my_navigation'] = $GLOBALS['navigation'] = $vars['block']->content;

  if (class_exists('b_reg',False)) $registry = b_reg::get();
  else                             $registry = array();

  foreach(menu_tree_page_data('navigation') as $k0=>$level0){
    if (!empty($registry['d']) && strpos($k0,$registry['d'])){
      if (is_array($level0['below'])){
	foreach($level0['below'] as $link_text=>$link_array){
	  if (is_array($link_array['link']) && !empty($link_array['link']['title'])){
	    $args = unserialize($link_array['link']['page_arguments']);
	    $c = (strpos(@$_GET['q'],($tab=APImenu::tab_code($args[0]))) === False ? 'collapsed' : 'expanded');
	    $GLOBALS['aAnkers'][$args[0]] = x("li class='$c'", x("a href='".b_url::same("?q=$registry[m]/$tab")."'",$link_array['link']['title']));
	  }
	}
      }
    }
  }

  if (class_exists('b_reg',False)){
    $registry = b_reg::get();
    foreach(menu_tree_page_data('navigation') as $k0=>$level0){
      if (!empty($registry['d']) && strpos($k0,@$registry['d']) !== False){
	foreach($level0 as $k1=>$level1){
	  if (empty($level1)) $level1 = array();
	  foreach($level1 as $k2=>$level2){
	    if (!empty($level2['link']) && is_array($level2['link'])){
	      $args = unserialize($level2['link']['page_arguments']);
	      $c = (strpos(@$_GET['q'],($tab=APImenu::tab_code($args[0]))) === False ? 'collapsed' : 'expanded');
	      $GLOBALS['bAnkers'][$args[0]] = x("li class='$c'",x("a href='".b_url::same("?q=$registry[m]/$tab")."'",$level2['link']['title']));
	    }
	  }
	}
      }
    }
  }
  //  b_debug::print_r($GLOBALS['aAnkers'],'aAnkers');
  //  b_debug::print_r($GLOBALS['bAnkers'],'bAnkers');
}

<?php
/*
 * detect the front page
 */
$top_menu_modules = array();
if (class_exists('myPear',False)){
  $tabh = $tab = array();
  b_reg::load_module();
  foreach(b_reg::$modules as $module=>$descr){
    if (in_array($module,array(myPear_MODULE))) continue;
    if (!empty($descr['d']) && module_exists($module)){
      $top_menu_modules[$module] = $descr['d'];
    }
  }
}
ksort($top_menu_modules);
$GLOBALS['top_menu_modules'] = $top_menu_modules;

//
// Login/logout button
//
function YB_tpl_login($return_a=False){
  global $theme;
  $reply = '';
  if (class_exists('bAuth',0)){
    $flavor = "q=".b_reg::$current_module;
    if (is_object(bAuth::$av)){
      $title = ' ' . bAuth::$av->fmtName('f').' ';
      $reply = x('span class="auth-loggedin"',
                 "$title<a href='".b_url::same("?quit_once=yes&$flavor&resetcache_once=1")."'>[logout]</a>");
    }else{
      $reply = x("a href='".b_url::same("?resetcache_once=1&login=yes")."'","<img alt='login' src=".drupal_get_path('theme',$theme).'/images/login.png>');
    }
  }
  return ($return_a
	  ? $reply
	  : x("span style='float:right;font-size:x-small;color:white;'",$reply));
}

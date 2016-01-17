<?php
/*
 * Resolve drupal-6 / drupal-7 compatibility problem
 */
print "<!-- ".__FILE__." -->\n";

if (!function_exists('render')){
  function render($block,$id=''){
    if (!empty($block)) return ("\n<!-- -start--------------------------------- render($id) --------------------- -->\n".
				$block.
				"\n<!-- -end--------------------------------- render($id) --------------------- -->\n");
  }
}

// if (($content !== Null) && ($page['content'] === Null)) $page['content'] = $content;
foreach(array('content','highlighted','help') as $item){
  if ((@${$item} !== Null) && (@$page[$item] === Null)) $page[$item] = ${$item};
}

if (empty($_GET['q']))  $is_front = True;
$GLOBALS['is_front'] = @$is_front;
$GLOBALS['page']     = @$page;

if (!defined('cnf_inside_fb'))  define('cnf_inside_fb',False);

/*
 * myPear module version
 */
$THEME_current_module = $module_v = $module_d = '';
if (class_exists('b_reg',False) && !empty(b_reg::$modules[b_reg::$current_module])){
  $reg = b_reg::$modules[b_reg::$current_module];
  $module_v = sprintf('%s&nbsp;%s',$reg['m'],$reg['v']);
  $module_d = $reg['r'];
  $THEME_current_module = (b_reg::$current_module == myPear_MODULE
			   ? ''
			   : b_reg::$current_module);
}
$GLOBALS['module_d'] = $module_d;
$GLOBALS['module_v'] = $module_v;
define('THEME_current_module',$THEME_current_module);

/*
 * show the performance test results                                                                                                                   
 */
$GLOBALS['timing'] = $timing = '<!--      No timing information -->';
if (class_exists('myPear',False)){
  ob_start();
  bTiming()->show();  
  $timing1 = ob_get_contents();
  ob_end_clean();
  
  ob_start();
  bCount()->show();  
  $timing2 = ob_get_contents();
  ob_end_clean();
  
  if (!empty($timing1) || !empty($timing2)){
    $timing = array();
    if (!empty($timing1)) $timing[] = $timing1;
    if (!empty($timing2)) $timing[] = $timing2;
    ob_start();
    $t = new b_table();
    $t->tr($timing);  
    $t->close();
    $GLOBALS['timing'] = $timing = ob_get_contents();
    ob_end_clean();
  }
}

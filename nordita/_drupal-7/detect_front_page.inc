<?php
/*
 * detect the front page
 */
if (empty($_GET['q']) || (@$_GET['q'] === 'fp') || (@$_GET['q'] === 'node') || @$is_front){
  if (class_exists('myPear',False)){
    $tabh = $tab = array();
    b_reg::load_module();
    foreach(b_reg::$modules as $module=>$descr){
      if ($module == myPear_MODULE && !superUser_here) continue;
      if ($module == 'an')              continue;
      if (!empty($descr['d']) && module_exists($module)){
	if (empty($descr['tm']))  $descr['tm'] = $descr['d'];
	$tab[]  = "<li ><a href='?q=$module'>$descr[tm]</a></li>";
	$tabh[] = "<li ><a href='?q=$module'>$descr[d] </a></li>";
      }
    }
    //$tabsFP = $nodes = join(' ',$tab);
    $tabsFP = (1
	       ? join(' ',$tabh)
	       : join(' ',$tab)
	       );
    $tabsZZZ = "<ul class='tabs primary page_load_progress'>$tabsFP</ul>";
    $content = theme_tpl_front_page(join("\n",$tabh),$theme);
    // Login in no-module context 
    if ($c = @$GLOBALS['authenticationPrompt']) $content = $c;
  }else{
    $content = '<h2> No front page yet</h2>';
  }
}

function theme_tpl_front_page($tabh){
  global $title, $title_prefix,$theme;
  /*
  // See function n_printPageTitle()
  $title_prefix = array();
  $title = b_t::_(array('key' =>'theme;h1',
			'item'=>($theme == 'nordita'
				 ? 'Welcome to the Nordita <br/>Computer Aided Administration'
				 : "Welcome to Sweet Home")));
  */
  return
    x('h4',b_t::_(array('key' =>'theme;select',
			'item'=>'Select the required Application'))).
    x('ul',$tabh);
}

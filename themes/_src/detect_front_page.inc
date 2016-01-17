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
    
    $tabsFP = $nodes = join(' ',$tab);
    $tabsZZZ = "<ul class='tabs primary page_load_progress'>$tabsFP</ul>";
    //    $title = 'Welcome to the '.(class_exists('myPear',0) ? myOrg()->name() : '').' <br/>Computer Aided Administration';
    $content = nordita_tpl_front_page(join("\n",$tabh));
    // Login in no-module context 
    if ($c = @$GLOBALS['authenticationPrompt']) $content = $c;
  }else{
    $content = '<h2> No front page yet</h2>';
  }
}

function nordita_tpl_front_page($tabh){
  global $title, $title_prefix;
  $title_prefix = array();
  $title = 'Welcome to the Nordita <br/>Computer Aided Administration';
  return
    x('h4',bText::_('Select the required Application:')).
    x('ul',$tabh);
}

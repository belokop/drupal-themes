<?php

require_once(dirname(__FILE__).'/config.inc');

function extract_module_relevant_menu(&$menu){

  $menu = preg_replace(";<form.*</form>;",'',str_replace("\n",' ',$menu));
  
  foreach(array('li','ul','div',) as $i){
    $replace[";><$i;"] = ">\n<$i";
    $replace[";> *<$i;"] = ">\n<$i";
    if ($i !== 'li'){
      $replace[";></$i;"]   = ">\n</$i";
      $replace[";> *</$i;"] = ">\n</$i";
    }
  }
  foreach($replace as $f=>$t) $menu = preg_replace($f,$t,trim($menu));
  
  // Skip all the menu items which are not from the current module,
  // but (most probably) from the drupal admin pages
  $m = array('');
  foreach(explode("\n",$menu) as $line){
    if ((strpos($line,'q='.THEME_current_module) !== False) ||
	(strpos($line, '<ul')  !== False) ||
	(strpos($line,'</ul')  !== False))
      $m[] = trim($line);
  }
  // The "almost final" menu
  $m[] = x("div style='clear:both'",' ');
  $m[] = '';
  $menu = join("\n",$m);
}

function n_printPageTitle($is_front,$title='',$title_prefix='',$title_suffix=''){
  global $theme;
  if ($is_front){
    return x('h1',b_t::_(array('key' =>'theme;h1',
			  'item'=>($theme == 'nordita'
				   ? 'Welcome to the Nordita <br/>Computer Aided Administration'
				   : "Welcome to Sweet Home"))));
  }else{
    // shorten the title if it is too long
    if (isset($GLOBALS['myPear_custom_title'])) $title = $GLOBALS['myPear_custom_title'];
    if (empty($title))                          $title = @$GLOBALS['title'];
    if($title){
      $maxTitleLength = 66;
      if (strlen(strip_tags($title)) > $maxTitleLength) $title = "<h2 class='node-title'>$title</h2>";
      else                                              $title = "<h1 class='node-title'>$title</h1>";
    }
    return (render($title_prefix,'title_prefix').
	    $title.
	    render($title_suffix,'title_suffix'));
  }
}

function n_printLeftMenu(&$page,$left,$primary_links,$secondary_links){
  if ($menu = $left){
    extract_module_relevant_menu($menu);
    $reply = $menu;
  }elseif($menu = @$page['sidebar_first']){
    $reply = render($menu,'page[sidebar_first]');
  }else{
    return '';
  }
  return $reply;
}

function sh_tpl_menu(){
  $p = b_cms::_();
  $nMenu = menu_tree_page_data('navigation');
  foreach(array_keys($nMenu) as $l2){
    print  $nMenu[$l2]['link']['link_path'].'<br/>';
    if (!empty($p[1]) && strstr($l2,$p[1])){
      // Little massage...                                                                                                                                                                  
      $menu = array();
      foreach(explode("\n",menu_tree_output($nMenu[$l2]['below'])) as $item){
	$item = str_replace('<ul class="menu">','',$item);
	$item = str_replace('</ul>','',$item);
	if (strstr($item,'mediumsans')){
	  $menu[] = '<b><i class="mediumsans">'.strip_tags(b_fmt::unEscape($item)).'</i></b>';
	}else{
	  $menu[] = $item;
	}
      }
      $menu = join("\n",$menu);
      break;
    }
  }
}

/*
 * Locate css and img files
 */
function sh_tpl_css($f,$type='css',$print=True){
  static $theme = 'sh';
  $path = drupal_get_path('theme',$theme);
  //  print "$path <br>";
  $reply = '';
    switch ($type) {
    case 'js':  $reply = "$path/css/$f.js";  break;
    case 'css': $reply = "$path/css/$f.css"; break;
    case 'png': $reply = "$path/img/$f.png"; break;
    }
  if (!is_file($reply)){
    $msg = "'$reply' not found, realpath=".realpath($reply);
    if (class_exists('MSG',0)) MSG::ERROR($msg);
    else  print "$msg<br>";
  }
  if ($print) print "'$reply'";
  else       return "'$reply'";
}

/*
 *
 */
function sh_tpl_info(){
  $info = array();
  return (empty($info)
	  ? ""
	  : x("li class='shadow-box dev-info'",join(',&nbsp;',$info)));
}

/*
 * Login/logout button
 */
function sh_tpl_login(){
  return b_t::lang_selector(YB_tpl_login(True));;
  if (class_exists('bAuth',0)){
    $flavor = b_crypt_no."=1&q=".THEME_current_module."&flavor=".b_cnf::get('flavor').'&org='.(defined('myOrg_ID'?myOrg_ID:''));
    if (is_object(bAuth::$av) && function_exists('myPear_access')){
      $rank = myPear_access()->getRank();
      $title = ($rank > RANK__authenticated ? myPear_access()->getTitle() : '') . ' ' . bAuth::$av->fmtName('fl').' ';
      $reply[] = x("li",x('em class="shadow-box loggedin"',"$title<a href='".b_url::same("?quit_once=yes&$flavor&resetcache_once=1")."'>[logout]</a>"));
    }elseif(THEME_current_module){
      $reply[] = x("li","<a href='".b_url::same("?resetcache_once=1&login=yes&$flavor")."'><img alt='login' src=".sh_tpl_css('login','png',0)." /></a>");
    }
  }
  return join("\n",$reply);
}

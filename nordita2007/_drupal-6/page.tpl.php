<?php
/*
 * Avoid problems with the locales
 */
if (function_exists("date_default_timezone_set") and 
    function_exists("date_default_timezone_get"))  @date_default_timezone_set(@date_default_timezone_get());
if (!function_exists('my_drupal_get_path')){
  function my_drupal_get_path($a1,$a2){
    return drupal_get_path($a1,$a2);
  }
}

if (cnf_inside_fb){

  print myPear::getWidget();

}else{
  /*
   * Let the application define the page banner
   */
  if ($t=@$GLOBALS['pageTitle']) $themeTitle = $t;
  else                           $themeTitle = '<span>Nordic Institute </span>for Theoretical Physics';
  #???  $themeTitle = bText::_($themeTitle);
  
  /*
   * detect the front page
   */
  if (file_exists($f=dirname(__FILE__).'/detect_front_page.inc')) {
    $theme = 'nordita';
    require $f;
  };
  
  $this_today = date('Y-m-d');
  $this_author = 'Iouri Belokopytov';
  $this_revision = '1';
  $lang = class_exists('bText',0) ? bText::getLang() : 'en';
  
  if (class_exists('b_cnf',0)) {
    /*
     * show the performance test results
     */  
    ob_start();
    $t = new b_table(); $t->tro(); $t->tdo();
    bTiming()->show();
    $t->tdc(); $t->tdo();
    bCount()->show();
    $t->tdc(); $t->trc(); $t->close();
    $timing = ob_get_contents();                                                                                                         
    ob_end_clean();
  }
  
  print 
    "<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html lang='$lang'>
<head>
  <meta http-equiv='X-UA-Compatible'     content='IE=8'>
  <meta http-equiv='content-style-type'  content='text/css' />
  <meta http-equiv='content-script-type' content='text/javaScript' />
  <meta http-equiv='pragma'              content='no-cache' />
  <meta http-equiv='cache-control'       content='no-cache, must-revalidate'>
  <meta http-equiv='expires'             content='0'>
  <meta http-equiv='imagetoolbar'        content='no'>
  <meta name='robots'                    content='index,follow'>
  <meta name='author'                    content='$this_author'>
  <meta name='date-revision-yyyymmdd'    content='$this_revision'>
  <meta name='description'               content='NORDITA - Nordic Institute for Theoretical Physics'>
  <meta name='keywords'                  content='NORDITA, Nordic Institute for Theoretical Physics, nordic, theoretical physics, physics, astrophysics, nuclear physics, astrobiology, high energy physics, condensed matter physics, condensed matter, string theory, particle physics, '>
  <title>$head_title</title>
<!-- head start -->  
    $head 
<!-- head end  -->
   <link type='text/css' rel='stylesheet' media='all'  href='".nordita_css("drupal.css")."'>
    $styles  
    $scripts 
".
    (arg(2)=='themes' || arg(2)=='track' ? "<style type='text/css'>#outerColumn {border-right: none !important;} #rightCol {display: none;}</style>" : "")."
  <link type='text/css' rel='stylesheet' media='all'  href='".nordita_css("nor_style.css")."'>
  <!--[if !IE]>--><link rel='shortcut icon' href=".nordita_css('favicon.ico','')."><!--<![endif]-->
  <!--[if IE]><![if gte IE 5.5]><![endif]-->
  <link type='text/css' rel='stylesheet' media='screen' href='".nordita_css("screen.css")."'>
  <link type='text/css' rel='stylesheet' media='screen' href='".nordita_css("screen_mac.css")."'>
  <!--[if IE]><![endif]><![endif]-->
  <!--[if IE]>    <link type='text/css' rel='stylesheet' media='screen' href='".nordita_css("msie-hacks.css"). "'><![endif]-->
  <!--[if IE 7]>  <link type='text/css' rel='stylesheet' media='screen' href='".nordita_css("msie7-hacks.css")."'><![endif]-->
  <!--[if IE 6]>  <link type='text/css' rel='stylesheet' media='screen' href='".nordita_css("msie6-hacks.css")."'><![endif]-->
  <!--[if IE 5.5]><link type='text/css' rel='stylesheet' media='screen' href='".nordita_css("msie6-hacks.css")."'><![endif]-->
  <link type='text/css' rel='stylesheet' media='print'  href='".nordita_css("print.css")."'>
</head>
<body class='$body_classes'>
<div id='container-head'>  
  <div id='block-skiptocontent' class='tab'><p><a href='#div-main-content'>Skip to content</a></p></div>
  <div id='block-banner'>  
    <div id='div-banner-logo'> 
      <p><a  href='http://$_SERVER[HTTP_HOST]/'><img src='".nordita_css('logo_star_60x60.png','images')."' alt=''></a></p>
      <h1><a href='http://$_SERVER[HTTP_HOST]/'>NORDITA</a></h1>
      <h2>$themeTitle</h2>
      <div id='logininfo' class='only_online'>".nordita_info()."</div>
      <div style='clear:both'></div>
    </div> 
  </div>".
($tabs ? "<div class='only_online tabs'>$tabs</div>":"")."
</div>

<div id='container-wide-body'>  
  <div id='block-main'>  
    <!-- hr class='hidden' -->
    <div id='div-main-content'>".
      (isset($primary_links) ? theme('links', $primary_links, array('class' => 'topnav')) : "")."
      <div id='outerColumn' class='".($left ? "clr" : "no-sidebars")."'>
	<div id='innerColumn' class='clr'>
          <div id='soContainer' class='clr'>
            <div id='content'>
<!--         <center><table class='b_table'><tbody><tr><td> -->
	      <div class='inside centralized'>
";             //$breadcrumb .  // horizontal "where am i"

  print
    $messages.
    ($mission       ? "<div class='mission'>$mission</div>":"").
    ($title         ? "<div id='div-main-contentheading'><h2>$title</h2></div>":"").
    $help . 
    $content . 
    $feed_icons.
    $timing."
	      </div>
<!--         </td></tr></tbody></table></center> -->
            </div> ".
	    ($left  ? "<div id='leftCol'><div class='inside'>\n $left</div></div>":"")."
	  </div>
        </div> ".
	($right ? "<div id='rightCol'><div class='inside'>\n $right</div></div>" : "")."
      </div>
    </div>
";

  print "
    <div id='block-colophon'>
      <div id='div-colophon-address'>".
	(0 && ($footer_message || $footer) ? "<div class='footer_left'>".($footer_message ? "<div class='footer_message'>$footer_message</div>":"").$footer."</div>":"")."
	<div class='footer_right'>".theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist'))."</div>
        <address>
	  <strong>NORDITA</strong>, Roslagstullsbacken&nbsp;23,&nbsp;106&nbsp;91&nbsp;Stockholm,&nbsp;Sweden
          <br />Phone:&nbsp;+46-8-5537&nbsp;8444, Fax:&nbsp;+46-8-5537&nbsp;8404, E-mail:&nbsp;info<span class='snabela'>&nbsp;</span>nordita.org
        </address>
        <p class='only_online'>
          <a href='http://www.nordita.org//institute/map/index.php'>How to get here</a>&nbsp;&#8212;&nbsp;
          <a href='http://www.nordita.org//institute/site/sitemap/index.php'>Sitemap</a>
        </p>
        <p class='only_print align_right'>$this_today</p>
      </div> 
      <div id='div-colophon-footprint'>
        <address>".myPear::module_info()."</address>
      </div>
    </div>
  </div>
</div>
$closure
</body>
</html>
";
  if (function_exists('core_logAccess')) core_logAccess();
}

function nordita_css($f,$type='css'){ 
  return my_drupal_get_path('theme','nordita') . "/$type/$f"; 
  static $path = '';
  if(empty($path)) $path = str_replace(getcwd().'/', '', dirname(realpath(__FILE__)));
  return "$path/$type/$f"; 
}

function nordita_info(){
  if (class_exists('b_cnf',0)){
    $loginInfo = array();
    if (class_exists('bAuth',0))
      if (bAuth::authenticated()){
	if (THEME_current_module){
	  $title = myPear_access()->getTitle();
	  $logoutButton= "<em>$title ".bAuth::$av->fmtName('fl')."<a href='".b_url::same(array('quit_once'=>'yes'))."'> [logout]</a></em>";
	  $loginInfo[] = "<p class='loggedin'>$logoutButton</p>";
	}
      }else{
	$loginButton = "<a href='".b_url::same(array('login'=>'yes'))."'><img alt='login' src='".nordita_css('login.png','images')."' /></a>";
      }
    $loginButton .=  b_cache_file::refreshButton().join('',bText::getLangIcons());
    return $loginButton.join('<br/>',$loginInfo);
  }
}

function nordita_front_page(){
  return x('h1',bText::_('Welcome...'));
}

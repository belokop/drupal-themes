<?php
$theme = 'sh';
require_once(dirname(__FILE__).'/config.inc');
require_once(dirname(__FILE__).'/compat_drupal.inc');
require_once(dirname(__FILE__).'/functions.php');
require_once(dirname(__FILE__).'/detect_front_page.inc');

function sprites(){
  $m = (in_array(($m=b_reg::$current_module),array('art','hrm'))
	? $m
	: 'art');
  if (empty($_SESSION[__function__][$m])){
    $path = "./sites/default/files/data/$m/artworks"; // /000068/
    $files = array();
    
    if ($handle1 = opendir($path)){
      while (false !== ($dir = readdir($handle1))){
	if (in_array($dir,array('.','..')) || !is_dir($pathM="$path/$dir")) continue;
	if ($handle2 = opendir($pathM)){
	  while (false !== ($file = readdir($handle2))){
	    if (strpos($file,'_L.') === False) continue;
	    $files[] = sprintf('<img class="sprite_list" src="%s/%s" />',$pathM,$file);
	  }
	  closedir($handle2);
	}
      }
      closedir($handle1);
    }
    $_SESSION[__function__][$m] = $files;
  }

  $code = x('div class="sprite"',
	    x('div class="inner"',
	      join("\n",$_SESSION[__function__][$m])));

  $script = '
<script>

    var interval = 10000; // Change image every interval/1000 seconds
  carousel();

  function carousel() {
    var i;
    var x = document.getElementsByClassName("sprite_list");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    var myIndex = Math.floor(Math.random() * Math.floor(x.length)) + 1;
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel,interval);
  }
</script>
';
  return array($code,$script);
}
list($sprites_list,$sprites_js) = sprites();

// Login/logout button
function YB_tpl_login($return_a=False){
  global $theme;
  $reply = '';
  if (class_exists('bAuth',0)){
    $flavor = "q=".b_reg::$current_module;
    if (is_object(bAuth::$av)){
      $title = ' ' . bAuth::$av->fmtName('f').' ';
      $reply = x('em class="shadow-box loggedin" style="color:blue"',
                 "$title<a href='".b_url::same("?quit_once=yes&$flavor&resetcache_once=1")."'>[logout]</a>");
    }else{
      $reply = x("a href='".b_url::same("?resetcache_once=1&login=yes")."'","<img alt='login' src=".drupal_get_path('theme',$theme).'/img/login.png>');
    }
  }
  return ($return_a
          ? $reply
          : x("span style='float:right;font-size:x-small;color:white;'",$reply));
}
/**
 * @file
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. themes/sh.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in the template.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node associated with the page, 
 *   and the node ID is the second argument in the page's path (e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['footer']: Items for the footer region.
 */

// Let's not redirect to the SH main page when people hit SH logo, but stay in the current theme
if (!defined('cnf_dev') || (!cnf_dev && !cnf_demo)){
  if (class_exists('myPear',0) && defined('EA_MODULE')) myPear_access('EA_MODULE');
  //  if (!defined('EA_manager_here') || !EA_manager_here) $GLOBALS['url_index'] = $url_index = 'http://www.sh.org/';
}

$url_photos = '#';
$splash = sprintf('splash-%02d',rand(0,19));
$module = (in_array(($m=b_reg::$current_module),array('art','hrm')) ? $m : 'art');
$splash = sh_tpl_css("splash_$module",'png',0);

if (empty($search_string)) $search_string = @$GLOBALS['search_string'];
if (empty($search_string)) $search_string = 'search';

$horiz_menu = '';
if (class_exists('myPear',False)){
  
  //
  // print the "HvZM top horizontal menu"
  //
  if ($is_front){
    $horiz_menu = $tabsFP;
  }else{
    // See sh_preprocess_page
    if (!isset($sh_nav_level2)) $sh_nav_level2 = @$GLOBALS['sh_nav_level2'];
    if ( empty($sh_nav_level2)) $sh_nav_level2 = array();
    $horiz_menu = array();
    foreach($sh_nav_level2 as $nav){
      $horiz_menu[] = x("a href='?q=".$nav['#href']."'",$nav['#title']);
    }
    $horiz_menu = b_fmt::joinMap('li',$horiz_menu);
  }
}

print "
<div id='container-viewport'>
  <div id='region-bartop'>
    <div id='block-skiptocontent'>
      <p><a href='#region-content' rel='nofollow'>Skip&nbsp;to&nbsp;content</a></p>
    </div> 
  </div>
</div> 

<div id='container-fixed'>
  <div id='region-topmargin'>
    <div id='block-login'>
        ".b_t::lang_selector(YB_tpl_login(True))."
    </div> 
  </div> 

  <div id='region-banner'>
    <div id='block-logo'>
      <p> <a href='".(class_exists('b_url',False) ? preg_replace('/y=.*/','',b_url::same('?q=')) : '')."'><img src=".sh_tpl_css('SH','png',0)." alt=''/></a></p>
      <div style='clear:both'></div>
    </div>
  </div> 
 
  <div id='region-headlineleft'>
    $sprites_list
<!--
    <img src=$splash>
    <div id='block-leftimage-drp' class='shadow $splash'>
      <a href='$url_photos'><img src=".sh_tpl_css('pixel-transparent','png',0)." alt='' style='width:180px;height:80px;'/></a>
    </div> 
-->
  </div> 
  
  <div id='region-top'>
".(!$is_front ?
"
    <div id='block-searchfield'>
      <form method='post' action='".(class_exists('b_url',False) ? b_url::same('?') : '')."' id='os_search' name='os_search' class='simplesearch' enctype='multipart/form-data'>
        <input type='text' name='sh-qry' value='&nbsp;$search_string' id='qry' class='input-def-value' />
        <input type='submit' value='Search' class='button page-load-progress'/>
      </form>
    </div> 
" : "")."        
    <div id='block-topmenu' class='shadow-inset'>
      <ul class='page-load-progress'>
         $horiz_menu
      </ul>
    </div>
  </div>

  <div id='region-columnleft'>
    <div id='block-fulltree'>
       ".n_printLeftMenu($page,@$left,@$primary_links,@$secondary_links)."
       <div class='clear'></div>
    </div>
  </div>
<!-- tripav -->
";
if (strpos(@$_GET['q'],'wiw') === 0) require_once "tripav.inc.html";
print "</div>
   
<div id='container-scrolled'>

  <div id='region-headlinecenter'>
    <hr class='sh-hidden'/>
    <div id='block-contentheading'>
      ".n_printPageTitle($is_front,$title,$title_prefix,$title_suffix)."
    </div>
    <hr class='sh-hidden'/> 
  </div>

  <div id='region-content'>
<div id='block-content'>

      <!--  highlighted   -->   ".(@$page['highlighted'] ? "<div id='highlighted'>".render($page['highlighted'],'page[highlighted]')."</div>" : '')."
      <!-- /highlighted   -->

      <!--  tabs          -->   ".(trim($t=render($tabs,'tabs')) ? "<div class='tabs'>\n".str_replace("><ul",">\n<ul",str_replace("><li",">\n<li",$t))."\n</div>" : "")."
      <!-- /tabs          -->

      <!--  messages      -->   ".($show_messages ? $messages : "")."
      <!-- /messages      -->

      <!--  help          -->   ".render($page['help'],'page[help]')."
      <!-- /help          -->

      <!--  action_links  -->   ".($action_links ? "<ul class='action-links'>".render($action_links,'action_links')."</ul>" : "")."
      <!-- /action_links  -->

      <!--  content       -->
      ".($is_front ? $content : render($page['content'],'$page[content]'))."
      <!-- /content       -->

      <!--  feed_icons    -->      $feed_icons
      <!-- /feed_icons    -->

      <!--  timing        -->      $timing
      <!-- /timing        -->

    <hr class='sh-hidden'/>
</div> <!-- content -->

    <div id='block-colophon' class='col-content-center' style='overflow:visible;'>
      <div id='colophon-short-address'>
      </div> <!-- colophon-short-address -->
      <div id='colophon-footprint' class='only_online'>
       <p><em>$GLOBALS[module_v]<br/>$GLOBALS[module_d]</em></p>
      </div>
    </div> <!-- /block-colophon -->
  </div>
</div>
<!--  footer            --> 
$sprites_js
";
if    (isset($page['footer'])) print render($page['footer']); 
elseif(isset($closure))        print $closure; 
require_once dirname(__FILE__)."/analyticstracking.php";

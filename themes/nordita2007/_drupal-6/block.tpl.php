<?php
if (!function_exists('_nor_strip_menu')){
  function _nor_strip_menu($trigger='Nordita 2007'){
    
    if (is_array($nMenu = menu_tree_page_data('navigation'))){
      foreach(array_keys($nMenu) as $l2){
	if (strstr($l2,$trigger)) return menu_tree_output($nMenu[$l2]['below']);
      }
    }else{ 
      return menu_tree();
    }
  }
}

switch($nordita = (strpos($_GET['q'],'nor') === 0)){
case True:
  $toShow = False;
  $toShow = True;
  if    ($block->module == 'system')                   $toShow = True;
  elseif($block->module == 'user' && $block->delta==0) $toShow = False;
  elseif($block->module == 'user' && $block->delta==1){$toShow = True; $block->subject = ''; $block->content=_nor_strip_menu(); }
  break;

case False:
  $toShow = True;
}

$class = "block block-$block->module";
$id    = "block-$block->module-$block->delta";
if ($toShow) print join("\n",array('',
				   "<!-- START block.tpl.php $class $id -->",
				   "<div class='$class' id='$id'>",
				   ($block->subject ? "<h3 class='title'>$block->subject</h3>\n" : ""),
				   "<div class='content'>$block->content</div>",
				   '</div>',
				   "<!-- END block.tpl.php $class $id -->",
				   ''));


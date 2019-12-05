<?php
print "<span class='redText'>block=".basename(__FILE__)."</span>";                                                                                                                               
print "<div class='node".($sticky?" sticky":"").($status?"":" node-unpublished").($page==0 ? " teaser" : "")."'>";
if ($picture) print $picture; 
if ($page == 0) print "<h2 class='title'><a href='$node_url'>$title</a></h2>";
print "<div class='content clr'>$content</div>";

if ($submitted || $links || $terms){
  print "<div class='bottom'>";
  if ($terms)     print "<div  class='taxonomy'>$terms ?></div>";
  if ($submitted) print "<span class='submitted'>$submitted</span>";
  if ($links)     print "<div  class='links'>$links</div>";
  print "</div>";
}

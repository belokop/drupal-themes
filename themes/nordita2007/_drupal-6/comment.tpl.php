<?php
function this_printIf($text){
  if (strip_tags($text)) return $text;
}
print "
<div class='comment".(isset($comment->status) && $comment->status == COMMENT_NOT_PUBLISHED ? ' comment-unpublished' : '')."'>".
$picture.
this_printIf("<h4 class='title'>$title</h4>").
this_printIf("<span class='new'>$new</span>").
this_printIf("<div class='submitted'>$submitted</div>").
this_printIf("<div class='content'>$content</div>").
this_printIf("<div class='signature'>$signature</div>").
this_printIf("<div class='links'>&raquo; $links</div>",'').
"</div>\n";


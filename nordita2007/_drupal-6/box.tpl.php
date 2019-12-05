<?php
print "<font color='red'>block=".basename(__FILE__)."</font>";
print "<div class='box'>"($title ? "<h2 class='title'>$title</h2>" : "")."<div class='content'>$content</div></div>";

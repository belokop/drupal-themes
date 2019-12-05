<BODY BGCOLOR=white>
<center>
<TABLE CELLPADDING=3 BORDER=0 BGCOLOR=#F0F0FF CELLPADDING=3>
<?php
$nColumns = $_GET['n'] ? $_GET['n'] : 2; 
$handle = opendir('.');
while ($file = readdir($handle)) {
  if (preg_match("/^(\.|index)|CVS/",$file))          continue;
  $n++;
  if ($n > $nColumns) $n = 1;
  $files[$n][] = $file;
}
closedir($handle);

#echo "<pre>"; print_r($files); echo "</pre>";

for($r=0; $r<count($files[1]); $r++) {
  echo "<TR>";
    for($p=1; $p<=$nColumns; $p++){
      print "<td align=right>".$files[$p][$r]."</td>";
      echo "<TD ALIGN=left VALIGN=center><IMG SRC='".$files[$p][$r]."' ></TD>";
  }
  echo "</TR>\n";
}
if (0){
  foreach ($files as $n=>$f){
    echo "<TR>";
    foreach($files as $file){
      echo "<TD ALIGN=left>$file</TD><TD ALIGN=left VALIGN=center><IMG SRC=$file></TD>";
    }
    echo "</TR>\n";
  }
}
?>
</TABLE>
</CENTER>
</BODY>

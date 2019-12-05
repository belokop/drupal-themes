

  //document.getElementsByClassName = nymanGetElementsByClassName;

  // -------------------------------------
  // Adapted from http://willperone.net/Code/codeshowhide.php and
  // http://www.webmasterworld.com/forum91/441.htm (#:1474104)
  // <p><a href="#" onclick="toggleDisplay('div1');">Show/hide me</a></p>
  // <div id="div1" style="display: none;">This is the content</div>
  // -------------------------------------

  // getElementsByClassName() is a native method for:
  //   Firefox 3+
  //   Opera 10+
  //   Chrome 4+
  //   Safari 4+
  //   IE 9+
  // Hence the backwards compatibility fixes below are redundant...

  function turnOn (idx,class_name) {
    var list = document.getElementsByClassName(class_name);
    for (i=0; i<list.length; i++) {
      //if (list[i].id.match(idx)) {
      if (list[i].id.match('^'+idx+'$')) {
        newstate = 'block';
      } else {
        newstate = 'none';
      }
      if (document.getElementById && !document.all) { // DOM3 = IE5, NS6
        list[i].style.display = newstate;
      } else if (document.all) { // IE 4 or 5 (or 6 beta)
        eval( "document.all." + list[i] + ".style.display = newstate"); // HM: ???
      } else if (document.layers) { // NETSCAPE 4 or below
        document.layers[list[i]].display = newstate; // HM: ???
      }
    }
  }

  function toggleTest (class_name) {
    var list = document.getElementsByClassName(class_name);
    var num = list.length + " elements have className of " + class_name;
    var str = "\n\nThe IDs are:\n";
    for (var i = 0; i < list.length; i++) { str += "\n" + list[i].id; }
    alert(num + str);
  }

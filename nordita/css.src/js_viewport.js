// *********************************************************************
//
// JS-VIEWPORT.JS
// Hans Mühlen / 2006-04-27 -- 2010-11-02
//
// Adapted from: http://www.quirksmode.org/viewport/compatibility.html
//
// *********************************************************************
//
// Usage:
//
//   <script type='text/javascript' src='PATH_JS/js-viewport.js'></script>
//
//   <script type='text/javascript'>
//     void document.write(innerWindowDimensions());
//   </script>
//
//   <script type='text/javascript'>
//     void document.write(heightOfPage());
//   </script>
//
// *********************************************************************


// --------------------------------------------------

var props = new Array(
	'self.pageXOffset',
	'self.pageYOffset',
	'self.screenX',
	'self.screenY',
	'self.innerHeight',
	'self.innerWidth',
	'self.outerHeight',
	'self.outerWidth',
	'self.screen.height',
	'self.screen.width',
	'self.screen.availHeight',
	'self.screen.availWidth',
	'self.screen.availTop',
	'self.screen.availLeft',
	'self.screen.Top',
	'self.screen.Left',
	'self.screenTop',
	'self.screenLeft',
	'self.screen.colorDepth',
	'self.screen.pixelDepth',
	'document.body.clientHeight',
	'document.body.clientWidth',
	'document.body.scrollHeight',
	'document.body.scrollWidth',
	'document.body.scrollLeft',
	'document.body.scrollTop',
	'document.body.offsetHeight',
	'document.body.offsetWidth',
	'document.body.offsetTop',
	'document.body.offsetLeft'
);



// --------------------------------------------------
// The inner dimensions of the window or frame.

function innerWindowDimensions()
{
	var printstring = '';
	var x,y;
	if (self.innerHeight) // all except Explorer
	{
		x = self.innerWidth;
		y = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight)
		// Explorer 6 Strict Mode
	{
		x = document.documentElement.clientWidth;
		y = document.documentElement.clientHeight;
	}
	else if (document.body) // other Explorers
	{
		x = document.body.clientWidth;
		y = document.body.clientHeight;
	}

    printstring =
      //"webbl&auml;sarf&ouml;nstret " +
      //"<a href='#' " +
      //"onclick='reInnerWindowDimensions(); " +
      ////"reHeightOfPage(); " +
      //"return false' " +
      //"title='ber&auml;kna p&aring; nytt'>&auml;r<\/a>&nbsp;" +
      x + "&nbsp;x&nbsp;" + y;

	return printstring;
}

function reInnerWindowDimensions()
{
	if (!document.getElementById) return;
	document.getElementById('innerWindowDimensions').innerHTML = innerWindowDimensions();
}








// --------------------------------------------------
// The height of the total page (usually the body element).

function heightOfPage()
{
	var printstring = '';
	var x,y;
	var test1 = document.body.scrollHeight;
	var test2 = document.body.offsetHeight
	if (test1 > test2) // all but Explorer Mac
	{
		x = document.body.scrollWidth;
		y = document.body.scrollHeight;
	}
	else // Explorer Mac;
		 //would also work in Explorer 6 Strict, Mozilla and Safari
	{
		x = document.body.offsetWidth;
		y = document.body.offsetHeight;
	}

    printstring = x + "&nbsp;x&nbsp;" + y;

	return printstring;
}

//function reHeightOfPage()
//{
//	if (!document.getElementById) return;
//	document.getElementById('heightOfPage').innerHTML = heightOfPage();
//}


// --------------------------------------------------
// How much the page has scrolled. (NOP?)

function howMuchScrolled()
{
	var printstring = '';
	var x,y;
	if (self.pageYOffset) // all except Explorer
	{
        x = self.pageXOffset;
		y = self.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop)
		// Explorer 6 Strict
	{
		x = document.documentElement.scrollLeft;
		y = document.documentElement.scrollTop;
	}
	else if (document.body) // all other Explorers
	{
		x = document.body.scrollLeft;
		y = document.body.scrollTop;
	}

    if (x!=0 && y!=0)
    printstring = "webbsidan har scrollats " + x + "&nbsp;x&nbsp;" + y + "&nbsp;pixel";

	return printstring;
}



// --------------------------------------------------
//
// Original scripts; Not used here
//

function getAll()
{
	var printstring = '';
	for (var i=0;i<props.length;i++)
	{
		if (!self.screen && props[i].indexOf('self.screen') != -1) continue;
		if (!document.body && props[i].indexOf('document.body') != -1) continue;
		if (eval(props[i])) printstring += '<BR>' + props[i] + ': ' + eval(props[i]);
		if (props[i].indexOf('document.body') != -1)
		{
			var end = props[i].substring(props[i].lastIndexOf('.')+1);
			newprop = 'document.documentElement.' + end;
			if (eval(newprop)) printstring += '<BR>' + newprop + ': ' + eval(newprop);
		}
	}
	return printstring;
}

function show()
{
	alert('pageYOffset = ' + self.pageYOffset);
}

function reGet()
{
	if (!document.getElementById) return;
	document.getElementById('writeroot').innerHTML = getAll();
}


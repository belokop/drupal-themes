/* ================================================================= */
/*                                                                   */
/* CCS/JS.JS                                                         */
/*                                                                   */
/* Hans Mühlen / 2007-08-07 -- 2013-02-28                            */
/*                                                                   */
/* ================================================================= */

/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
/*                                                                   */
/*  *** WORK IN PROGRESS! ***   Do not copy or comment!              */
/*                                                                   */
/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */



/* ----------------------------------------------------------------- */
/* Javascript to force frameset pages to top frame
/* ----------------------------------------------------------------- */

if (self != top) top.location=self.location;

/* -- end -- Javascript to force frameset pages to top frame */
/* ----------------------------------------------------------------- */
















/* ----------------------------------------------------------------- */
/* Google Map javascript API
/*
/*  http://code.google.com/apis/maps/documentation/javascript/
/*
/* Nordita huvudbyggnad:     59.353086, 18.058508
/* AlbaNova huvudbyggnad:    59.353802, 18.057915
/* AlbaNova godsmottagning:  59.354196, 18.058591
/* Stadshuset:               59.327815, 18.055576
/* ----------------------------------------------------------------- */

  function initmap(cid,zm) {

    var latlngNordita    = new google.maps.LatLng(59.353086, 18.058508);
    var latlngAlbanova   = new google.maps.LatLng(59.353802, 18.057915);
    var latlngStadshuset = new google.maps.LatLng(59.327815, 18.055576);

    var mapOptions = {
      zoom: zm,
      center: latlngStadshuset,
      mapTypeControl: false,
      streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById(cid),mapOptions);

/* TODO: marker is not positioned as expected */
    var markerOptions = {
      map: map,
      title: "Nordita",
      position: latlngNordita,
      /* icon: "img/logo_star_60x60.png", */
      /* shadow: "img/logo_star_60x60.png", */
      zIndex: 1
    };
    var marker = new google.maps.Marker(markerOptions);

  }

/* -- end -- Google Map javascript API */
/* ----------------------------------------------------------------- */






/* ----------------------------------------------------------------- */
/* ...
/* ----------------------------------------------------------------- */

function reshuffleResearchSprites (id) {

  switch(id) {
    case "ap": x = "0";    break;
    case "cm": x = "-50";  break;
    case "sa": x = "-100"; break;
    default:   x = "0";
  }

  var yarray = [0,1,2,3,4,5,6,7];
  yarray.sort(function() {return 0.5 - Math.random()})

  document.getElementById(id+"1").style.backgroundPosition = x+"px -"+50*yarray.shift()+"px";
  document.getElementById(id+"2").style.backgroundPosition = x+"px -"+50*yarray.shift()+"px";

}

/* ----------------------------------------------------------------- */






/* ============================================ */
/* jQuery().ready(function(){ */
$(document).ready(function(){
/* ============================================ */


  /* ----------------------------------------------------------------- */
  /* Google Analytics
  /*
  /*  http://code.google.com/apis/analytics/
  /*  https://www.google.com/analytics/settings/
  /*
  /* Asynchronous tracking (recommended):
  /*  http://www.google.com/support/googleanalytics/bin/answer.py?answer=174090
  /* ----------------------------------------------------------------- */

/* moved to '_classes/document' */

/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23741683-1']);
  _gaq.push(['_setDomainName', '.nordita.org']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/

  /* -- end -- Google Analytics */
  /* ----------------------------------------------------------------- */



  /* ------------------------------------------ */
  /* -- Adjusting layout for 'wide' pages --
  /* ------------------------------------------ */

  var computedWidth  = $('#container-fixed').width();
  var computedOffset = $('#container-fixed').offset();
  $('.rightwide #container-scrolled').css('left',computedOffset.left);
  $('.rightwide #block-colophon').css('width',computedWidth);



  /* ----------------------------------------------------------------- */
  /* jQuery
  /* ----------------------------------------------------------------- */

  /* ------------------------------------------ */
  /* -- TABS from jQuery UI                  --
  /*    http://api.jqueryui.com/tabs/
  /* ------------------------------------------ */

  $('#jtabs').tabs({
    active: 0,
    collapsible: false,
    disabled: false,
    event: 'click',
    heightStyle: 'content',
    hide: null,
    show: null
  });

  /* ------------------------------------------ */
  /* -- ACCORDION from jQuery UI             --
  /*    http://docs.jquery.com/UI/Accordion
  /*    http://jqueryui.com/accordion/
  /*    Documentation in 'js_retired.js'
  /* ------------------------------------------ */

  /* -- for block::BsidebarBoxes() -- */

  $('#region-columnright #block-sidebarboxes').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h3',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });
  $('#region-headlinecenter #block-sidebarboxes').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h3',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });

  /* -- for current positions listings -- */

  $('#openpositions .current').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'dl',
    icons: { 'header': 'ui-icon-arrowthickstop-1-s', 'headerSelected': 'ui-icon-arrowthickstop-1-n' },
    navigation: false
  });

  /* -- for front page sampler boxes -- */

  $('.accordionbox').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h2',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });

  /* -- for newsedit article lists -- */

  $('.newslist .accordion').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h3',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });

  /* -- for front page announcements box -- */

/*
Seems not to work:
    active: true,
*/
  $('#announcements.openonclick').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h2',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });
/*
Seems not to work:
$('#announcements').accordion('activate':'#announcements');
*/

  /* -- end -- jQuery */
  /* ----------------------------------------------------------------- */



  /* ---------------------------------------- */
  /* -- INPUT DEFAULT VALUE for:
  /*      block::Bsearchfield()
  /*      people::searchPeople()
  /*      widget::WpreprintCode()
  /*      widget::WpeoplePresentationSearch()
  /*      admin::AtestGoogleSearch()
  /* ---------------------------------------- */

  $('.input-default-value').each(function() {
    var default_value = this.value;
    $(this).css('color', '#666'); /* #666 */
    $(this).css('font-style', 'italic');
    $(this).focus(function() {
      if(this.value == default_value) {
        this.value = '';
        $(this).css('color', '#000'); /* #333 */
        $(this).css('font-style', 'italic');
      }
    });
    $(this).blur(function() {
      if(this.value == '') {
        $(this).css('color', '#999'); /* #666 */
        $(this).css('font-style', 'italic');
        this.value = default_value;
      }
    });
  });


/* ----------------------------------------------------------------- */
/* Javascript to force block stick to top of scrolling page
/* http://stackoverflow.com/questions/1216114/how-can-i-make-a-div-stick-to-the-top-of-the-screen-once-its-been-scrolled-to */
/* ----------------------------------------------------------------- */
/* $("div").text("There are " + n + " divs." + b); */

$(window).load(function(){
  $(function() {
    var a = function() {
      var b = $(window).scrollTop();
      var d = 120;
      var g = $("#container-fixed").offset().left;
      var c = $("#block-searchfield");
      var f = $("#region-columnleft");
      var h = $("#region-headlineleft");
      var i = $("#block-newsissue");  
      if ($("#startpage").length>0) b = 0;
      if (b>d) {
        c.css({position:"fixed",top:"0px",left:g})
        i.css({position:"fixed",top:"0px",left:g})
        h.css({position:"fixed",top:"45px",left:g})
        f.css({position:"fixed",top:"140px",left:g})
      } else {
        if (b<=d) {
          c.css({position:"absolute",top:"0px",left:"0"})
          i.css({position:"absolute",top:"0px",left:"0"})
          h.css({position:"absolute",top:"165px",left:"0"})
          f.css({position:"absolute",top:"260px",left:"0"})
        }
      }
    };
    $(window).scroll(a);a()
  });
});

/* ----------------------------------------------------------------- */


/* ============================================ */
}); /* document ready */
/* ============================================ */



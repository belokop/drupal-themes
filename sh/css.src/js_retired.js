
/* ----------------------------------------------------------------- */
/* jQuery
/*
/* -- http://docs.jquery.com/UI/Accordion
/* -- http://gsgd.co.uk/sandbox/jquery/easing/
/*
/* The $(document).ready() function is similar to the window.onLoad but improved. With the window.onLoad function, the browser has to wait until the whole page (DOM and display) is loaded. With the $(document).ready() function, the browser only waits until the DOM is loaded, which means jQuery can start manipulating elements sooner.
/*
/* ----------------------------------------------------------------- */
/* -- ACCORDION config parameters
/* -- http://docs.jquery.com/UI/Accordion

 $('<css selector>').accordion({
   active: false,     // Selector for the active element. Set to false to display none at start
   animated: false,   // 'Bounceslide' is default. Also try: 'easeInSine'
                      // Set to false to disable animation, or
                      // leave out parameter entirely to use default animation
                      // More options: http://gsgd.co.uk/sandbox/jquery/easing/
   autoHeight: false, // If set, the highest content part is used as height reference for
                      // all other parts. Provides more consistent animations. Default: true
   collapsible: true, // Whether all the sections can be closed at once.
   event: 'click',    // The event on which to trigger the accordion. Default 'click'
   header: 'h3',      // Selector for the header element.
                      // Default: '> li > :first-child,> :not(li):even'
   icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
                      // Icons to use for headers. Icons may be specified for 'header'
                      // and 'headerSelected'
                      // Default: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' }
                      // See http://jqueryui.com/themeroller/ for options
   navigation: false, // If set, looks for the anchor that matches location.href and activates it.
                      // Great for href-based state-saving. Use navigationFilter to implement
                      // your own matcher.
                      // See: http://michaeljacobdavis.com/tutorials/statesavingaccordion.html
   speed: 'fast'      // NOP?
 });

/* ----------------------------------------------------------------- */
/* -- TABS config parameters
/* -- http://docs.jquery.com/UI/Tabs

 $('<css selector>').accordion({
 })

/* ----------------------------------------------------------------- */

/* ============================================ */
/* jQuery().ready(function(){ */
$(document).ready(function(){
/* ============================================ */

  /* ------------------------------------------ */
  /* -- Adjusting layout for 'wide' pages --
  /* ------------------------------------------ */

  var computedWidth  = $('#container-fixed').width();
  var computedOffset = $('#container-fixed').offset();
  $('.wide #container-scrolled').css('left',computedOffset.left);
  $('.wide #block-colophon').css('width',computedWidth);

  /* ------------------------------------------ */
  /* -- ANIMATION --
  /* ------------------------------------------ */

$('#clickme').click(function() {
  $('#book').animate({
    opacity: 0.25,
    left: '+=50',
    height: 'toggle'
  }, 5000, function() {
    // Animation complete.
  });
});

  /* ------------------------------------------ */
  /* -- SLIDE --
  /* ------------------------------------------ */

/*
  $('#announcementtab.slidedown h2').click(function() {
    $('#announcementtab.slidedown h2+div').slideToggle('fast', function() {
    });
  });

  $('#eventlist h3').click(function() {
    $('#eventlist h3+div').slideToggle('fast', function() {
    });
  });
*/
  /* ------------------------------------------ */
  /* -- ACCORDIONS --
  /* ------------------------------------------ */


/*
  $('.frontselect3 #region-columnleft').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h3',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });
*/

  /* -- for block::B----() -- */
/*
  $('#eventlist').accordion({
    active: false,
    autoHeight: false,
    collapsible: true,
    event: 'click',
    header: 'h3',
    icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
    navigation: false
  });
*/

  /* ---------------------------------------- */
  /* -- INPUT DEFAULT VALUE for block::___() --
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

  /* ---------------------------------------- */
  /* -- MEGAMENU for block::Btopmegamenu() --
  /* ---------------------------------------- */

   function addMega(){
     $(this).addClass('hovering');
   }

   function removeMega(){
     $(this).removeClass('hovering');
   }

   /* .hoverIntent() extends standard jQuery .hover() */
   /* http://cherne.net/brian/resources/jquery.hoverIntent.html */

     var megaIntentConfig = {
     interval: 20, /* 500 */ /* delay to first view */
     sensitivity: 4, /* 4 */
     over: addMega,
     timeout: 25, /* 500 */
     out: removeMega
   };
   $('li.mmenu').hoverIntent(megaIntentConfig);
   /* $('li.mmenu').hover(addMega,removeMega); */

/*
  $("#megatabs li").mouseover(function() {
        $(this).css('cursor', 'hand');
  })

  $("#megatabs li").mouseenter(function() {
        $(this).css('cursor', 'pointer');
  })

  $("#megatabs li").mouseleave(function() {
        $(this).css('cursor', 'text');
  });
*/
 /* -------------------------------------------- */
 /* -- MEGAMENU for block::BtopmegamenuTabs() --
 /* -------------------------------------------- */

/*
 $("#megatabs").tabs({
   collapsible: true,
   event: 'mouseover',
   fx: { opacity: 'toggle', duration: 'fast' },
   selected: -1
 }); */
   /* tabTemplate: '<div><a href="#{href}"><span>#{label}</span></a></div>' */
   /*     select: function(event, ui) {
        var url = $.data(ui.tab, 'load.tabs');
        if( url ) {
            location.href = url;
            return false;
        }
        return true;
    } */

/*
 $('#region-top #block-topmenu').accordion({
   active: false,
   animated: false,
   autoHeight: false,
   collapsible: true,
   event: 'click',
   header: 'h3',
   icons: { 'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus' },
   navigation: false
 });
*/

 /* ------------------------------------ */
 /* -- 'fixed' test
 /*    (väldigt hoppig)
 /* ------------------------------------ */
 /*
 var holder = '#container-fixed';
 var hleft = $(holder).offset();
 var hoffset = null;
 $(window).scroll(function () {
     hoffset = $(document).scrollTop();
     $(holder).offset({ top: hoffset, left: hleft.left });
 }); */

 /* ------------------------------------ */
 /* -- slide test
 /* ------------------------------------ */
 /*
  var p = $('#container-fixed');
  var offset = p.offset();
  alert( 'left: ' + offset.left + ', top: ' + offset.top );

  /* http://net.tutsplus.com/tutorials/html-css-techniques/creating-a-floating-html-menu-using-jquery-and-css/

  $(document).ready(function(){
      var name = '#block-fulltree';
      var menuYloc = null;
      menuYloc = parseInt($(name).css('top').substring(0,$(name).css('top').indexOf('px')))
      $(window).scroll(function () {
          var offset = menuYloc+$(document).scrollTop()+'px';
          $(name).animate({top:offset},{duration:500,queue:false});
      });
  });

  /* http://www.learningjquery.com/2009/02/slide-elements-in-different-directions

      $(document).ready(function() {
      $('#slideleft button').click(function() {
        var $lefty = $(this).next();
        $lefty.animate({
          left: parseInt($lefty.css('left'),10) == 0 ?
            -$lefty.outerWidth() :
            0
        });
      });
    });

  /* http://www.learningjquery.com/2009/02/slide-elements-in-different-directions

  $(document).ready(
    function() {
      $('#slide').click(function() {
        var $lft = $('#block-debugmenu');
        $lft.animate({
          left: parseInt($lft.css('right'),5) == 0 ?
            -$lft.outerWidth() :
            0
        });
      });
    }
  );
  */

/* ============================================ */
}); /* document ready */
/* ============================================ */

/* -- end -- jQuery */







/* ----------------------------------------------------------------- */
/* Used only with the MEGAMENU
/* ----------------------------------------------------------------- */
/**
* hoverIntent r6 // 2011.02.26 // jQuery 1.5.1+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
*
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne brian(at)cherne(dot)net
*/
/* ----------------------------------------------------------------- */

(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover)}})(jQuery);

/* -- end -- hoverIntent r6 */


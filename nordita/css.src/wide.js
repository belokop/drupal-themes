/* ================================================================= */
/*                                                                   */
/* _CCS/WIDE.JS                                                      */
/*                                                                   */
/* Hans Mühlen / 2011-09-24 -- 2011-09-24                            */
/*                                                                   */
/* ================================================================= */

/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
/*                                                                   */
/*  *** WORK IN PROGRESS! ***   Do not copy or comment!              */
/*                                                                   */
/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */



/* ------------------------------------------ */
/* -- Adjusting layout for 'wide' pages --
/* ------------------------------------------ */

$(document).ready(function(){

  var computedWidth  = $('#container-fixed').width();
  var computedOffset = $('#container-fixed').offset();
  $('.wide #container-scrolled').css('left',computedOffset.left);
  $('.wide #block-colophon').css('width',computedWidth);

}); /* document ready */

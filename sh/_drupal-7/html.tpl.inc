<?php
/**
 * @file
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings for the page.
 * - $page_top: Initial markup from any modules that have altered the page. This should always be output first.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the page. This should always be output last.
 * - $classes String of classes that can be used to style contextually through CSS.
 */
$b_classes = array();
if (!empty($body_classes)) $b_classes = array_merge($b_classes,$body_classes);
if (!empty($classes))      $b_classes = array_merge($b_classes,explode(' ',$classes));
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html lang='en' class='ie6'> <![endif]-->
<!--[if IE 7]>         <html lang='en' class='ie7'> <![endif]-->
<!--[if IE 8]>         <html lang='en' class='ie8'> <![endif]-->
<!--[if gt IE 8]><!--> <html lang='en'>         <!--<![endif]-->
<head>
   <?php print $head; ?>
   <title>SH - Sweet Home</title>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<!--
   <meta name='robots'    content='index,follow'>
   <meta name='googlebot' content='index,follow,noarchive,noimageindex'>
-->
   <meta name='robots'    content='noindex,nofollow,noodp,noydir'>
   <meta name='googlebot' content='noindex,nofollow,noarchive,noimageindex,noodp'>
   <meta name='author'    content='Iouri Belokopytov'>
    <!--[if IE]><meta http-equiv='imagetoolbar' content='no'><![endif]-->
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <!--[if !IE]>--><link rel='shortcut icon' href='img/_theme/th-frost/icon_address.png'><!--<![endif]-->
    <!--[if IE]><link rel='shortcut icon' href='/img/_theme/th-frost/icon_fav.ico'><![endif]-->
    <!--[if !IE]>--><link rel='apple-touch-icon' href='img/_theme/th-frost/icon_apple.png'><!--<![endif]-->
    <meta name='description' content='Intergovenrnmental research institute for theoretical physics. Situated in Stockholm, Sweden with a branch in Copenhagen, Denmark.'>
    <!--[if IE]><![endif]-->
<?php    print($styles.$scripts); ?>
</head>
  <body class=<?php print '"'.join(' ',$b_classes)."\" $attributes";?>>
<?php
if (defined('cnf_dev')){
  if (defined('cnf_inside_fb') && !cnf_inside_fb) $msg = (cnf_dev
							  ? 'D e v e l o p e r  m o d e'
							  : (cnf_demo
							     ? 'D e m o  v e r s i o n'
							     : ''));
  if (!empty($msg)){
    $msg = str_replace(' ','<br/>',$msg);
    print "<h1 style='position:fixed;width:5%;margin:0;color:red;top:0px;left:0px;opacity:0.2;text-align:center'>$msg</h1>";
  }
}

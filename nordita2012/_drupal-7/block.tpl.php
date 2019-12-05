<?php
/**
 * @file
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through CSS. 
 *   It can be manipulated through the variable $classes_array from preprocess functions. 
 *   The default values can be one or more of the following:
 *   - block: The current template type, i.e., 'theming hook'.
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In that case the class would be 'block-user'.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 */

// if(defined('cnf_dev') && cnf_dev) print b_fmt::redText(x('strong',b_reg::$current_module)." $block_html_id ").'<br/>';

if (class_exists('b_reg',False) && !empty(b_reg::$current_module)){ 
  // login & search are done by the myPear module, hence we might drop those provided by Drupal
  $block_to_drop = array('block-system-powered-by',
			 'block-search-form',
			 'block-user-login',
			 'block-powered',
			 'block-login',
			 );
  if ($is_front) { // b_reg::$current_module == myPear_MODULE){
    $block_to_drop += array('block-system-navigation');
  }
}else{
  $block_to_drop = array();
}

if (in_array($block_html_id,$block_to_drop)){
  print "\n<!-- ############################### drop $block_html_id -->\n";
}else{
  if (!isset($classes))  $classes = '';
  print "\n<!-- ############################### start $block_html_id -->
$content
<div class='clear'></div>
<!-- ############################### end $block_html_id -->
";
}

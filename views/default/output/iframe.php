

<?php
/**
 * Display a page in an embedded window
 *
 * @package Elgg-ggouv_template
 *
 * @uses $vars['value'] Source of the page
 *
 */
if (!$vars['src'] && $vars['value']) {
	$vars['src'] = $vars['value'];
}
unset($vars['value']);

$attributes = elgg_format_attributes($vars);

echo '<iframe ' . $attributes . '></iframe>';
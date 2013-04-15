<?php
/**
 * Display content-based tags
 *
 * Generally used in a sidebar. Does not work with groups currently.
 *
 * @uses $vars['subtypes']   Object subtype string or array of subtypes
 * @uses $vars['owner_guid'] The owner of the content being tagged
 * @uses $vars['limit']      The maxinum number of tags to display
 */

$format = elgg_extract('format', $vars, 'cloud');

$options = array(
	'type' => 'object',
	'subtype' => elgg_extract('subtypes', $vars, ELGG_ENTITIES_ANY_VALUE),
	'owner_guid' => elgg_extract('owner_guid', $vars, ELGG_ENTITIES_ANY_VALUE),
	'container_guid' => elgg_extract('container_guid', $vars, NULL),
	'threshold' => 0,
	'limit' => elgg_extract('limit', $vars, 50),
	'tag_name' => 'tags',
);

$title = elgg_echo('tagcloud:' . $format);
if (is_array($options['subtype']) && count($options['subtype']) > 1) {
	// we cannot provide links to tagged objects with multiple types
	$tag_data = elgg_get_tags($options);
	$cloud = elgg_view("output/tagcloud", array(
		'value' => $tag_data,
		'type' => 'object',
		'format' => $format
	));
} else {
	$tag_data = elgg_get_tags($options);
	$cloud = elgg_view("output/tagcloud", array(
		'value' => $tag_data,
		'type' => 'object',
		'subtype' => $options['subtype'],
		'format' => $format
	));
}

if (!$cloud) {
	return true;
}

// add a link to all site tags
$cloud .= '<p class="small">';
$cloud .= elgg_view_icon('tag');
$cloud .= elgg_view('output/url', array(
	'href' => 'tags',
	'text' => elgg_echo('tagcloud:allsitetags'),
	'is_trusted' => true,
	'class' => 'plm'
));
$cloud .= '</p>';


echo elgg_view_module('aside', $title, $cloud);

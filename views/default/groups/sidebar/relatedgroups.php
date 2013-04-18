<?php
/**
 * Related groups sidebar
 *
 * @package ElggRelatedGroups
 *
 * @uses $vars['entity'] Group entity
 * @uses $vars['limit']  The number of members to display
 */

$limit = elgg_extract('limit', $vars, 4);

$all_link = elgg_view('output/url', array(
	'href' => 'relatedgroups/owner/' . $vars['entity']->guid,
	'text' => '+',
	'title' => elgg_echo('relatedgroups:more'),
	'is_trusted' => true,
	'class' => 'aside-plus gwf tooltip sw pls t',
));

$params = array(
	'relationship' => 'related',
	'relationship_guid' => $vars['entity']->guid,
	'limit' => $limit,
	'types' => 'group',
	'full_view' => false,
	'pagination' => false
);

if (($vars['entity'] instanceof ElggGroup) && $vars['entity']->canEdit()) {
	$edit_link = elgg_view('output/url', array(
		'href' => 'relatedgroups/edit/' . $vars['entity']->guid,
		'text' => '&#9998;', // unicode 270E
		'title' => elgg_echo('relatedgroups:manage'),
		'is_trusted' => true,
		'class' => 'manage-relatedgroups aside-plus gwf tooltip sw t',
	));
} else {
	$edit_link = '';
}

$params['count'] = true;
$count = elgg_get_entities_from_relationship($params);

if ($count == 0) {
	if ($edit_link == '') return false;
	$all_link = $body = '';
} else {
	if ($count <= 4) $all_link = '';
	$params['count'] = false;
	$body = elgg_list_entities_from_relationship($params);
}

echo elgg_view_module('aside', elgg_echo('relatedgroups') . $all_link . $edit_link , $body);

<?php
/**
 * List most recent bookmarks on group profile page
 *
 * @package Bookmarks
 */

$group = elgg_get_page_owner_entity();

if ($group->bookmarks_enable != "yes") {
	return true;
}

elgg_push_context('widgets');
$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'bookmarks',
	'container_guid' => $group->guid,
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
));
$count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'bookmarks',
	'container_guid' => $group->guid,
	'limit' => 0,
	'count' => true,
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('bookmarks:none') . '</p>';
}

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('bookmarks:group'),
	'content' => $content,
	'all_link' => "bookmarks/group/$group->guid/all",
	'stats' => $count,
));

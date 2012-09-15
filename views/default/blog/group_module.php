<?php
/**
 * Group blog module
 */

$group = elgg_get_page_owner_entity();

if ($group->blog_enable == "no") {
	return true;
}

elgg_push_context('widgets');
$content = elgg_list_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'blog',
	'container_guid' => $group->guid,
	'metadata_name_value_pairs' => array('name' => 'status', 'value' => 'published'),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
));
$count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'blog',
	'container_guid' => $group->guid,
	'limit' => 0,
	'count' => true
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('blog:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "blog/add/$group->guid",
	'text' => elgg_echo('blog:write'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('blog:group'),
	'content' => $content,
	'all_link' => "blog/group/$group->guid/all",
	'add_link' => $new_link,
	'stats' => $count,
));

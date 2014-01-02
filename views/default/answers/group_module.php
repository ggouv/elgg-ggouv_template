<?php
/**
 * Group "widget" for answers
 */

$group = elgg_get_page_owner_entity();

if ($group->answers_enable == "no") {
	return true;
}

elgg_push_context('widgets');
$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'container_guid' => $group->guid,
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
));
$count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'container_guid' => $group->guid,
	'limit' => 0,
	'count' => true
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('answers:group:questions:none') . '</p>';
}

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('answers:group'),
	'content' => $content,
	'all_link' => "answers/group/$group->guid/all",
	'stats' => $count,
));
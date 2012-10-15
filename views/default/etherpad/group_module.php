<?php
/**
 * Group pages
 *
 * @package ElggPad
 */


$group = elgg_get_page_owner_entity();

if ($group->etherpad_enable == "no") {
	return true;
}

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtypes' => 'etherpad',
	'container_guid' => $group->guid,
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities($options);

$count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'etherpad',
	'container_guid' => $group->guid,
	'limit' => 0,
	'count' => true,
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('etherpad:none') . '</p>';
}

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('etherpad:group'),
	'content' => $content,
	'all_link' => "pad/group/$group->guid/all",
	'stats' => $count,
));

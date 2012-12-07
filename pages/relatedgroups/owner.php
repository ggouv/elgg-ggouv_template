<?php
/**
 * List of related group's related groups
 *
 * @package ElggRelatedGroups
 */

// access check for closed groups
group_gatekeeper();

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	forward('groups/all');
}

elgg_register_title_button();
elgg_set_context('groups');

$title = elgg_echo("relatedgroups:owner", array($owner->name));

elgg_push_breadcrumb(elgg_echo('groups'), "groups/all");
elgg_push_breadcrumb($owner->name, $owner->getURL());
elgg_push_breadcrumb(elgg_echo('relatedgroups'));

// List
$content = elgg_list_entities_from_relationship(array(
	'relationship' => 'related',
	'relationship_guid' => $owner->guid,
	'types' => 'group',
	'limit' => 24,
	'split_items' => 3,
	'full_view' => FALSE,
));
if (!$content) {
	$content = elgg_echo("relatedgroups:none");
}

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter' => '',
));
global $fb; $fb->info(elgg_get_context());
echo elgg_view_page($title, $body);

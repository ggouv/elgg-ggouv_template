<?php
/**
 * Elgg friends page
 *
 * @package Elgg.Core
 * @subpackage Social.Friends
 */

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	// unknown user so send away (@todo some sort of 404 error)
	forward();
}
$user_guid = elgg_get_logged_in_user_guid();

if ($owner->guid == $user_guid) {
	$title = elgg_echo("friends:title:following");
} else {
	$title = elgg_echo('members:title:following', array($owner->name));
}

elgg_push_breadcrumb(elgg_echo('friends:following'));
elgg_push_breadcrumb($owner->name);

$options = array(
	'relationship' => 'friend',
	'relationship_guid' => $owner->getGUID(),
	'inverse_relationship' => FALSE,
	'type' => 'user',
	'full_view' => FALSE,
	'split_items' => 3,
	'size' => 'small',
	'limit' => 24
);
$content = elgg_list_entities_from_relationship($options);
if (!$content) {
	$content = elgg_echo('friends:none');
}

$params = array(
	'content' => $content,
	'title' => $title,
	'filter' => false
);
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

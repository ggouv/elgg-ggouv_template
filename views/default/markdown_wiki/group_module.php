<?php
/**
 *	Elgg-markdown_wiki plugin
 *	@package elgg-markdown_wiki
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license GNU Affero General Public License, version 3 or late
 *	@link https://github.com/ManUtopiK/elgg-markdown_wiki
 *
 *	Elgg-markdown_wiki group module
 **/

$group = elgg_get_page_owner_entity();

if ($group->markdown_wiki_enable != "yes") {
	return true;
}

elgg_push_context('widgets');
$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'markdown_wiki',
	'container_guid' => $group->guid,
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
));
$count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'markdown_wiki',
	'container_guid' => $group->guid,
	'limit' => 0,
	'count' => true,
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('markdown_wiki:none') . '</p>';
}

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('markdown_wiki:group'),
	'content' => $content,
	'all_link' => "wiki/group/$group->guid/all",
	'stats' => $count,
));

<?php
/**
 * Manage related groups page
 *
 * @package ElggRelatedGroups
 */

elgg_load_library('elgg:relatedgroups');

$page_owner = elgg_get_page_owner_entity();

if(!($page_owner instanceof ElggGroup) || !$page_owner->canEdit()){
	forward($page_owner->getURL());
}

elgg_push_breadcrumb(elgg_echo('group'),'groups/all');
elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());

$title = elgg_echo('relatedgroups:manage');
elgg_push_breadcrumb($title);

$content = list_relatedgroups($page_owner);

$form_vars = array('class' => 'mtl');
$body_vars = array('group' => $page_owner);

$content .= elgg_view_form('relatedgroups/add', $form_vars, $body_vars);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => ''
));

echo elgg_view_page($title, $body);

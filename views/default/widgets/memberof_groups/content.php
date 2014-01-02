<?php
/**
 * Group activity widget
 */

$user_guid = elgg_get_logged_in_user_guid();

$sort = $vars['entity']->sort_items;

elgg_push_context('widgets');

if ($vars['entity']->num_display == 'all') $vars['entity']->num_display = 0;

$params = array(
	'type' => 'group',
	'subtype' => 0,
	'relationship' => 'member',
	'relationship_guid' => $user_guid,
	'order_by' => 'e.' . $sort . ' desc',
	'limit' => $vars['entity']->num_display,
	'pagination' => false,
	'full_view' => false,
	'size' => $vars['entity']->size_items,
	'list_class' => $vars['entity']->size_items,
);

if ($sort == 'abc') {
	global $CONFIG;
	$dbprefix = $CONFIG->dbprefix;
	$params = array_merge($params, array(
		'joins' => "JOIN {$dbprefix}groups_entity g ON g.guid = e.guid",
		'order_by' => 'LOWER(g.name) asc'
	));
}

$content = elgg_list_entities_from_relationship($params);

if (!$content) {
	$content .= '<p>' . elgg_echo('dashboard:widget:memberof_groups:nogroup', array(elgg_get_site_url().'groups/all')) . '</p>';
}

elgg_pop_context();

echo $content;

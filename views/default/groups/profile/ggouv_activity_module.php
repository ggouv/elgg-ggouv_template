<?php
/**
 * Groups latest activity
 *
 * @todo add people joining group to activity
 * 
 * @package Groups
 */

$group = $vars['entity'];
if (!$group) {
	return true;
}

$content = '<ul class="elgg-river elgg-list">' . elgg_view('graphics/ajax_loader', array('hidden' => false)) . '</ul>';

$title = elgg_echo('groups:activity');

$rss_link = elgg_view('output/url', array(
	'href' => "groups/activity/{$group->guid}/{$group->name}?view=rss",
	'title' => elgg_echo('feed:activity'),
	'text' => '<span class="elgg-icon elgg-icon-rss "></span>',
	'is_trusted' => true,
	'target' => '_blank'
));

echo '<li>';
echo elgg_view_module('info', '', $content, array(
	'header' => "<h3>$title</h3><ul class='activity-head-list'><li>$rss_link</li></ul>",
	'class' => 'elgg-module-group',
));
echo '</li>';

/*
$db_prefix = elgg_get_config('dbprefix');
$content = elgg_list_river(array(
	'limit' => 30,
	'pagination' => false,
	'joins' => array("JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid"),
	'wheres' => array("(e1.container_guid = $group->guid)"),
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('groups:activity:none') . '</p>';
}

$rss_link = elgg_view('output/url', array(
	'href' => "groups/activity/{$group->guid}/{$group->name}?view=rss",
	'title' => elgg_echo('feed:activity'),
	'text' => '<span class="elgg-icon elgg-icon-rss "></span>',
	'is_trusted' => true,
));

$title = elgg_echo('groups:activity');

echo '<li>';
echo elgg_view_module('info', '', $content, array(
	'header' => "<h3>$title</h3><ul class='activity-head-list'><li>$rss_link</li></ul>",
	'class' => 'elgg-module-group',
));
echo '</li>';*/

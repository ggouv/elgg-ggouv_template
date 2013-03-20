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

$content = '<ul class="column-header" data-network="elgg" data-river_type="entity_river"></ul>';

$content .= '<ul class="elgg-river elgg-list">' . elgg_view('graphics/ajax_loader', array('hidden' => false)) . '</ul>';

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

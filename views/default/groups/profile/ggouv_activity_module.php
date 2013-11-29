<?php
/**
 * Groups latest activity
 *
 * @todo add people joining group to activity
 *
 * @package Groups
 */

$group = $vars['entity'];
$group_guid = $group->getGUID();

if (!$group) {
	return true;
}

//$content = '<ul class="column-header" data-network="elgg" data-river_type="entity_river"></ul>';

//$content .= '<ul class="elgg-river elgg-list">' . elgg_view('graphics/ajax_loader', array('hidden' => false)) . '</ul>';


$rss_link = elgg_view('output/url', array(
	'href' => "groups/activity/{$group_guid}/{$group->name}?view=rss",
	'title' => elgg_echo('feed:group:activity'),
	'text' => '<span class="elgg-icon elgg-icon-rss "></span>',
	'is_trusted' => true,
	'class' => 'tooltip n',
	'target' => '_blank'
));

/*echo elgg_view_module('info', '', $content, array(
	'header' => "<h3>$title</h3><ul class='activity-head-list'><li>$rss_link</li></ul>",
	'class' => 'elgg-module-group',
));*/
$activity_header = elgg_view('page/layouts/content/deck_river_column_header', array(
	'column_settings' => array(
		'network' => 'elgg',
		'type' => 'group',
		'title' => elgg_echo('river:group_activity'),
		'data' => array(
			'data-network' => 'elgg',
			'data-river_type' => 'entity_river',
			'data-entity' => $group_guid
		)
	)
));
$mentions_header = elgg_view('page/layouts/content/deck_river_column_header', array(
	'column_settings' => array(
		'network' => 'elgg',
		'type' => 'group_mention',
		'title' => elgg_echo('river:group_mentions'),
		'data' => array(
			'data-network' => 'elgg',
			'data-river_type' => 'entity_mention',
			'data-entity' => $group_guid
		)
	)
));

$loader = elgg_view('graphics/ajax_loader', array('hidden' => false));

echo <<<HTML
<div class="elgg-body">
	<ul class="elgg-menu elgg-menu-filter elgg-menu-deck-river elgg-menu-filter-default elgg-tabs">
		<li class="elgg-menu-item-group-activity elgg-state-selected">
			<a href="#{$group_guid}-activity-river"><span class="gwf">w</span></a>
		</li>
		<li class="elgg-menu-item-group-mentions">
			<a href="#{$group_guid}-mentions-river"><span class="gwf">!</span></a>
		</li>
	</ul>
	<ul class="elgg-body">
		<li id="{$group_guid}-activity-river" class="column-river">
			$activity_header
			<ul class="elgg-river elgg-list">
				$loader
			</ul>
			<div class="river-to-top hidden link t25 gwfb pas"></div>
		</li>
		<li id="{$group_guid}-mentions-river" class="column-river hidden">
			$mentions_header
			<ul class="elgg-river elgg-list">
				$loader
			</ul>
			<div class="river-to-top hidden link t25 gwfb pas"></div>
		</li>
	</ul>
</div>
HTML;


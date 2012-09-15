<?php
/**
 * All groups listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 */

$tabs = array(
	'newest' => array(
		'text' => elgg_echo('groups:newest'),
		'href' => 'groups/all?filter=newest',
		'priority' => 200,
	),
	'popular' => array(
		'text' => elgg_echo('groups:popular'),
		'href' => 'groups/all?filter=popular',
		'priority' => 300,
	),
	'metagroups' => array(
		'text' => elgg_echo('groups:metagroups'),
		'href' => 'groups/all?filter=metagroups',
		'priority' => 400,
	),
	'typogroups' => array(
		'text' => elgg_echo('groups:typogroups'),
		'href' => 'groups/all?filter=typogroups',
		'priority' => 500,
	),
	'localgroups' => array(
		'text' => elgg_echo('groups:localgroups'),
		'href' => 'groups/all?filter=localgroups',
		'priority' => 600,
	),
/*	'discussion' => array(
		'text' => elgg_echo('groups:latestdiscussion'),
		'href' => 'groups/all?filter=discussion',
		'priority' => 400,
	),*/
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	if ($vars['selected'] == $name) {
		$tab['selected'] = true;
	}

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

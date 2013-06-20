<?php
/**
 * Members navigation
 */

$tabs = array(
	'newest' => array(
		'title' => elgg_echo('members:label:newest'),
		'url' => "members/newest",
		'selected' => $vars['selected'] == 'newest',
	),
	/*'popular' => array(
		'title' => elgg_echo('members:label:popular'),
		'url' => "members/popular",
		'selected' => $vars['selected'] == 'popular',
	),*/
	'random' => array(
		'title' => elgg_echo('members:label:random'),
		'url' => "members/random",
		'selected' => $vars['selected'] == 'random',
	),
	'online' => array(
		'title' => elgg_echo('members:label:online'),
		'url' => "members/online",
		'selected' => $vars['selected'] == 'online',
	),
);

echo elgg_view('navigation/tabs', array('tabs' => $tabs));

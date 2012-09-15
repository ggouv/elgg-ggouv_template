<?php
/**
 * Display a location
 *
 * @uses $vars['entity'] The ElggEntity that has a location
 * @uses $vars['value']  The location string if the entity is not passed
 */

if (isset($vars['entity'])) {
	$vars['value'] = $vars['entity']->location;
	unset($vars['entity']);

/*http://localhost/%7Emama/ggouv/ggouv/groups/profile/51/test
//echo elgg_view('output/tag', $vars);*/
$url = elgg_get_site_url() . 'groups/profile/' . $vars['entity']->location;
echo elgg_view('output/url', array(
	'href' => $url,
	'text' => $vars['value'],
	'rel' => 'group',
));

}
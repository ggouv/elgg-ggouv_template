<?php
/**
 *	Elgg-ggouv_template plugin
 *	@package elgg-ggouv_template
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license GNU Affero General Public License, version 3 or late
 *	@link https://github.com/ggouv/elgg-ggouv_template
 **/


echo '<div class="spotlight clearfloat row">';

echo '<div class="spotlight-column span3">';

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_get_site_entity()->name,
	'items' => array(
		'#about' => elgg_echo('ggouv_template:about'),
		'#conditions' => elgg_echo('ggouv_template:conditions'),
		'#privacy' => elgg_echo('ggouv_template:privacy'),
		'#assembly' => elgg_echo('ggouv_template:assembly'),
		'#blog' => elgg_echo('ggouv_template:blog'),
	),
));

echo '</div><div class="spotlight-column span3">';

if ($url = elgg_get_plugin_setting('group_of_help', 'elgg-ggouv_template')) $help[$url] = elgg_echo('ggouv_template:dev:group_of_help');
if ($url = elgg_get_plugin_setting('wiki_of_help', 'elgg-ggouv_template')) $help[$url] = elgg_echo('ggouv_template:dev:wiki_of_help');
if ($url = elgg_get_plugin_setting('faq_of_help', 'elgg-ggouv_template')) $help[$url] = elgg_echo('ggouv_template:dev:faq_of_help');
echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('help'),
	'items' => $help
));

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('ggouv_template:spotlight:contact'),
	'items' => array(
		'mailto:contact@ggouv.fr' => elgg_echo('ggouv_template:contact:mail'),
		'irc://irc.freenode.net/ggouv.fr' => elgg_echo('ggouv_template:contact:irc'),
	),
));

echo '</div><div class="spotlight-column span3">';

if ($url = elgg_get_plugin_setting('group_of_dev', 'elgg-ggouv_template')) $dev[$url] = elgg_echo('ggouv_template:dev:group_of_dev');
if ($url = elgg_get_plugin_setting('ideas_of_dev', 'elgg-ggouv_template')) $dev[$url] = elgg_echo('ggouv_template:dev:ideas_of_dev');
if ($url = elgg_get_plugin_setting('bugs_of_dev', 'elgg-ggouv_template')) $dev[$url] = elgg_echo('ggouv_template:dev:bugs_of_dev');
$dev['https://github.com/ggouv'] = elgg_echo('ggouv_template:dev:repo');
echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('ggouv_template:spotlight:dev'),
	'items' => $dev,
));

echo '</div><div class="spotlight-column span3">';

$stat = array(
	'members' => get_number_users(),
	'online' => find_active_users(600, 0, 0, true),
	'groups' => elgg_get_entities(array('type' => 'group', 'subtype' => 0, 'count' => true, 'limit' => 0)),
	'pages' => elgg_get_entities(array('type' => 'object', 'subtype' => 'markdown_wiki', 'count' => true, 'limit' => 0)),
	'blogs' => elgg_get_entities(array('type' => 'object', 'subtype' => 'blog', 'count' => true, 'limit' => 0)),
	'ideas' => elgg_get_entities(array('type' => 'object', 'subtype' => 'idea', 'count' => true, 'limit' => 0)),
	'workflow_card' => elgg_get_entities(array('type' => 'object', 'subtype' => 'workflow_card', 'count' => true, 'limit' => 0)),
	'pads' => elgg_get_entities(array('type' => 'object', 'subtype' => 'etherpad', 'count' => true, 'limit' => 0)),
	//'file' => elgg_get_entities(array('type' => 'object', 'subtype' => 'file', 'count' => true, 'limit' => 0)),
);

foreach ($stat as $key => $value) {
	if (!$value) $stat[$key] = 0;
}

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('ggouv_template:spotlight:stats'),
	'items' => array(
		'members' => $stat['members'] . ' ' . elgg_echo('members'),
		'members/online' => $stat['online'] . ' ' . elgg_echo('members:label:online'),
		'groups/all' => $stat['groups'] . ' ' . elgg_echo('item:group'),
		'brainstorm/all' => $stat['ideas'] . ' ' . elgg_echo('item:object:idea'),
		'workflow/all' => $stat['workflow_card'] . ' ' . elgg_echo('item:object:workflow_card'),
		'wiki/all' => $stat['pages'] . ' ' . elgg_echo('item:object:markdown_wiki'),
		'blog/all' => $stat['blogs'] . ' ' . elgg_echo('item:object:blog'),
		'pad/all' => $stat['pads'] . ' ' . elgg_echo('item:object:etherpad'),
		//'file/all' => $items['file'] . ' ' . elgg_echo('item:object:file'),
		//'tidypics/all' => $items['photos'] . ' ' . elgg_echo('item:object:photo'),
	),
));

echo '</div>';

echo '<span class="elgg-icon elgg-icon-delete"></span>';

echo '</div>';
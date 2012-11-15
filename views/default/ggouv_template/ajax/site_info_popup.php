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
	'title' => elgg_echo('news:news'),
	'items' => array(
		//'https://n-1.cc/pg/pages/view/9385/' => elgg_echo('news:features'),
	),
));

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('about:lorea'),
	'items' => array(
		//'https://lorea.org/' => elgg_echo('about:blog'),
		//'https://n-1.cc/pg/groups/7826/lorea/' => elgg_echo('about:group'),
		//elgg_echo('lorea:sustainability:url') => elgg_echo('lorea:sustainability'),
	),
));

echo '</div><div class="spotlight-column span3">';

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('contact:contact'),
	'items' => array(
		//'https://lists.rhizomatik.net/listinfo/mycelia-community' => elgg_echo('contact:mailing'),
	),
));

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('help:help'),
	'items' => array(
		//'https://n-1.cc/pg/faq/' => elgg_echo('help:faq'),
		//'https://n-1.cc/pg/dokuwiki/9394' => elgg_echo('help:howto'),
		//'https://n-1.cc/pg/groups/9394/help/' => elgg_echo('help:group'),
	),
));

echo '</div><div class="spotlight-column span3">';

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('dev:dev'),
	'items' => array(
		//'https://n-1.cc/pg/groups/6217/bughunting/' => elgg_echo('dev:bughunting'),
		//'https://n-1.cc/pg/groups/5241/testers-de-la-red-social/' => elgg_echo('dev:testers'),
		//'https://dev18.lorea.org/' => elgg_echo('dev:network'),
		'https://github.com/ggouv'=> elgg_echo('dev:repo'),
	),
));

echo '</div><div class="spotlight-column span3">';

$items = array(
	'members' => get_number_users(),
	'online' => find_active_users(600, 0, 0, true),
	'groups' => elgg_get_entities(array('type' => 'group', 'count' => true, 'limit' => 0)),
	'pages' => elgg_get_entities(array('type' => 'object', 'subtype' => 'markdown_wiki', 'count' => true, 'limit' => 0)),
	'blogs' => elgg_get_entities(array('type' => 'object', 'subtype' => 'blog', 'count' => true, 'limit' => 0)),
	'ideas' => elgg_get_entities(array('type' => 'object', 'subtype' => 'idea', 'count' => true, 'limit' => 0)),
	'workflow_card' => elgg_get_entities(array('type' => 'object', 'subtype' => 'workflow_card', 'count' => true, 'limit' => 0)),
	//'file' => elgg_get_entities(array('type' => 'object', 'subtype' => 'file', 'count' => true, 'limit' => 0)),
);

foreach ($items as $item) {
	global $fb; $fb->info($item);//if ($item)
}

echo elgg_view('page/elements/spotlight', array(
	'title' => elgg_echo('stats:stats'),
	'items' => array(
		'members' => $items['members'] . ' ' . elgg_echo('members'),
		'members/online' => $items['online'] . ' ' . elgg_echo('members:label:online'),
		'groups/all' => $items['groups'] . ' ' . elgg_echo('item:group'),
		'brainstorm/all' => $items['ideas'] . ' ' . elgg_echo('item:idea'),
		'workflow/all' => $items['workflow_card'] . ' ' . elgg_echo('item:workflow_card'),
		'pages/all' => $items['pages'] . ' ' . elgg_echo('item:object:page'),
		'blog/all' => $items['blogs'] . ' ' . elgg_echo('item:object:blog'),
		//'file/all' => $items['file'] . ' ' . elgg_echo('item:object:file'),
		//'tidypics/all' => $items['photos'] . ' ' . elgg_echo('item:object:photo'),
	),
));

echo '</div>';

echo '<span class="elgg-icon elgg-icon-delete"></span>';

echo '</div>';
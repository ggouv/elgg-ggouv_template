<?php

$page_top = elgg_get_plugin_setting('page_top_for_home', 'elgg_ggouv_template');
$page_top_entity = get_entity($page_top);

$title[] = elgg_view('output/longtext', array('value' => $page_top_entity['title']));
$desc[] = elgg_view('output/longtext', array('value' => $page_top_entity['description']));

$pages = elgg_get_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'page',
	'metadata_name' => 'parent_guid',
	'metadata_value' => $page_top,
));
foreach( $pages as $page) {
	$title[] = elgg_view('output/longtext', array('value' => $page['title']));
	$desc[] = elgg_view('output/longtext', array('value' => $page['description']));
}

$content = '<div class="background-nolog-main"></div><div id="cursor"></div>';
$content .= '<ul class="title"><li class="pal">' . implode('</li><li class="pal">', $title) . '</li></ul>';
$content .= '<ul class="content"><li>' . implode('</li><li>', $desc) . '</li></ul>';

$params = array(
		'content' => $content,
);
echo elgg_view_layout('one_column', $params);
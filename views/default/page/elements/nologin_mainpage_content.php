<?php

elgg_load_css('css.nologin.mainpage');
elgg_load_js('js.nologin.mainpage');
elgg_load_js('jquery.scrollTo');
elgg_load_js('carrousel');
elgg_load_library('markdown_wiki:utilities');

// get text
$page_guid = elgg_get_plugin_setting('markdown_wiki_page_for_home', 'elgg-ggouv_template');
$page = get_entity($page_guid);
if (!$page) {
	return;
}

$annotation = $page->getAnnotations('markdown_wiki', 1, 0, 'desc');
$value = unserialize($annotation[0]->value);
$text = $value['text'];

// parse title
$return = preg_match_all('/^# (.*)/m', $text, $matches);
foreach ($matches[1] as $item) {
	$sections['title'][] = elgg_view('output/longtext', array('value' => trim($item)));
}
$text = preg_replace('/^# (.*)/m', '%%%', $text);

// parse section
//$return = preg_match_all('/%%%# .*\n(.*)(?:@@@|$)/sU', $text, $matches);
$matches = explode('%%%', $text);
unset($matches[0]);

foreach ($matches as $key => $item2) {
	//$item2 = preg_replace('/^# (.*)/m', '', $item2);
	//global $fb; $fb->info($item2);
	$sub_sections = array();
	$return = preg_match_all('/^## (.*)/m', $item2, $matches3);
	foreach ($matches3[1] as $subkey => $item3) {
		$sub_sections[$subkey]['title'] = trim($item3);
	}
	$matches4 = preg_replace('/^## (.*)/m', '%%%', $item2);
	$matches4 = explode('%%%', $matches4);
	unset($matches4[0]);
	$matches4 = array_values($matches4);

	//$return = preg_match_all('/## .*\n(.*)(?:## |$)/sU', $item2, $matches4);
	foreach ($matches4 as $subkey => $item4) {
		$sub_sections[$subkey]['text'] = elgg_view('output/longtext', array('value' => trim($item4)));
	}

	$html = '';
	if ($sub_sections) {
		$html = "<div class='elgg-menu-owner-block slidewrap{$key}'><ul class='slider'>";
		foreach ($sub_sections as $sub_section) {
			$html .= '<li class="slide"><h2 class="slidehed">' . $sub_section['title'] . '</h2>' . $sub_section['text'] . '</li>';
		}
		$html .= "</ul></div>";
		$sections['text'][] = $html;
	} else {
	//$return = preg_match('/^(.*)(?:##|$)/sU', $item2, $matches2);
	$sections['text'][] = elgg_view('output/longtext', array('value' => trim($item2)));
	}
}

$content = '<div class="background-nolog-main"></div><div id="cursor" class="t"></div>';
$content .= '<ul class="title" style="opacity: 0;"><li class="">' . implode('</li><li class="pal">', $sections['title']) . '</li></ul>';
$content .= '<ul class="content" style="opacity: 0;"><li>' . implode('</li><li>', $sections['text']) . '</li></ul>';

$params = array(
		'content' => $content,
);

echo elgg_view_layout('one_column', $params);


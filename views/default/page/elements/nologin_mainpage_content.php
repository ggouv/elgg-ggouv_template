<?php

elgg_load_library('markdown_wiki:utilities');

// get page
$page_guid = elgg_get_plugin_setting('markdown_wiki_page_for_home', 'elgg-ggouv_template');
$page = get_entity($page_guid);
if (!$page) {
	return;
}

// parse page
$annotation = $page->getAnnotations('markdown_wiki', 1, 0, 'desc');
$value = unserialize($annotation[0]->value);
$text = $value['text'];
$sections = array();

$text = preg_replace('/^# /m', '%%%', $text); // use %%% as a marker to delimit section with only one # (title)
$text = explode('%%%', $text);
unset($text[0]); // delete content before first title1. Used to add notes.

foreach ($text as $key => $section) {
	// parse title 1
	$sections[$key]['title'] = strtok($section, "\n");

	// parse text
	$sections[$key]['text'] = substr($section, strpos($section, "\n")+1);
}

// display page
$content = '<div id="section1" class="width80"><div class="row-fluid"><div class="span8">' .
	elgg_view('output/longtext', array(
		'value' => trim($sections[1]['text']),
		'class' => ''
	)) . '</div>';

$content .= '<div class="span4 visible-desktop"><div>A faire. Un slideshow avec la photo de personnalité qui ont dit des phrases percutantes correspondant à la thématique de ggouv : démocratie, incompétence et inertie des politiques, le changement qu apporte internet, notre façon de travailler ensemble...<br/>On pourrait même imaginer que ce slideshow soit créer à partir de quelques propositions faites dans un remue-méniges, et dans lequel chacun pourrait voter pour les citations qui lui plaisent le mieux...</div></div></div></div>';

$content .= '<div class="signup"><a class="gwfa" href="' . elgg_get_site_url() . 'signup">' . elgg_echo('ggouv:register:contamined') . '</a></div>';

$content .= '<div id="section2"><div class="pal width80"><div class="row-fluid"><div class="span8 pvl mvm"><h2>' . $sections[2]['title'] . '</h2>' .
	elgg_view('output/longtext', array(
		'value' => trim($sections[2]['text']),
		'class' => ''
	)) . '</div>';

$content .= '<div class="span4 visible-desktop"><div>A faire. Il faudrait faire un groupe qui serait la raison d être (les objectifs globaux) de ggouv. Ce que veulent les «gitoyens».<br/>Lors de la première inscription, une tâche demandant d aller dépenser ses 10 pointes de votes dans ce groupe serait assignée. On pourrait mettre ici les idées les plus votées de ce remue-méniges. A voir.</div></div></div></div></div>';

$content .= '<div id="section3"><div class="pal width80"><h2 class="pbl">' . $sections[3]['title'] . '</h2>' .
	elgg_view('output/longtext', array(
		'value' => trim($sections[3]['text']),
		'class' => ''
	)) . '<ul>';
/*foreach ($sections[3]['subsections'] as $section3) {
	$content .= '<li class="pal"><h3>' . $section3['title'] . '</h3>' . elgg_view('output/longtext', array(
		'value' => '### ' . $section3['title'] . trim($section3['text']),
		'class' => ''
	)) . '</li>';
}*/
$content .='</ul></div></div>';

$content .= '<div class="signup"><a class="gwfa" href="' . elgg_get_site_url() . 'signup">' . elgg_echo('ggouv:register:wannaplay') . '</a></div>';

$content .='<div id="footer-home"><div class="row-fluid pal width80">A faire. Le footer...</div></div>';

echo $content;

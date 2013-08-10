<?php

elgg_load_library('markdown_wiki:utilities');

// get page
$text = get_markdown_wiki_text_from_guid(elgg_get_plugin_setting('markdown_wiki_page_for_home', 'elgg-ggouv_template'));
if (!$text) {
	return;
}

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

// section 1
$content = '<div id="section1" class="width80" data-homepage="true"><div class="row-fluid">';

	$content .= '<div class="span8">' .
		elgg_view('output/longtext', array(
			'value' => trim($sections[1]['text']),
			'class' => ''
		)) . '</div>';

	// slideshow
	$content .= '<div class="span4 visible-desktop"><div><ul id="slideshow" class="hidden">';
	$slideshow_guid = elgg_get_plugin_setting('slideshow_home', 'elgg-ggouv_template');
	if ($slideshow_guid) {
		elgg_load_library('answers:utilities');
		$slides = answers_get_sorted_question_answers(get_entity($slideshow_guid));
		foreach ($slides as $key => $slide) {
			$desc = $your_array = explode(PHP_EOL, $slide->description);
			preg_match('/\!\[(.*)\]\((.*)\)/', $desc[0], $img);
			preg_match('/### (.*)/', $desc[1], $quote);
			preg_match('/([^|]*)\|(.*)/', $desc[2], $author);
			if ($img[1] && $img[2] && $quote[1] && $author[1] && $author[2] ) {
				$content .= '<li><img src="' . $img[2] . '" alt="' . $img[1] . '" />';
				$content .= '<div class="caption"><div class="pam"><p>' . $quote[1] . '</p><span class="prm mrs">' . trim($author[1]) . '</span>' . $author[2] . '</div></div></li>';
			}
		}
	}

	$content .= '</ul></div></div>';

$content .= '</div></div>';


$content .= '<div class="signup"><a class="gwfa" href="' . elgg_get_site_url() . 'signup">' . elgg_echo('ggouv:register:contamined') . '</a></div>';


// section 2
$content .= '<div id="section2"><div class="pal width80">';

$content .= '<div class="row-fluid"><div class="span8 pvl mvm"><h2>' . $sections[2]['title'] . '</h2>' .
	elgg_view('output/longtext', array(
		'value' => trim($sections[2]['text']),
		'class' => ''
	)) . '</div>';

	// objectives_home
	$objectives_guid = elgg_get_plugin_setting('objectives_home', 'elgg-ggouv_template');
	if ($objectives_guid) {
		$content .= '<div class="span4 visible-desktop mtl ptl phl pbm"><h1>' . elgg_echo('ggouv:home:objectives') . '</h1>';
		$content .= elgg_list_entities_from_annotation_calculation(array(
			'type' => 'object',
			'subtype' => 'idea',
			'container_guid' => $objectives_guid,
			'annotation_names' => 'point',
			'order_by' => 'annotation_calculation desc',
			'full_view' => 'module',
			'item_class' => 'elgg-item-idea',
			'list_class' => 'module-idea-list ptl',
			'limit' => 20,
			'pagination' => false
		));
		$content .= '</div>';
	}

$content .= '</div></div></div>';

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

// footer
$content .='<div id="footer-home"><div class="row-fluid"><div class=" pal width80">';

if (!$url_blog = elgg_get_plugin_setting('blog_of_site', 'elgg-ggouv_template')) $url_blog = '#blog';
if (!$url_legal_mentions = elgg_get_plugin_setting('legal_mentions', 'elgg-ggouv_template')) $url_legal_mentions = '#legal_mentions';
if (!$url = elgg_get_plugin_setting('wiki_of_help', 'elgg-ggouv_template')) $url_help = '#help';
$content .= elgg_view('page/elements/spotlight', array(
	'title' => elgg_get_site_entity()->name,
	'items' => array(
		//'#about' => elgg_echo('ggouv_template:about'),
		$url_legal_mentions => elgg_echo('ggouv_template:legal_mentions'),
		//'#conditions' => elgg_echo('ggouv_template:conditions'),
		//'#privacy' => elgg_echo('ggouv_template:privacy'),
		//'#assembly' => elgg_echo('ggouv_template:assembly'),
		$url_blog => elgg_echo('ggouv_template:blog'),
		$url_help => elgg_echo('ggouv_template:dev:wiki_of_help'),
	),
));

$content .= '</div></div></div>';

echo $content;

?>

<script language="Javascript">
	$(document).ready(function() {
		$('body').addClass('homepage');
		$("#slideshow").removeClass('hidden').responsiveSlides({ // hidden class to prevent ugly effect
			nav: true,
			timeout: 20000, // 20 seconds
			pause: true,
			prevText: '<span class="t">&larr;</span>',
			nextText: '<span class="t">&rarr;</span>'
		});
	});
</script>

<?php
/**
 * Elgg-deck_river plugin settings
 */

// set default value

if (!isset($vars['entity']->markdown_wiki_page_for_home)) {
	$vars['entity']->markdown_wiki_page_for_home = '';
}

if (!isset($vars['entity']->markdown_wiki_page_for_translation)) {
	$vars['entity']->markdown_wiki_page_for_translation = '';
}

if (!isset($vars['entity']->bot)) {
	$vars['entity']->bot = '';
}


$markdown_wiki_page_for_home_string = elgg_echo('elgg_ggouv_template:markdown_wiki_page_for_home');
$markdown_wiki_page_for_home_view = elgg_view('input/text', array(
	'name' => 'params[markdown_wiki_page_for_home]',
	'value' => $vars['entity']->markdown_wiki_page_for_home,
	'class' => 'elgg-input-thin',
));

$markdown_wiki_page_for_translation_string = elgg_echo('elgg_ggouv_template:markdown_wiki_page_for_translation');
$markdown_wiki_page_for_translation_view = elgg_view('input/text', array(
	'name' => 'params[markdown_wiki_page_for_translation]',
	'value' => $vars['entity']->markdown_wiki_page_for_translation,
	'class' => 'elgg-input-thin',
));

$bot_string = elgg_echo('elgg_ggouv_template:bot_string');
$bot_view = elgg_view('input/text', array(
	'name' => 'params[bot]',
	'value' => $vars['entity']->bot,
	'class' => 'elgg-input-thin',
));

echo <<<__HTML
<br />
<div><label>$markdown_wiki_page_for_home_string</label><br />$markdown_wiki_page_for_home_view</div>
<br />
<div><label>$markdown_wiki_page_for_translation_string</label><br />$markdown_wiki_page_for_translation_view</div>
<br />
<div><label>$bot_string</label><br />$bot_view</div>
__HTML;

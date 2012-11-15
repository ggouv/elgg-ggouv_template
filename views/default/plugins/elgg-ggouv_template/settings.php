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


$markdown_wiki_page_for_home_string = elgg_echo('ggouv_template:markdown_wiki_page_for_home');
$markdown_wiki_page_for_home_view = elgg_view('input/text', array(
	'name' => 'params[markdown_wiki_page_for_home]',
	'value' => $vars['entity']->markdown_wiki_page_for_home,
	'class' => 'elgg-input-thin',
));

$bot_string = elgg_echo('ggouv_template:bot_string');
$bot_view = elgg_view('input/text', array(
	'name' => 'params[bot]',
	'value' => $vars['entity']->bot,
	'class' => 'elgg-input-thin',
));

$piwik_tracker_string = elgg_echo('ggouv_template:piwik_tracker');
$piwik_tracker_view = elgg_view('input/text', array(
	'name' => 'params[piwik_tracker]',
	'value' => $vars['entity']->piwik_tracker,
	'class' => 'elgg-input-thin'
));

echo <<<__HTML
<br />
<div><label>$markdown_wiki_page_for_home_string</label><br />$markdown_wiki_page_for_home_view</div>
<br />
<div><label>$bot_string</label><br />$bot_view</div>
<br />
<div><label>$piwik_tracker_string</label><br />$piwik_tracker_view</div>
__HTML;

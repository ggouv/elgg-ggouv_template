<?php
/**
 * Elgg-deck_river plugin settings
 */

// set default value




$markdown_wiki_page_for_home_string = elgg_echo('ggouv_template:markdown_wiki_page_for_home');
$markdown_wiki_page_for_home_view = elgg_view('input/text', array(
	'name' => 'params[markdown_wiki_page_for_home]',
	'value' => $vars['entity']->markdown_wiki_page_for_home,
	'class' => 'elgg-input-thin',
));

$group_of_help_string = elgg_echo('ggouv_template:group_of_help');
$group_of_help_view = elgg_view('input/text', array(
	'name' => 'params[group_of_help]',
	'value' => $vars['entity']->group_of_help,
	'class' => 'elgg-input-thin',
));

$wiki_of_help_string = elgg_echo('ggouv_template:wiki_of_help');
$wiki_of_help_view = elgg_view('input/text', array(
	'name' => 'params[wiki_of_help]',
	'value' => $vars['entity']->wiki_of_help,
	'class' => 'elgg-input-thin',
));

$faq_of_help_string = elgg_echo('ggouv_template:faq_of_help');
$faq_of_help_view = elgg_view('input/text', array(
	'name' => 'params[faq_of_help]',
	'value' => $vars['entity']->faq_of_help,
	'class' => 'elgg-input-thin',
));

$group_of_dev_string = elgg_echo('ggouv_template:group_of_dev');
$group_of_dev_view = elgg_view('input/text', array(
	'name' => 'params[group_of_dev]',
	'value' => $vars['entity']->group_of_dev,
	'class' => 'elgg-input-thin',
));

$ideas_of_dev_string = elgg_echo('ggouv_template:ideas_of_dev');
$ideas_of_dev_view = elgg_view('input/text', array(
	'name' => 'params[ideas_of_dev]',
	'value' => $vars['entity']->ideas_of_dev,
	'class' => 'elgg-input-thin',
));

$bugs_of_dev_string = elgg_echo('ggouv_template:bugs_of_dev');
$bugs_of_dev_view = elgg_view('input/text', array(
	'name' => 'params[bugs_of_dev]',
	'value' => $vars['entity']->bugs_of_dev,
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
<div><label>$group_of_help_string</label><br />$group_of_help_view</div>
<br />
<div><label>$wiki_of_help_string</label><br />$wiki_of_help_view</div>
<br />
<div><label>$faq_of_help_string</label><br />$faq_of_help_view</div>
<br />
<div><label>$group_of_dev_string</label><br />$group_of_dev_view</div>
<br />
<div><label>$ideas_of_dev_string</label><br />$ideas_of_dev_view</div>
<br />
<div><label>$bugs_of_dev_string</label><br />$bugs_of_dev_view</div>
<br />
<hr>
<br />
<div><label>$bot_string</label><br />$bot_view</div>
<br />
<div><label>$piwik_tracker_string</label><br />$piwik_tracker_view</div>
__HTML;

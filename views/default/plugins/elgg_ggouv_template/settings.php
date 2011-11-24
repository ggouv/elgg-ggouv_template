<?php
/**
 * Elgg-deck_river plugin settings
 */

// set default value

if (!isset($vars['entity']->page_top_for_home)) {
	$vars['entity']->page_top_for_home = '';
}

$page_top_for_home_string = elgg_echo('elgg_ggouv_template:page_top_for_home');
$page_top_for_home_view = elgg_view('input/text', array(
	'name' => 'params[page_top_for_home]',
	'value' => $vars['entity']->page_top_for_home,
	'class' => 'elgg-input-thin',
));

echo <<<__HTML
<br />
<div><label>$page_top_for_home_string</label><br />$page_top_for_home_view</div>
__HTML;

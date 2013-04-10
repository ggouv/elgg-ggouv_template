<?php
/**
 * Brainstorm search and add form
 *
 */
$group = elgg_get_page_owner_entity();

if (!$description = $group->brainstorm_description) $description = '';
if (!$question = $group->brainstorm_question) $question = elgg_echo('brainstorm:search');

echo elgg_view('output/longtext', array('value' => $description));

echo '<h3 class="mvm">' . $question . '</h3>';

echo elgg_view('input/text140', array(
	'name' => 'body',
	'class' => 'mbl',
	'id' => 'brainstorm-textarea',
	'id_count' => 'brainstorm-characters-remaining',
));

echo '<div id="brainstorm-search-response"></div>';
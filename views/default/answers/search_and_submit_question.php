<?php
/**
 * Answers plugin search and submit question form
 *
 */

echo '<h3 class="mbs">' . elgg_echo('answers:search_and_submit') . '</h3>';

echo elgg_view('input/text140', array(
	'name' => 'body',
	'class' => 'mbm',
	'id' => 'answers-textarea',
	'id_count' => 'answers-characters-remaining',
));

echo '<div id="answers-search-response"></div>';
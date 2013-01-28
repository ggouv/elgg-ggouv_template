<?php
/**
 * Displays a toggable comment area for questions and answers
 * 
 * @uses $vars['entity'] 
 */
$vars['viewType'] = 'tiny';

$id = "answers-comment-" . $vars['entity']->getGUID();
$form = elgg_view_form('comments/add', array('class' => 'tiny'), $vars);
$link = elgg_view('output/url', array(
	'text' => elgg_echo("generic_comments:add"),
	'href' => "#$id",
	'class' => "t mll add-comment",
	'rel' => "toggle",
));

echo <<<HTML
<div class="clearfloat">$link</div>
<div id="$id" class="hidden clearfloat">
	$form
</div>
HTML;

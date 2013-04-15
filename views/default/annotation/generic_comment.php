<?php
/**
 * Elgg generic comment view
 *
 * @uses $vars['annotation']  ElggAnnotation object
 * @uses $vars['full_view']   Display fill view or brief view
 */

if (!isset($vars['annotation'])) {
	return true;
}

$full_view = elgg_extract('full_view', $vars, true);

$comment = $vars['annotation'];

$entity = get_entity($comment->entity_guid);
$commenter = get_user($comment->owner_guid);
if (!$entity || !$commenter) {
	return true;
}

$friendlytime = elgg_view_friendly_time($comment->time_created);

$commenter_icon = elgg_view_entity_icon($commenter, 'tiny');
$commenter_link = "<a href=\"{$commenter->getURL()}\">$commenter->name</a>";

$entity_title = $entity->title ? $entity->title : elgg_echo('untitled');
$entity_link = "<a href=\"{$entity->getURL()}\">$entity_title</a>";

if ($full_view === true) {
	$menu = elgg_view_menu('annotation', array(
		'annotation' => $comment,
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz float-alt',
	));

	$comment_text = elgg_view('output/longtext', array('value' => $comment->value));

	$body = <<<HTML
<div class="mbn">
	$menu
	$commenter_link
	<span class="elgg-subtext">
		$friendlytime
	</span>
	$comment_text
</div>
HTML;

	echo elgg_view_image_block($commenter_icon, $body);

} else if ($full_view === 'tiny') {
	$menu = elgg_view_menu('annotation', array(
		'annotation' => $comment,
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz float-alt',
	));

	$comment_text = elgg_view('output/longtext', array(
		'value' => $comment->value,
		'class' => 'man'
	));

	$body = <<<HTML
$comment_text — $commenter_link
<span class="elgg-subtext">
	$friendlytime
</span>
$menu
HTML;

	echo $body;
} else {
	// brief view

	$excerpt = elgg_get_excerpt($comment->value, 140);
	$by = elgg_echo('by');
	$in = elgg_echo('in');

	$body = <<<HTML
<span class="elgg-subtext">
	$by $commenter_link $in $entity_link $friendlytime
</span>
<div class="brief-comment pts">
	$excerpt
</div>
HTML;

	echo elgg_view_image_block($commenter_icon, $body);
}

<?php
/**
 * List comments with optional add form
 *
 * @uses $vars['entity']        ElggEntity
 * @uses $vars['show_add_form'] Display add form or not
 * @uses $vars['id']            Optional id for the div
 * @uses $vars['class']         Optional additional class for the div
 * @uses $vars['order']         bool Annotation comment order. asc by default or desc. Used for live comment.
 */

$preview = elgg_extract('preview', $vars, '');
$show_add_form = elgg_extract('show_add_form', $vars, true);
$order = elgg_extract('order', $vars, 'asc');
if (!in_array($order, array('asc', 'desc'))) $order = 'asc';

$id = '';
if (isset($vars['id'])) {
	$id = "id=\"{$vars['id']}\"";
}

$class = 'elgg-comments';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// work around for deprecation code in elgg_view()
unset($vars['internalid']);

echo "<div $id class=\"$class\">";

$options = array(
	'guid' => $vars['entity']->getGUID(),
	'annotation_name' => 'generic_comment',
	'preview' => $preview
);
$html = elgg_list_annotations($options);

if ($html) {
	echo '<h3 id="comments" class="gwfb pbs ' . $preview . '">' . elgg_echo('comments') . '</h3>';
	echo $html;
}

if ($show_add_form) {
	$form_vars = array(
		'name' => 'elgg_add_comment',
		'class' => $order
	);
	echo elgg_view_form('comments/add', $form_vars, $vars);
}

echo '</div>';

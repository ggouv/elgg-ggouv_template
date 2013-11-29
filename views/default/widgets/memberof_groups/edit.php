<?php
/**
 * Group activity widget settings
 */

// set default value
if (!isset($vars['entity']->num_display)) {
	$vars['entity']->num_display = 6;
}
if (!isset($vars['entity']->sort_items) || !in_array($vars['entity']->sort_items, array('last_action', 'time_created', 'abc'))) {
	$vars['entity']->sort_items = 'last_action';
}
if (!isset($vars['entity']->size_items)) {
	$vars['entity']->size_items = 'small';
}

$params = array(
	'name' => 'params[num_display]',
	'value' => $vars['entity']->num_display,
	'options_values' => array(
		6 => '6',
		8 => '8',
		12 => '12',
		16 => '16',
		24 => '24',
		0 => elgg_echo('all')
	)
);
$num_dropdown = elgg_view('input/dropdown', $params);

$params = array(
	'name' => 'params[sort_items]',
	'value' => $vars['entity']->sort_items,
	'options_values' => array(
		'last_action' => elgg_echo('widget:sort_items:last_action'),
		'time_created' => elgg_echo('widget:sort_items:creation'),
		'abc' => elgg_echo('widget:sort_items:abc'),
	),
);
$dropdownType = elgg_view('input/dropdown', $params);

$params = array(
	'name' => 'params[size_items]',
	'value' => $vars['entity']->size_items,
	'options_values' => array(
		'small' => elgg_echo('widget:size_items:small'),
		'tiny' => elgg_echo('widget:size_items:tiny'),
		'small_image' => elgg_echo('widget:size_items:small_image'),
		'tiny_image' => elgg_echo('widget:size_items:tiny_image'),
	),
);
$size = elgg_view('input/dropdown', $params);

?>
<div>
	<?php echo elgg_echo('widget:numbertodisplay'); ?>:
	<?php echo $num_dropdown; ?>
	<?php echo '<br/>' . elgg_echo('brainstorm:typetodisplay'); ?>:
	<?php echo $dropdownType; ?>
	<?php echo '<br/>' . elgg_echo('widgets:size_items'); ?>:
	<?php echo $size; ?>
</div>


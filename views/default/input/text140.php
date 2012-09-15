<?php
/**
 * Elgg text input
 * Displays a text input field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['class'] Additional CSS class
 		$vars['id_count'] Id of the counter
 */

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-text140 {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-text140";
}

if (isset($vars['id_count'])) {
	$id_count = "id='{$vars['id_count']}'";
} else {
	$vars['id_count'] ='';
}

$defaults = array(
	'value' => '',
	'disabled' => false,
);

$vars = array_merge($defaults, $vars);

?>
<div class="text140-characters-remaining">
	<input type="text" <?php echo elgg_format_attributes($vars); ?> />
	<span <?php echo $id_count; ?> class="pts"><?php echo 140 - mb_strlen($vars['value']); ?></span>
</div>
<?php
/**
 * Elgg long text input
 * Displays a long text input field that can use WYSIWYG editor
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value']    The current value, if any - will be html encoded
 * @uses $vars['preview']  False to disable preview, toggle for toggled preview. defaut TRUE
 * @uses $vars['class']    Additional CSS class
 */
$preview = elgg_extract('preview',$vars, true);

unset($vars['preview']);
if ($preview === false) {
	$vars['class'] = "{$vars['class']} allWidth";
} else if ($preview === 'toggle') {
	$vars['class'] = "{$vars['class']} markdown-body allWidth hidden";
} else {
	$vars['class'] = "{$vars['class']} markdown-body";
}

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-longtext {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-longtext";
}

$rand = rand(); //@todo make this more robust
$defaults = array(
	'value' => '',
	'id' => 'elgg-input-' . $rand,
);

$vars = array_merge($defaults, $vars);

$value = $vars['value'];
unset($vars['value']);

echo elgg_view_menu('longtext', array(
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
	'id' => $vars['id'],
));

?>

<div class="description-wrapper float">
	<?php if ($preview === true) {
		echo '';//'<div class="pad"></div>';
	} else if ($preview == 'toggle') {
		echo '<div class="toggle-longtext gwf">e</div>';
	}
	
	echo '<textarea ' . elgg_format_attributes($vars) . '>' .
		htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false) .
	'</textarea>';
	
	if ($preview !== false) { ?>
		<div class="previewPaneWrapper <?php echo $preview; ?>">
			<div id="previewPane-<?php echo $rand; ?>" class="elgg-output elgg-preview-longtext pane mlm pas"></div>
			<div id="helpPane-<?php echo $rand; ?>" class="elgg-output elgg-help-longtext pane hidden mlm pas"><?php echo elgg_echo('ggouv:longtext:help');?></div>
		</div>
	<?php }?>
</div>

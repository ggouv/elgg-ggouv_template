<?php
/**
 * Elgg long text input
 * Displays a long text input field that can use WYSIWYG editor
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value']    The current value, if any - will be html encoded
 * @uses $vars['preview'] Is the preview field disabled? defaut TRUE
 * @uses $vars['class']    Additional CSS class
 */
$preview = elgg_extract('preview',$vars, true);
unset($vars['preview']);
$vars['class'] = $preview === true ? "{$vars['class']} markdown-body" : "allWidth {$vars['class']}";

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
<textarea <?php echo elgg_format_attributes($vars); ?>>
<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false); ?>
</textarea>
<?php if ($preview === true) { ?><div class="previewPaneWrapper">
	<div id="previewPane-<?php echo $rand; ?>" class="elgg-output elgg-preview-longtext pane mlm pas"></div>
	<div id="helpPane-<?php echo $rand; ?>" class="elgg-output elgg-help-longtext pane hidden mlm pas"><?php echo elgg_echo('ggouv:longtext:help');?></div>
</div><?php }?>
</div>

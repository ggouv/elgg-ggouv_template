<?php
/**
 * User settings for Elgg-ggouv_template
 */

$value = elgg_get_plugin_user_setting('tiny_ownerblock', elgg_get_logged_in_user_guid(), 'elgg-ggouv_template');

?>

<div>
	<label class="mrs float">
		<?php echo elgg_echo('ggouv_template:tiny_ownerblock'); ?>
	</label>
		<?php echo elgg_view("input/radio", array(
			'name' => 'params[tiny_ownerblock]',
			'value' => $value ? $value : 'no',
			'options' => array(
				elgg_echo('option:yes') => 'yes',
				elgg_echo('option:no') => 'no',
			),
			'align' => 'horizontal',
		));
		?>
</div>
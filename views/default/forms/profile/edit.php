<?php
/**
 * Edit profile form
 *
 * @uses vars['entity']
 */

?>
<h3 class='mvm'>
	<?php echo elgg_echo('Pseudo'); ?>&nbsp;:&nbsp;<?php echo '<span style="color: #555;">@' . $vars['entity']->username . '</span>'; ?>
</h3>
<div>
	<label><?php echo elgg_echo('Votre nom réel'); ?></label>
	<?php echo elgg_view('input/text', array(
		'name' => 'realname',
		'value' => $vars['entity']->realname,
		'maxlength' => 90
	)); ?>
</div>
<?php

$profile_fields = elgg_get_config('profile_fields');
if (is_array($profile_fields) && count($profile_fields) > 0) {
	foreach ($profile_fields as $shortname => $valtype) {
		$metadata = elgg_get_metadata(array(
			'guid' => $vars['entity']->guid,
			'metadata_name' => $shortname
		));
		if ($metadata) {
			if (is_array($metadata)) {
				$value = '';
				foreach ($metadata as $md) {
					if (!empty($value)) {
						$value .= ', ';
					}
					$value .= $md->value;
					$access_id = $md->access_id;
				}
			} else {
				$value = $metadata->value;
				$access_id = $metadata->access_id;
			}
		} else {
			$value = '';
			$access_id = ACCESS_DEFAULT;
		}

?>
<div>
	<label><?php echo elgg_echo("profile:{$shortname}") ?></label>
	<?php
		$params = array(
			'name' => "accesslevel[$shortname]",
			'value' => $access_id,
		);
		echo elgg_view('input/access', $params);
		$params = array(
			'name' => $shortname,
			'value' => $value,
			'class' => $class
		);
		if($shortname == 'location') {
			$params['id'] = 'location';
			$params['class'] = 'digits' . (get_input('show_location', false) ? ' elgg-autofocus' : '');
			$params['minlength'] = 5;
			$params['maxlength'] = 5;
		}
		echo elgg_view("input/{$valtype}", $params);

	?>
</div>
<?php
	}
}
?>
<div class="elgg-foot">
<?php
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->guid));
	echo elgg_view('input/submit', array('value' => elgg_echo('save')));
?>
</div>

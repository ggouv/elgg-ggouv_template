<?php
/**
 * Group profile fields
 */

$group = $vars['entity'];

$profile_fields = elgg_get_config('group');

if (is_array($profile_fields) && count($profile_fields) > 0) {

	$even_odd = 'odd';
	foreach ($profile_fields as $key => $valtype) {
		// do not show the name
		if ($key == 'name') {
			continue;
		}

		$value = $group->$key;
		if (empty($value)) {
			continue;
		}

		$options = array('value' => $group->$key);
		if ($valtype == 'tags') {
			$options['tag_names'] = $key;
		}

		switch ($key) {
			case 'briefdescription':
				echo "<div class=\"{$even_odd} {$key}\"><h3>". elgg_view("output/$valtype", $options) . '</h3></div>';
				break;
			case 'description':
				echo "<div class=\"{$even_odd} {$key}\"><div id=\"groups-description\">" . elgg_view("output/longtext", $options) . '</div></div>';
				break;
			case 'interests':
				echo "<div class=\"{$even_odd} {$key}\">". elgg_view("output/tags", $options) . '</div>';
				break;
			default:
				echo "<div class=\"{$even_odd} {$key}\">";
				echo "<b>";
				echo elgg_echo("groups:$key");
				echo "&nbsp;:&nbsp;</b>";
				echo elgg_view("output/$valtype", $options);
				echo "</div>";
				break;
		}

		$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
	}
}

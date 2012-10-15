<?php
/**
 * Group profile summary
 *
 * Local group
 *
 * @uses $vars['group']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('groups:notfound');
	return true;
}

$group = $vars['entity'];
$owner = $group->getOwnerEntity();
if (in_array($group->getSubtype(), array('localgroup'))) {
	elgg_load_library('group_ggouv');
	if ($group->guid < 100) {
		$data_ville = get_data_pref_by_dep($group->guid);
		$zoom = $group->map_zoom ? $group->map_zoom : 9;
	} else {
		$data_ville = get_data_key_ville_by(array('`lat`', '`long`'), 'cp', $group->guid, true);
		$zoom = $group->map_zoom ? $group->map_zoom : 12;
	}
}
?>

<div class="groups-profile clearfix elgg-image-block <?php echo $vars['class'] ?>">
	<div class="elgg-image">
		<div class="groups-profile-map">
			<?php
				echo '<div id="map" style="height: 200px; width: 400px;" data-zoom="' . $zoom . '" data-lat="' . $data_ville[0]->lat . '" data-long="' . $data_ville[0]->long . '"></div>';
			?>
		</div>
	</div>

	<div class="groups-profile-fields elgg-body">
		<?php echo elgg_view('groups/profile/fields', $vars); ?>
	</div>

	<ul class="groups-stats float">
		<li class="members">
			<div class="stats mls mrm"><?php echo $group->getMembers(0, 0, TRUE); ?></div>
			<h3><?php echo elgg_echo('groups:summary:members'); ?></h3>
		</li>
		
		<?php echo elgg_view('groups_admins_elections/list_mandats'); ?>

	</ul>
</div>
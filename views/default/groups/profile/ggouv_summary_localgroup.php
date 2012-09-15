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
	$data_ville = get_data_ville_by_cp(46300);//$group->briefdescription);
}
?>

<div class="groups-profile clearfix elgg-image-block <?php echo $vars['class'] ?>">
	<div class="elgg-image">
		<div class="groups-profile-map">
			<?php $zoom = $group->map_zoom ? $group->map_zoom : 12;
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

		<li>
			<h3><?php echo elgg_echo("groups:owner"); ?></h3>
			<?php echo elgg_view_entity_icon($owner, 'small', array('class' => 'float mts mrs'));
			echo elgg_view('output/url', array(
				'text' => $owner->name,
				'value' => $owner->getURL(),
				'is_trusted' => true,
			)); ?>
		</li>
		
		<?php echo elgg_view('groups_admins_elections/list_mandats'); ?>

	</ul>
</div>
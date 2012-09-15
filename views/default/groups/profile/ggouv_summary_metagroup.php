<?php
/**
 * Group profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['group']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('groups:notfound');
	return true;
}

$group = $vars['entity'];
$owner = $group->getOwnerEntity();
?>

<div class="groups-profile clearfix elgg-image-block <?php echo $vars['class'] ?>">
	<div class="elgg-image">
		<div class="groups-profile-icon">
			<?php echo elgg_view_entity_icon($group, 'large', array('href' => '')); ?>
		</div>
	</div>

	<div class="groups-profile-fields elgg-body">
		<?php echo elgg_view('groups/profile/fields', $vars); ?>
	</div>

	<ul class="groups-stats float">
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
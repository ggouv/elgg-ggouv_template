<?php
/**
 * Group entity view
 *
 * @package ElggGroups
 */

$group = $vars['entity'];

$metadata = elgg_view_menu('entity', array(
	'entity' => $group,
	'handler' => 'groups',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}


if ($vars['full_view']) {
	echo elgg_view('groups/profile/summary', $vars);
} else {
	// brief view

	$size = elgg_extract('size', $vars, 'tiny');
	$icon = elgg_view_entity_icon($group, str_replace('_image', '', $size), array(
		'href' => false
	));
	$icon = '<div class="group-info-popup info-popup link" title="' . $group->name . '" data-guid="' . $group->getGUID() . '">' . $icon . '</div>';

	if ($size == 'tiny_image' || $size == 'small_image') {
		echo $icon;
	} else {

		if ($size == 'tiny') {
			$params = array(
				'entity' => $group,
				'metadata' => $metadata,
			);
		} else {
			$params = array(
				'entity' => $group,
				'metadata' => $metadata,
				'subtitle' => deck_river_wire_filter($group->briefdescription),
			);
		}

		$params = $params + $vars;
		$list_body = elgg_view('group/elements/summary', $params);
		echo elgg_view_image_block($icon, $list_body, $vars);

	}
}

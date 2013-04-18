<?php
/**
 * Elgg user display
 *
 * @uses $vars['entity'] ElggUser entity
 * @uses $vars['size']   Size of the icon
 */

$entity = $vars['entity'];
$size = elgg_extract('size', $vars, 'tiny');
$icon = elgg_view_entity_icon($entity, $size, $vars);

// Simple XFN
$rel = '';
if (elgg_get_logged_in_user_guid() == $entity->guid) {
	$rel = 'rel="me"';
} elseif (check_entity_relationship(elgg_get_logged_in_user_guid(), 'friend', $entity->guid)) {
	$rel = 'rel="friend"';
}

$title = "<a href=\"" . $entity->getUrl() . "\" $rel>" . $entity->name . "</a>";

$metadata = elgg_view_menu('entity', array(
	'entity' => $entity,
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}

if (elgg_get_context() == 'gallery') {
	echo $icon;
} else {
	if ($entity->isBanned()) {
		$banned = elgg_echo('banned');
		$params = array(
			'entity' => $entity,
			'title' => $title,
			'metadata' => $metadata,
		);
	} else {

		if (elgg_is_logged_in() && $entity->getGUID() != elgg_get_logged_in_user_guid()) {
			$metadata2 = '<ul class="elgg-menu profile-action-menu inlist mlm">';
			if ($entity->isFriend()) {
				$metadata2 .= elgg_view('output/url', array(
					'href' => elgg_add_action_tokens_to_url("action/friends/remove?friend={$entity->guid}"),
					'text' => '&#44033;', // unicode /AC01
					'title' => elgg_echo('friend:remove'),
					'class' => 'tooltip s gwf t remove_friend'
				));
			} else {
				$metadata2 .= elgg_view('output/url', array(
					'href' => elgg_add_action_tokens_to_url("action/friends/add?friend={$entity->guid}"),
					'text' => '&#44032;', // unicode /AC00
					'title' => elgg_echo('friend:add'),
					'class' => 'tooltip s gwf t add_friend'
				));
			}
			$metadata = $metadata2 . '</ul>' . $metadata;
		}

		$params = array(
			'entity' => $entity,
			'title' => $title,
			'metadata' => $metadata,
			'subtitle' => deck_river_wire_filter($entity->briefdescription),
			'content' => elgg_view('user/status', array('entity' => $entity)),
		);
	}

	$list_body = elgg_view('user/elements/summary', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}

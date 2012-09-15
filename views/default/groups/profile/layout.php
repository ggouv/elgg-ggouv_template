<?php
/**
 * Layout of the groups profile page
 *
 * @uses $vars['entity']
 */
$group = $vars['entity'];

echo elgg_view('groups/profile/ggouv_summary_' . $group->getSubtype(), $vars);
if (group_gatekeeper(false)) {
	echo elgg_view('groups/profile/widgets', $vars);
} else {
	echo elgg_view('groups/profile/closed_membership');
}

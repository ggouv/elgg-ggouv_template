<?php
/**
 * Layout of the groups profile page
 *
 * @uses $vars['entity']
 */

if (group_gatekeeper(false)) {

	$vars['class'] = 'with_activity_module';
	echo elgg_view('groups/profile/summary', $vars);

	echo '<ul class="group_activity_module">' . elgg_view('groups/profile/ggouv_activity_module', $vars) . '</ul>';

	echo elgg_view('groups/profile/widgets', $vars);
	
} else {

	echo elgg_view('groups/profile/summary', $vars);
	
	echo elgg_view('groups/profile/closed_membership');
	
}

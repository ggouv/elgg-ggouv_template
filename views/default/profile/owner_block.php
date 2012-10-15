<?php
/**
 * Profile owner block
 */

$user = elgg_get_page_owner_entity();

if (!$user) {
	// no user so we quit view
	echo elgg_echo('viewfailure', array(__FILE__));
	return TRUE;
}

$icon = elgg_view_entity_icon($user, 'large', array(
	'use_hover' => false,
	'use_link' => false,
));

// grab the actions and admin menu items from user hover
$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $user), array());
$builder = new ElggMenuBuilder($menu);
$menu = $builder->getMenu('priority');
$actions = elgg_extract('action', $menu, array());
$admin = elgg_extract('admin', $menu, array());

$profile_actions = '';
if (elgg_is_logged_in() && $actions) {
	$profile_actions = '<ul class="elgg-menu profile-action-menu mvm">';
	foreach ($actions as $action) {
		if ($action->getName() == 'reportuser') {
			$profile_report = '<ul class="elgg-menu profile-action-menu mtm"><li>' . $action->getContent(array('class' => 'elgg-icon-attention gwfb')) . '</li></ul>';
		} else {
			$action_name = $action->getName();
			$profile_actions .= '<li>' . $action->getContent(array('class' => "elgg-button elgg-button-action gwfb $action_name")) . '</li>';
		}
	}
	$profile_actions .= '</ul>';
}

// if admin, display admin links
$admin_links = '';
if (elgg_is_admin_logged_in() && elgg_get_logged_in_user_guid() != elgg_get_page_owner_guid()) {
	$text = elgg_echo('admin:options');

	$admin_links = '<ul class="profile-admin-menu-wrapper">';
	$admin_links .= "<li><a rel=\"toggle\" href=\"#profile-menu-admin\">$text&hellip;</a>";
	$admin_links .= '<ul class="profile-admin-menu" id="profile-menu-admin">';
	foreach ($admin as $menu_item) {
		$admin_links .= elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
	}
	$admin_links .= '</ul>';
	$admin_links .= '</li>';
	$admin_links .= '</ul>';	
}

// content links
$content_menu = elgg_view_menu('owner_block', array(
	'entity' => elgg_get_page_owner_entity(),
	'class' => 'profile-content-menu',
));

echo <<<HTML

<div id="profile-owner-block">
	$icon
	$profile_actions
	$content_menu
	$admin_links
	$profile_report
</div>

HTML;

echo '<div id="profile-details" class="elgg-body pll">';
echo "<h1>{$user->realname}</h1>";
echo "<h2 class='mtm' style='font-weight:normal;'>@{$user->username}</h2>";

//echo elgg_view("profile/status", array("entity" => $user));
echo '<div class="markdown-body mbm mhs">' . elgg_view("output/text140", array('value' => $user->briefdescription)) . '</div>';
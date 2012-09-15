<ul class="elgg-menu elgg-menu-topbar elgg-menu-topbar-default">
<?php

$user = elgg_get_logged_in_user_entity();
$site_url = elgg_get_site_url();

if ($user) {
	// logo
	echo	'<li class="elgg-menu-item-logo ggouv-webfont">' .
				"<a href='{$site_url}activity'>∇</a>" .
			'</li>';
	
	// profil icon for dashboard
	$icon_url = $user->getIconURL('small');
	$title = elgg_echo('dashboard');
	echo	'<li class="elgg-menu-item-dashboard">' .
				"<a href='{$site_url}dashboard'><img src='$icon_url' alt='$user->name' title='$title' /></a>" .
			'</li>';
	
	// @ for user profile, friends, collections, search user(@todo)...
	$sub_menu_items = array(array(
			'name' => 'profile',
			'href' => $user->getURL(),
			'text' => '@' . $user->username
		), array(
			'name' => 'friends',
			'href' => elgg_get_site_url() . "friends/{$user->username}",
			'text' => elgg_echo('friends')
		), array(
			'name' => 'friends_of',
			'href' => elgg_get_site_url() . "friendsof/{$user->username}",
			'text' => elgg_echo('friends:followers')
		), array(
			'name' => 'members',
			'href' => elgg_get_site_url() . "members",
			'text' => elgg_echo('members')
		)
	);
	$sub_menu = '<ul class="ggouv-menu-child"><ul class="ggouv-menu-child-shadow">';
	foreach($sub_menu_items as $sub_menu_item) {
		$sub_menu .= "<li class='elgg-menu-item-{$sub_menu_item[name]}'><a href='{$sub_menu_item[href]}'>{$sub_menu_item[text]}</a></li>";
	}
	$sub_menu .= '</ul></ul>';
	echo	'<li class="elgg-menu-item-at ggouv-webfont ggouv-menu-parent scale rotate">' .
				'<a href="#">@</a>' . $sub_menu .
			'</li>';
	
	// sub menu for group
	$sub_menus = array(array(
					'name' => 'groups-all',
					'href' => $site_url . 'groups/all',
					'text' => elgg_echo('groups:all')
				)
			);
	$sub_menu = '<ul class="ggouv-menu-child"><ul class="ggouv-menu-child-shadow">';
	foreach($sub_menus as $menu) {
		$sub_menu .= "<li class='elgg-menu-item-{$menu[name]}'><a href='{$menu[href]}'>{$menu[text]}</a></li>";
	}
	$groups = elgg_get_entities_from_relationship(array(
			'relationship' => 'member',
			'relationship_guid' => $user->guid,
			'inverse_relationship' => FALSE
		));
	foreach ($groups as $group) {
		if ( $group->owner_guid == $user->guid ) {
			$list_groups_owner .= "<li><a href=\"{$group->getURL()}\"><img src=\"".$group->getIconURL('tiny')."\" /> {$group->name}</a></li>";
		} else {
			$list_groups_memberof .= "<li><a href=\"{$group->getURL()}\"><img src=\"".$group->getIconURL('tiny')."\" /> {$group->name}</a></li>";
		}
	}
	if ($list_groups_owner) $sub_menu .= '<li class="block-title">' . elgg_echo('groups:owned') . '</li><ul>' . $list_groups_owner . '</ul>';
	if ($list_groups_memberof) $sub_menu .= '<li class="block-title">' . elgg_echo('groups:yours') . '</li><ul>' . $list_groups_memberof . '</ul>';
	$sub_menu .= '</ul></ul>';
	
	echo '<li class="elgg-menu-item-groups ggouv-webfont ggouv-menu-parent scale rotate">' .
			'<a href="#">!</a>' . $sub_menu .
		'</li>';


	// sidebar bottom
	echo '</ul><ul class="elgg-menu-topbar elgg-menu-topbar-alt">';
	
	// admin
	if ( $user->isAdmin() ) {
		$log_admin = elgg_view('output/url', array(
			'href' => $site_url . "admin/plugins",
			'text' => 'K',
		));
		echo '<li class="elgg-menu-item-admin ggouv-webfont scale">' .
			$log_admin .
		'</li>';
	}
	
	// user settings
	$user_settings = elgg_view('output/url', array(
		'href' => $site_url . "settings/user/{$user->username}",
		'text' => 'C',
	));
	echo '<li class="elgg-menu-item-usersettings ggouv-webfont scale">' .
		$user_settings .
	'</li>';
	
	// log out
	$log_out = elgg_view('output/url', array(
		'href' => "action/logout",
		'text' => 'E',
		'is_action' => TRUE,
	));
	echo '<li class="elgg-menu-item-logout ggouv-webfont scale">' .
			$log_out .
		'</li>';

	// info
	echo '<li class="elgg-menu-item-info ggouv-webfont"><a title="info" href="#">i</a></li>';

}
?>
</ul>
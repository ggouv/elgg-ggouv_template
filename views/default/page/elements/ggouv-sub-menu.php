<div class="elgg-page-topbar-shadow"></div>
<div class="elgg-page-topbar-submenu">
<?php

$user = elgg_get_logged_in_user_entity();

// sub menu for profile
$sub_menus = array(array(
				'name' => 'profile',
				'href' => $user->getURL(),
				'text' => '@' . $user->username
			), array(
				'name' => 'friends',
				'href' => elgg_get_site_url() . "friends/{$user->username}",
				'text' => elgg_echo('friends')
			), array(
				'name' => 'members',
				'href' => elgg_get_site_url() . "members",
				'text' => elgg_echo('members')
			)
		);

echo '<ul class="elgg-submenu-at elgg-menu elgg-child-menu" href="at">';
foreach($sub_menus as $menu) {
	echo "<li class='elgg-menu-item-{$menu[name]}'><a href='{$menu[href]}'>{$menu[text]}</a></li>";
}
echo '</ul>';

// sub menu for group
$sub_menus = array(array(
				'name' => 'groups-all',
				'href' => elgg_get_site_url() . 'groups/all',
				'text' => elgg_echo('groups:all')
			)
		);

echo '<ul class="elgg-submenu-groups elgg-menu elgg-child-menu" href="groups">';
foreach($sub_menus as $menu) {
	echo "<li class='elgg-menu-item-{$menu[name]}'><a href='{$menu[href]}'>{$menu[text]}</a></li>";
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
	if ($list_groups_owner) echo '<li class="block-title">' . elgg_echo('groups:owned') . '</li><ul>' . $list_groups_owner . '</ul>';
	if ($list_groups_memberof) echo '<li class="block-title">' . elgg_echo('groups:yours') . '</li><ul>' . $list_groups_memberof . '</ul>';

echo '</ul>';

?>
</div>

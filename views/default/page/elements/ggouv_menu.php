<ul class="elgg-menu elgg-menu-topbar elgg-menu-topbar-default">
<?php

$user = elgg_get_logged_in_user_entity();
$site_url = elgg_get_site_url();

if ($user) {
	// logo
	echo	'<li class="elgg-menu-item-logo gwf">' .
				"<a class='t' href='{$site_url}activity'>∇</a>" .
			'</li>';

	// profil icon for dashboard
	$icon_url = $user->getIconURL('small');
	echo	'<li class="elgg-menu-item-dashboard ggouv-menu-parent">' .
				"<a href=''><img src='$icon_url' alt='$user->name' /></a>" .
				'<ul class="ggouv-menu-child">' .
					'<ul class="ggouv-menu-child-shadow">' .
							'<li><a href="' . $site_url . 'dashboard">' . elgg_echo('dashboard') . '</a></li>' .
							'<div class="underlined"></div>' .
							'<li><a href="' . $site_url . 'blog/owner/' . $user->username . '">' . elgg_echo('my_blog') . '</a></li>' .
							'<li><a href="' . $site_url . 'workflow/owner/' . $user->username . '">' . elgg_echo('my_workflow') . '</a></li>' .
							'<li><a href="' . $site_url . 'wiki/owner/' . $user->username . '">' . elgg_echo('my_wiki_pages') . '</a></li>' .
							'<li><a href="' . $site_url . 'pad/owner/' . $user->username . '">' . elgg_echo('my_pads') . '</a></li>' .
							'<li><a href="' . $site_url . 'brainstorm/owner/' . $user->username . '">' . elgg_echo('my_ideas') . '</a></li>' .
							'<li><a href="' . $site_url . 'answers/owner/' . $user->username . '">' . elgg_echo('answers:your') . '</a></li>' .
					'</ul>' .
				'</ul>' .
			'</li>';

	// @ for user profile, friends, collections, search user(@todo)...
	$sub_menu_items = array(array(
			'name' => 'profile',
			'href' => $user->getURL(),
			'text' => '@' . $user->username
		), array(
			'name' => 'friends',
			'href' => $site_url . "friends/{$user->username}",
			'text' => elgg_echo('friends:my:following')
		), array(
			'name' => 'friends_of',
			'href' => $site_url . "friendsof/{$user->username}",
			'text' => elgg_echo('friends:my:followers')
		), array(
			'name' => 'members',
			'href' => $site_url . "members",
			'text' => elgg_echo('members:all')
		)
	);
	$sub_menu = '<ul class="ggouv-menu-child"><ul class="ggouv-menu-child-shadow">';
	foreach($sub_menu_items as $sub_menu_item) {
		$sub_menu .= "<li class='elgg-menu-item-{$sub_menu_item[name]}'><a href='{$sub_menu_item[href]}'>{$sub_menu_item[text]}</a></li>";
	}
	$sub_menu .= '</ul></ul>';
	echo	'<li class="elgg-menu-item-at gwf ggouv-menu-parent scale rotate">' .
				'<a class="t" href="#">m</a>' . $sub_menu .
			'</li>';

	// sub menu for group
	$sub_menu = '<ul class="ggouv-menu-child">' .
					'<ul class="ggouv-menu-child-shadow"><table><tr>';
	/*	$groups =  elgg_get_entities(array(
		'type' => 'group',
		'owner_guid' => $user->guid,
		'limit' => 10,
	));
	foreach ($groups as $group) {
		$list_groups_owner .= "<li><a href=\"{$group->getURL()}\">";
		$list_groups_owner .= elgg_view_entity_icon($group, 'tiny', array('href' => false));
		$list_groups_owner .= "&nbsp;{$group->name}</a></li>";
	}
	$groups = elgg_get_entities_from_relationship_count(array(
		'type' => 'group',
		'relationship' => 'member',
		'relationship_guid' => $user->guid,
		'inverse_relationship' => false,
		'limit' => 10,
	));
	foreach ($groups as $group) {
		$list_groups_memberof .= "<li><a href=\"{$group->getURL()}\">";
		$list_groups_memberof .= elgg_view_entity_icon($group, 'tiny', array('href' => false));
		$list_groups_memberof .= "&nbsp;{$group->name}</a></li>";
	}*/
	$groups = elgg_get_entities_from_relationship(array(
			'type' => 'group',
			'relationship' => 'member',
			'relationship_guid' => $user->guid,
			'inverse_relationship' => FALSE
		));
	foreach ($groups as $group) {
		if ( $group->owner_guid == $user->guid ) {
			$list_groups_owner .= "<li><a href=\"{$group->getURL()}\">";
			$list_groups_owner .= elgg_view_entity_icon($group, 'tiny', array('href' => false, 'img_class' => 'prm'));
			$list_groups_owner .= "{$group->name}</a></li>";
		} else {
			$list_groups_memberof .= "<li><a href=\"{$group->getURL()}\">";
			$list_groups_memberof .= elgg_view_entity_icon($group, 'tiny', array('href' => false, 'img_class' => 'prm'));
			$list_groups_memberof .= "{$group->name}</a></li>";
		}
	}
	if ($list_groups_owner) $sub_menu .= '<td class="phm hr"><ul><li class="block-title">' . elgg_echo('groups:owned') . '</li><ul>' . $list_groups_owner . '</ul></ul></td>';
	if ($list_groups_memberof) $sub_menu .= '<td class="phm hr"><ul><li class="block-title">' . elgg_echo('groups:yours') . '</li><ul>' . $list_groups_memberof . '</ul></ul></td>';

	$sub_menu .= '<td class="plm"><ul>';
	if ($user_location = $user->location) $sub_menu .= '<li class="elgg-menu-item-my-localgroup"><a href="' . $site_url . 'groups/profile/' . $user_location . '">' .
		elgg_echo('groups:my_local_group') . ' !' . $user_location . '</a></li>';
	$sub_menu .= '<li class="elgg-menu-item-groups-all"><a href="' . $site_url . 'groups/all' . '">' . elgg_echo('groups:all') . '</a></li>';
	$sub_menu .= '<li class="elgg-menu-item-groups-meta"><a href="' . $site_url . 'groups/all?filter=metagroups' . '">' . elgg_echo('groups:metagroups') . '</a></li>';
	$sub_menu .= '<li class="elgg-menu-item-groups-meta"><a href="' . $site_url . 'groups/all?filter=typogroups' . '">' . elgg_echo('groups:typogroups') . '</a></li>';
	$sub_menu .= '<li class="elgg-menu-item-groups-meta"><a href="' . $site_url . 'groups/all?filter=localgroups' . '">' . elgg_echo('groups:localgroups') . '</a></li>';
	$sub_menu .= '</ul></td>';

	$sub_menu .= '</tr></table></ul></ul>';

	echo '<li class="elgg-menu-item-groups gwf ggouv-menu-parent scale rotate">' .
			'<a id="exclam-groups-icon" class="t" href="#">!</a>' . //$sub_menu .
		'</li>';

	// menu puzzle
	echo '<li class="elgg-menu-item-puzzle gwf ggouv-menu-parent scale rotate">' .
			'<a class="t" href="#">&#44044;</a>' . // unicode AC0C
			'<ul class="ggouv-menu-child">' .
				'<ul class="ggouv-menu-child-shadow">' .
						'<li><a href="' . $site_url . 'bookmarklet/install">' . elgg_echo('ggouvlet:install') . '</a></li>' .
						'<li><a href="' . $site_url . 'split/">' . elgg_echo('split-your-elgg:screen') . '</a></li>' .
				'</ul>' .
			'</ul>' .
		'</li>';

	// sidebar bottom
	echo '</ul><ul class="elgg-menu-topbar elgg-menu-topbar-alt">';

	// admin
	if ( $user->isAdmin() ) {
		$log_admin = elgg_view('output/url', array(
			'href' => $site_url . "admin/plugins",
			'text' => '&#44042;', // unicode AC0A
			'class' => 'tooltip w t',
			'title' => elgg_echo('Administration')
		));
		echo '<li class="elgg-menu-item-admin gwf scale">' .
			$log_admin .
		'</li>';
		$log_admin = elgg_view('output/url', array(
			'href' => '#',
			'onclick' => 'elgg.console.showConsole();',
			'text' => '_', // unicode AC0A
			'class' => 'tooltip w t',
			'title' => elgg_echo('Console')
		));
		echo '<li class="elgg-menu-item-admin gwf scale">' .
			$log_admin .
		'</li>';
	}

	// help
	if ($url_help_group = elgg_get_plugin_setting('group_of_help', 'elgg-ggouv_template')) {
		$url_help_wiki = elgg_get_plugin_setting('wiki_of_help', 'elgg-ggouv_template');
		$url_help_faq = elgg_get_plugin_setting('faq_of_help', 'elgg-ggouv_template');
		echo '<li class="elgg-menu-item-help gwf ggouv-menu-parent scale">' .
			'<a class="t" href="#">H</a>' . // unicode AC0C
			'<ul class="ggouv-menu-child">' .
				'<ul class="ggouv-menu-child-shadow">' .
						'<li><a href="' . $url_help_wiki . '">' . elgg_echo('ggouv_template:dev:wiki_of_help') . '</a></li>' .
						'<li><a href="' . $site_url .'tour" class="start-tour">' . elgg_echo('help:start-tour') . '</a></li>' .
						'<li><a class="help-faq-link" href="' . $url_help_faq . '">' . elgg_echo('ggouv_template:dev:faq_of_help') . '</a></li>' .
						'<li><a class="help-group-link" href="' . $url_help_group . '">' . elgg_echo('ggouv_template:dev:group_of_help') . '</a></li>' .
				'</ul>' .
			'</ul>' .
		'</li>';
	}

	// user settings
	$user_settings = elgg_view('output/url', array(
		'href' => $site_url . "settings/user/{$user->username}",
		'text' => '&#44043;', // unicode AC0B
		'class' => 'tooltip w t',
		'title' => elgg_echo('usersettings:user')
	));
	echo '<li class="elgg-menu-item-usersettings gwf scale">' .
		$user_settings .
	'</li>';

	// log out
	$log_out = elgg_view('output/url', array(
		'href' => "action/logout",
		'text' => '&#44047;', // unicode ACOF
		'is_action' => TRUE,
		'class' => 'tooltip w t',
		'title' => elgg_echo('logout')
	));
	echo '<li class="elgg-menu-item-logout gwf scale">' .
			$log_out .
		'</li>';

	// info
	echo '<li class="elgg-menu-item-info gwf t">ï</li>';

}
?>
</ul>
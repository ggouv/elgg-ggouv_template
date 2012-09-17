<?php
/**
 * Groups function library
 */

/**
 * List all groups
 */
function groups_handle_all_page() {

	// all groups doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('groups'));

	elgg_register_title_button();

	$selected_tab = get_input('filter', 'newest');

	switch ($selected_tab) {
		case 'metagroups':
		default:
			$content = elgg_list_entities(array(
				'type' => 'group',
				'subtype' => 'metagroup',
				'full_view' => false,
				'size' => 'small',
				'split_items' => 2,
				'limit' => 40,
			));
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
		case 'typogroups':
		default:
			$content = elgg_list_entities(array(
				'type' => 'group',
				'subtype' => 'typogroup',
				'full_view' => false,
				'size' => 'small',
				'split_items' => 2,
				'limit' => 40,
			));
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
		case 'localgroups':
		default:
			$content = elgg_view('groups/localgroups');
			break;
		case 'popular':
			$content = elgg_list_entities_from_relationship_count(array(
				'type' => 'group',
				'subtype' => 0,
				'relationship' => 'member',
				'inverse_relationship' => false,
				'full_view' => false,
				'size' => 'small',
				'split_items' => 2,
				'limit' => 40,
			));
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
		/*case 'discussion':
			$content = elgg_list_entities(array(
				'type' => 'object',
				'subtype' => 'groupforumtopic',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
				'size' => 'small',
				'split_items' => 2
			));
			if (!$content) {
				$content = elgg_echo('discussion:none');
			}
			break;*/
		case 'newest':
		default:
			$content = elgg_list_entities(array(
				'type' => 'group',
				'subtype' => 0,
				'full_view' => false,
				'size' => 'small',
				'split_items' => 2,
				'limit' => 40,
			));
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
	}

	$filter = elgg_view('groups/group_sort_menu', array('selected' => $selected_tab));
	
	$sidebar = elgg_view('groups/sidebar/find');
	$sidebar .= elgg_view('groups/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('groups:all'), $body);
}

function groups_search_page() {
	elgg_push_breadcrumb(elgg_echo('search'));

	$tag = get_input("tag");
	$title = elgg_echo('groups:search:title', array($tag));

	// groups plugin saves tags as "interests" - see groups_fields_setup() in start.php
	$params = array(
		'metadata_name' => 'interests',
		'metadata_value' => $tag,
		'types' => 'group',
		'split_items' => 2,
		'limit' => 40,
		'size' => 'small',
		'full_view' => FALSE,
	);
	$content = elgg_list_entities_from_metadata($params);
	if (!$content) {
		$content = elgg_echo('groups:search:none');
	}

	$sidebar = elgg_view('groups/sidebar/find');
	$sidebar .= elgg_view('groups/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => false,
		'title' => $title,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List owned groups
 */
function groups_handle_owned_page() {

	$page_owner = elgg_get_page_owner_entity();

	$title = elgg_echo('groups:owned');
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities(array(
		'type' => 'group',
		'owner_guid' => elgg_get_page_owner_guid(),
		'full_view' => false,
		'split_items' => 2,
		'limit' => 40,
		'size' => 'small',
	));
	if (!$content) {
		$content = elgg_echo('groups:none');
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List groups the user is memober of
 */
function groups_handle_mine_page() {

	$page_owner = elgg_get_page_owner_entity();

	$title = elgg_echo('groups:yours');
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities_from_relationship_count(array(
		'type' => 'group',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_page_owner_guid(),
		'inverse_relationship' => false,
		'full_view' => false,
		'split_items' => 2,
		'limit' => 40,
		'size' => 'small',
	));
	if (!$content) {
		$content = elgg_echo('groups:none');
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Create or edit a group
 *
 * @param string $page
 * @param int $guid
 */
function groups_handle_edit_page($page, $guid = 0) {
	gatekeeper();
	
	if ($page == 'add') {
		$user_guid = elgg_get_logged_in_user_guid();
		$nbr_groups = elgg_get_entities(array(
			'type' => 'group',
			'subtype' => 0,
			'owner_guid' => $user_guid,
			'limit' => 0,
			'count' => true
		));
		if ($nbr_groups > 5) {
			register_error(elgg_echo('groups:error:more_five_groups'));
			forward(REFERER);
		}
	
		elgg_set_page_owner_guid($user_guid);
		$title = elgg_echo('groups:add');
		elgg_push_breadcrumb($title);
		$content = elgg_view('groups/edit');
	} else {
		$group = get_entity($guid);
		$title = elgg_echo("groups:title:edit", array($group->name));

		if ($group && $group->canEdit()) {
			elgg_set_page_owner_guid($group->getGUID());
			elgg_push_breadcrumb($group->name, $group->getURL());
			elgg_push_breadcrumb(elgg_echo("groups:edit"));
			$content = elgg_view("groups/edit", array('entity' => $group));
		} else {
			$content = elgg_echo('groups:noaccess');
		}
	}
	
	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group invitations for a user
 */
function groups_handle_invitations_page() {
	gatekeeper();

	$user = elgg_get_page_owner_entity();

	$title = elgg_echo('groups:invitations');
	elgg_push_breadcrumb($title);

	// @todo temporary workaround for exts #287.
	$invitations = groups_get_invited_groups(elgg_get_logged_in_user_guid());
	$content = elgg_view('groups/invitationrequests', array('invitations' => $invitations));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group profile page
 *
 * @param int $guid Group entity GUID
 */
function groups_handle_profile_page($guid) {
	elgg_set_page_owner_guid($guid);

	// turn this into a core function
	global $autofeed;
	$autofeed = true;

	$group = get_entity($guid);
	if (!$group) {
		forward('groups/all');
	}

	elgg_push_breadcrumb($group->name);

	$content = elgg_view('groups/profile/layout', array('entity' => $group));
	if (group_gatekeeper(false)) {
		$sidebar = '';
		if (elgg_is_active_plugin('search')) {
			$sidebar .= elgg_view('groups/sidebar/search', array('entity' => $group));
		}
		if (!in_array($group->getSubtype(), array('metagroup', 'typogroup'))) {
			$sidebar .= elgg_view('groups/sidebar/members', array('entity' => $group));
		}
		$sidebar2 = '<ul class="group_activity_module">' . elgg_view('groups/profile/ggouv_activity_module', array('entity' => $group)) . '</ul>';
	} else {
		$sidebar = '';
		//$sidebar2 = '';
	}

	groups_register_profile_buttons($group);

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'sidebar_2' => $sidebar2,
		'title' => $group->name,
		'filter' => '',
	);
	$body = elgg_view_layout('content_two_right_sidebars', $params);

	echo elgg_view_page($group->name, $body);
}

/**
 * Group activity page
 *
 * @param int $guid Group entity GUID
 */
function groups_handle_activity_page($guid) {

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!$group || !elgg_instanceof($group, 'group')) {
		forward();
	}

	group_gatekeeper();

	$title = elgg_echo('groups:activity');

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb($title);

	$content = '<ul class="group_activity_module">' . elgg_view('groups/profile/ggouv_activity_module', array('entity' => $group)) . '</ul>';
	
	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
		'header' => false
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group members page
 *
 * @param int $guid Group entity GUID
 */
function groups_handle_members_page($guid) {

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!$group || !elgg_instanceof($group, 'group')) {
		forward();
	}

	group_gatekeeper();

	$title = elgg_echo('groups:members:title', array($group->name));

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('groups:members'));

	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'member',
		'relationship_guid' => $group->guid,
		'inverse_relationship' => true,
		'types' => 'user',
		'limit' => 20,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Invite users to a group
 *
 * @param int $guid Group entity GUID
 */
function groups_handle_invite_page($guid) {
	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);

	$title = elgg_echo('groups:invite:title');

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('groups:invite'));

	if ($group && $group->canEdit()) {
		$content = elgg_view_form('groups/invite', array(
			'id' => 'invite_to_group',
			'class' => 'elgg-form-alt mtm',
		), array(
			'entity' => $group,
		));
	} else {
		$content .= elgg_echo('groups:noaccess');
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Manage requests to join a group
 * 
 * @param int $guid Group entity GUID
 */
function groups_handle_requests_page($guid) {

	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);

	$title = elgg_echo('groups:membershiprequests');

	if ($group && $group->canEdit()) {
		elgg_push_breadcrumb($group->name, $group->getURL());
		elgg_push_breadcrumb($title);
		
		$requests = elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'membership_request',
			'relationship_guid' => $guid,
			'inverse_relationship' => true,
			'limit' => 0,
		));
		$content = elgg_view('groups/membershiprequests', array(
			'requests' => $requests,
			'entity' => $group,
		));

	} else {
		$content = elgg_echo("groups:noaccess");
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Registers the buttons for title area of the group profile page
 *
 * @param ElggGroup $group
 */
function groups_register_profile_buttons($group) {

	$user = elgg_get_logged_in_user_entity();

	$actions = array();

	// group owners
	if ($group->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "groups/edit/{$group->getGUID()}";
		$actions[$url]['text'] = 'groups:edit';
		$actions[$url]['class'] = 'edit-button gwfb group_admin_only';
		if (!in_array($group->getSubtype(), array('metagroup', 'typogroup'))) {
			$url = elgg_get_site_url() . "groups/invite/{$group->getGUID()}";
			$actions[$url]['text'] = 'groups:invite';
			$actions[$url]['class'] = 'invit-button gwfb';
		}
	}

	// group members
	if ($group->isMember($user)) {
		if ($group->getOwnerGUID() != $user->guid && !is_user_group_admin($user, $group)) {
			// leave
			$url = elgg_get_site_url() . "action/groups/leave?group_guid={$group->getGUID()}";
			$url = elgg_add_action_tokens_to_url($url);
			$actions[$url]['text'] = 'groups:leave';
			$actions[$url]['class'] = 'leave-button gwfb';
		}
	} elseif (elgg_is_logged_in() && !in_array($group->getSubtype(), array('metagroup', 'typogroup'))) {
		// join - admins can always join.
		$url = elgg_get_site_url() . "action/groups/join?group_guid={$group->getGUID()}";
		$url = elgg_add_action_tokens_to_url($url);
		if ($group->isPublicMembership() || $group->canEdit()) {
			$actions[$url]['text'] = 'groups:join';
			$actions[$url]['class'] = 'join-button gwfb';
		} else {
			// request membership
			$actions[$url]['text'] = 'groups:joinrequest';
			$actions[$url]['class'] = 'join-button gwfb';
		}
	}

	if ($actions) {
		foreach ($actions as $url => $text) {
			if (!$actions[$url]['class']) $actions[$url]['class'] = '';
			elgg_register_menu_item('title', array(
				'name' => $text['text'],
				'href' => $url,
				'text' => elgg_echo($text['text']),
				'link_class' => 'elgg-button elgg-button-action ' . $actions[$url]['class'],
			));
		}
	}
}

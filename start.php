<?php

elgg_unregister_event_handler('init', 'system', 'discussion_init');
elgg_register_event_handler('init','system','elgg_ggouv_template_init', 999); // 999 to be sure template is loaded as last

function elgg_ggouv_template_init() {
	$base = elgg_get_plugins_path() . 'elgg-ggouv_template';
		$http_base = '/mod/elgg-ggouv_template';

	elgg_extend_view('css/elgg','ggouv_template/css');
	elgg_extend_view('css/elgg','ggouv_template/bootstrap-responsive');
	elgg_extend_view('css/elgg','ggouv_template/tipsy');
	elgg_extend_view('js/elgg', 'ggouv_template/js');
	elgg_extend_view('page/elements/foot', 'ggouv_template/templates_mustache', 498);

	elgg_register_js('jquery.scrollTo',"$http_base/vendors/jquery.scrollTo-min.js", 'footer');
	elgg_register_js('xoxco.tags',"$http_base/vendors/xoxco_tags/jquery.tagsinput.min.js", 'footer');
	elgg_register_js('carrousel',"$http_base/vendors/carrousel.js", 'footer');
	elgg_register_js('history.js', "$http_base/vendors/jquery.history.js", 'footer');
	elgg_register_js('jquery-validation', "$http_base/vendors/jquery-validation-1.9.0/jquery.validate.min.js", 'footer');
	elgg_register_js('jquery.caretposition', "$http_base/vendors/jquery.caretposition.js", 'footer');
	elgg_register_js('jquery.tipsy', "$http_base/vendors/jquery.tipsy.min.js", 'footer');
	elgg_register_js('responsiveslides', "$http_base/vendors/ResponsiveSlides/responsiveslides.min.js", 'footer');

	elgg_unregister_js('elgg.avatar_cropper');
	elgg_register_js('elgg.avatar_cropper', "$http_base/views/default/js/lib/ui.avatar_cropper.js", 'footer');
	elgg_unregister_js('elgg.autocomplete');
	elgg_register_js('elgg.autocomplete', "$http_base/views/default/js/lib/ui.autocomplete.js", 'footer');

	elgg_register_js('leaflet.js', "$http_base/vendors/leaflet-0.4/leaflet.js", 'footer');

	elgg_register_ajax_view('ggouv_template/ajax/get_city');
	elgg_register_ajax_view('ggouv_template/ajax/form_validation');
	elgg_register_ajax_view('ggouv_template/ajax/site_info_popup');

	// Want it everywhere
	elgg_load_js('jquery.scrollTo');
	elgg_load_js('elgg.userpicker');
	elgg_load_js('elgg.friendspicker');
	elgg_load_js('elgg.autocomplete');
	elgg_load_js('jquery.ui.autocomplete.html');
	elgg_load_js('jquery.easing');
	elgg_load_js('showdown');
	elgg_load_js('highlight');
	elgg_load_js('xoxco.tags');
	elgg_load_js('leaflet.js');
	elgg_load_js('history.js');
	elgg_load_js('jquery-validation');
	elgg_load_js('jquery.caretposition');
	elgg_load_js('jquery.tipsy');
	elgg_load_js('responsiveslides');

	// Hook to change menu
	elgg_register_event_handler('pagesetup', 'system', 'ggouv_custom_menu');
	elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
	elgg_register_plugin_hook_handler('output:before', 'layout', 'ggouv_views_add_rss_link');
	elgg_unregister_plugin_hook_handler('register', 'menu:entity', 'elgg_entity_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'ggouv_entity_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'editablecomments_annotation_menu');

	// hook for function forward to send redirect instead of location when ajax request
	elgg_unregister_plugin_hook_handler('forward', 'all', 'ajax_forward_hook');
	elgg_register_plugin_hook_handler('forward', 'all', 'ggouv_ajax_forward_hook');

	//title ?
	elgg_register_plugin_hook_handler('format', 'friendly:title', 'seo_friendly_url_plugin_hook');

	elgg_register_class('TwitterOAuth', "$base/vendors/twitteroauth/twitterOAuth.php");
	elgg_register_library('twitter_api', "$base/lib/twitter_api.php");
	elgg_register_library('user_ggouv', "$base/lib/users/lib.php");
	elgg_register_library('group_ggouv', "$base/lib/groups/utilities.php");
	elgg_register_library('ggouv:typo', "$base/lib/groups/typo.php");
	elgg_load_library('user_ggouv');
	elgg_load_library('group_ggouv');
	elgg_register_library('elgg:relatedgroups', "$base/lib/groups/relatedgroups.php");

	// Register actions
	elgg_unregister_action('register');
	elgg_register_action('signup', "$base/actions/signup.php", 'public');
	elgg_register_action('signin', "$base/actions/signin.php", 'public');
	elgg_register_action('profile/edit', "$base/actions/edit.php");
	elgg_register_action('editablecomments/edit', "$base/actions/comments/edit.php");
	elgg_register_action('livecomments/add', "$base/actions/comments/add.php");
	elgg_register_action('blog/save', "$base/actions/blog/save.php");
	elgg_register_action('blog/auto_save_revision', "$base/actions/blog/auto_save_revision.php");
	elgg_register_action('invitefriends/invite', "$base/actions/invite.php");
	// Register actions for groups
	elgg_register_action("groups/edit", "$base/actions/groups/edit.php");
	elgg_register_action("relatedgroups/add", "$base/actions/relatedgroups/add.php");
	elgg_register_action("relatedgroups/remove", "$base/actions/relatedgroups/remove.php");

	// extend the comment view with the form
	elgg_extend_view('annotation/generic_comment', 'editablecomments/generic_comment');

	// unextend search view
	elgg_unextend_view('page/elements/header', 'search/header');

//~/Sites/ggouv/ggouv/engine/lib/user_settings.php

	// typo and debate
	elgg_register_page_handler('typo', 'ggouv_template_typo_page_handler');

	// Override members page handler
	elgg_unregister_page_handler('members', 'members_page_handler');
	elgg_register_page_handler('members', 'ggouv_members_page_handler');
	elgg_unregister_page_handler('friends', 'friends_page_handler');
	elgg_register_page_handler('friends', 'ggouv_friends_page_handler');
	elgg_unregister_page_handler('friendsof', 'friends_page_handler');
	elgg_register_page_handler('friendsof', 'ggouv_friends_page_handler');

	// Override register page handler to change case register by signup
	elgg_unregister_page_handler('register');
	elgg_register_page_handler('signup', 'ggouv_user_account_page_handler');
	elgg_unregister_page_handler('twitter_api', 'twitter_api_pagehandler');
	elgg_register_page_handler('twitter_api', 'ggouv_twitter_api_pagehandler');

	// override all site tags page handler
	elgg_unregister_page_handler('tags');
	elgg_register_page_handler('tags', 'ggouv_tagcloud_page_handler');

	// Override user settings
	elgg_unregister_plugin_hook_handler('usersettings:save', 'user', 'users_settings_save');
	elgg_register_plugin_hook_handler('usersettings:save', 'user', 'ggouv_users_settings_save');
	elgg_register_plugin_hook_handler('profile:fields', 'profile', 'ggouv_profile_defaults');
	elgg_register_plugin_hook_handler('entity:icon:url', 'user', 'gravatar_avatar_hook', 900);

	// hook for election
	elgg_register_plugin_hook_handler('election', 'bycandidat', 'ggouv_election_when_candidat_added');

// group settings

	// Override groups page handler
	elgg_register_page_handler('groups', 'ggouv_template_groups_page_handler');
	// Register page handler for relatedgroups
	elgg_register_page_handler('relatedgroups', 'relatedgroups_page_handler');

	// override group entity menu
	elgg_unregister_plugin_hook_handler('register', 'menu:entity', 'groups_entity_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'ggouv_groups_entity_menu_setup');

	// override group icon
	elgg_unregister_plugin_hook_handler('entity:icon:url', 'group', 'groups_icon_url_override');
	elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'ggouv_groups_icon_url_override');

	// groups remove option and enable it by default.
	remove_group_tool_option('activity');
	elgg_unextend_view('groups/tool_latest', 'groups/profile/activity_module');
	//elgg_unregister_plugin_hook_handler('register', 'menu:owner_block', 'groups_activity_owner_block_menu');

	// Extending views for relatedgroups
	elgg_extend_view('groups/sidebar/members', 'groups/sidebar/relatedgroups');

	//unset($CONFIG->events[$event][$object_type]
	// Override groups lib for metagroup, localgroup and typogroup
	elgg_register_library('elgg:groups', "$base/lib/groups/lib.php");
	// write permission plugin hooks
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'ggouv_template_permission_check');
	elgg_register_plugin_hook_handler('container_permissions_check', 'all', 'ggouv_template_container_permission_check');
	//elgg_register_plugin_hook_handler('access:collections:read', 'user', 'ggouv_template_permission_check');

	// Override groups profile fields
	elgg_register_plugin_hook_handler('profile:fields', 'group', 'ggouv_template_groups_fields_setup');

	if (elgg_is_active_plugin('search')) {
		elgg_unextend_view('page/elements/header', 'search/search_box');
		//elgg_extend_view('page/elements/topbar', 'search/search_box');
	}

	//elgg_register_plugin_hook_handler('register', 'menu:composer', 'ggouv_theme_composer_menu_handler');
	elgg_register_plugin_hook_handler('index', 'system', 'ggouv_template_nologin_mainpage');

	// Register an unrelate link to entity menu (max priority to run the last)
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'relatedgroups_related_menu_setup', 9999);

	// Unregister this plugin hook was created to delete like menu item in river. We don't use like plugin.
	elgg_unregister_plugin_hook_handler('register', 'menu:river', 'answers_river_menu_setup');

	// provide link on @user and !group
	//$CONFIG->mentions_user_match_regexp = '/[\b]?@([\p{L}\p{M}_\.0-9]+)[\b]?/iu';
	//$CONFIG->mentions_group_match_regexp = '/[\b]?!([\p{L}\p{M}_\.0-9]+)[\b]?/iu';
	//register_plugin_hook('output', 'page', 'mentions_user_rewrite');
	//register_plugin_hook('output', 'page', 'mentions_group_rewrite');

	//set locale
	$user = elgg_get_logged_in_user_entity();
	setlocale(LC_TIME, $user->language, strtolower($user->language) . '_' . strtoupper($user->language) . '.UTF-8');

	elgg_register_event_handler('login', 'user', 'ggouv_login_user_event');
}


/**
 * Groups page handler
 *
 * URLs take the form of
 *  All groups:           groups/all
 *  User's owned groups:  groups/owner/<username>
 *  User's member groups: groups/member/<username>
 *  Group profile:        groups/profile/<guid>/<title>
 *  New group:            groups/add/<guid>
 *  Edit group:           groups/edit/<guid>
 *  Group invitations:    groups/invitations/<username>
 *  Invite to group:      groups/invite/<guid>
 *  Membership requests:  groups/requests/<guid>
 *  Group activity:       groups/activity/<guid>
 *  Group members:        groups/members/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function ggouv_template_groups_page_handler($page) {

	elgg_load_library('elgg:groups');

	elgg_push_breadcrumb(elgg_echo('groups'), "groups/all");

	switch ($page[0]) {
		case 'all':
			groups_handle_all_page();
			break;
		case 'search':
			groups_search_page();
			break;
		case 'owner':
			groups_handle_owned_page();
			break;
		case 'member':
			set_input('username', $page[1]);
			groups_handle_mine_page();
			break;
		case 'invitations':
			set_input('username', $page[1]);
			groups_handle_invitations_page();
			break;
		case 'add':
			groups_handle_edit_page('add');
			break;
		case 'edit':
			groups_handle_edit_page('edit', $page[1]);
			break;
		case 'profile':
			groups_handle_profile_page($page[1]);
			break;
		case 'activity':
			groups_handle_activity_page($page[1]);
			break;
		case 'members':
			groups_handle_members_page($page[1]);
			break;
		case 'invite':
			groups_handle_invite_page($page[1]);
			break;
		case 'requests':
			groups_handle_requests_page($page[1]);
			break;
		default:
			return false;
	}
	return true;
}


/**
 * typo page handler
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function ggouv_template_typo_page_handler($page) {

	$group = $page[0]; //get_input('group');
	$request = sanitise_string(urlencode(rtrim(get_input('typopage'), '/')));

	if ($guid = search_group_by_title($group)) {
		if ($request) {
			forward(elgg_get_site_url() ."wiki/search?q=$request&container_guid=$guid");
		} else {
			forward(elgg_get_site_url() ."groups/profile/$guid/$group");
		}
	} else {
		echo elgg_view('page/error', $vars);//forward(elgg_get_site_url() ."error/404");
	}

	return true;
}



/**
 * Dispatches related groups pages.
 * URLs take the form of
 *
 *  Group view related groups:      relatedgroups/owner/<group_guid>
 *  Group manage related groups:    relatedgroups/edit/<group_guid>
 *
 * @param array $page
 * @return NULL
 */
function relatedgroups_page_handler($page){

	if (!isset($page[0])) {
		$page[0] = 'owner';
	}

	$base_dir = dirname(__FILE__) . '/pages/relatedgroups';

	switch($page[0]) {
		case 'add':
		case 'edit':
			elgg_set_page_owner_guid($page[1]);
			include "$base_dir/edit.php";
			break;
		case 'owner':
			elgg_set_page_owner_guid($page[1]);
			include "$base_dir/owner.php";
			break;
	}

	elgg_pop_context();

	return true;
}



/**
 * Page handler for account related pages
 *
 * @param array  $page_elements Page elements
 * @param string $handler The handler string
 *
 * @return bool
 * @access private
 */
function ggouv_user_account_page_handler($page_elements, $handler) {
	$base_dir = elgg_get_root_path() . 'mod/elgg-ggouv_template/pages/account';
	switch ($handler) {
		case 'signin':
			require_once("$base_dir/signin.php");
			break;
		case 'forgotpassword':
			require_once("$base_dir/forgotten_password.php");
			break;
		case 'resetpassword':
			require_once("$base_dir/reset_password.php");
			break;
		case 'signup':
			require_once("$base_dir/register.php");
			break;
		default:
			return false;
	}
	return true;
}


/**
 * Members page handler
 *
 * @param array $page url segments
 * @return bool
 */
function ggouv_members_page_handler($page) {
	$base = elgg_get_root_path() . 'mod/elgg-ggouv_template/pages/members';

	if (!isset($page[0])) {
		$page[0] = 'newest';
	}

	$vars = array();
	$vars['page'] = $page[0];

	if ($page[0] == 'search') {
		$vars['search_type'] = $page[1];
		require_once "$base/search.php";
	} else {
		require_once "$base/index.php";
	}
	return true;
}


/**
 * Page handler for friends-related pages
 *
 * @param array  $segments URL segments
 * @param string $handler  The first segment in URL used for routing
 *
 * @return bool
 * @access private
 */
function ggouv_friends_page_handler($page_elements, $handler) {
	$base = elgg_get_root_path() . 'mod/elgg-ggouv_template/pages/friends';
	elgg_set_context('friends');

	if (isset($page_elements[0]) && $user = get_user_by_username($page_elements[0])) {
		elgg_set_page_owner_guid($user->getGUID());
	}
	/*if (elgg_get_logged_in_user_guid() == elgg_get_page_owner_guid()) {
		collections_submenu_items();
	}*/ // @todo see later for collections

	switch ($handler) {
		case 'friends':
			require_once("$base/index.php");
			break;
		case 'friendsof':
			require_once("$base/of.php");
			break;
		default:
			return false;
	}
	return true;
}


/**
 * Serves pages for twitter.
 *
 * @param array $page
 * @return void
 */
function ggouv_twitter_api_pagehandler($page) {
	if (!isset($page[0])) {
		return false;
	}


	elgg_load_library('twitter_api');

	switch ($page[0]) {
		case 'authorize':
			twitter_api_authorize();
			break;
		case 'revoke':
			twitter_api_revoke();
			break;
		case 'forward':
			twitter_api_forward();
			break;
		case 'login':
			twitter_api_login();
			break;
		case 'interstitial':
			gatekeeper();
			// only let twitter users do this.
			$guid = elgg_get_logged_in_user_guid();
			$twitter_name = elgg_get_plugin_user_setting('twitter_name', $guid, 'twitter_api');
			if (!$twitter_name) {
				register_error(elgg_echo('twitter_api:invalid_page'));
				forward();
			}
			$pages = dirname(__FILE__) . '/pages/twitter_api';
			include "$pages/interstitial.php";
			break;
		default:
			return false;
	}
	return true;
}


/**
 * Page hander for tags
 *
 * @param array $page Page array
 *
 * @return bool
 * @access private
 */
function ggouv_tagcloud_page_handler($page) {

	$title = elgg_view_title(elgg_echo('tags:site_cloud'));
	$options = array(
		'threshold' => 0,
		'limit' => 300,
		'tag_name' => 'tags',
	);
	$body = elgg_view_layout('content', array(
		'filter' => '',
		'title' => $title,
		'content' => elgg_view_tagcloud($options)
	));

	echo elgg_view_page(elgg_echo('tags:site_cloud'), $body);
	return true;
}


/**
 * Add the rss link to the extras when if needed
 *
 * @return void
 * @access private
 */
function ggouv_views_add_rss_link() {
	global $autofeed;
	if (isset($autofeed) && $autofeed == true) {
		$url = full_url();
		if (substr_count($url, '?')) {
			$url .= "&view=rss";
		} else {
			$url .= "?view=rss";
		}

		$url = elgg_format_url($url);
		elgg_register_menu_item('extras', array(
			'name' => 'rss',
			'text' => elgg_view_icon('rss'),
			'href' => $url,
			'class' => 'tooltip s',
			'title' => elgg_echo('feed:rss'),
			'target' => '_blank'   // added for ggouv
		));
	}
}



function ggouv_custom_menu() {

	elgg_unregister_menu_item('footer', 'report_this');
	elgg_unregister_menu_item('extras', 'bookmark');

	$user = elgg_get_logged_in_user_entity();
	if ($user) {
		// Extend footer with report content link
		$href = "javascript:elgg.forward('reportedcontent/add'";
		$href .= "+'?address='+encodeURIComponent(location.href)";
		$href .= "+'&title='+encodeURIComponent(document.title));";

		elgg_register_menu_item('extras', array(
			'name' => 'report_this',
			'href' => $href,
			'class' => 'tooltip s',
			'title' => elgg_echo('reportedcontent:this:tooltip'),
			'text' => elgg_view_icon('attention'),
			'priority' => 300,
		));

		if ( elgg_is_active_plugin('bookmarks') ) {
			$user_guid = $user->guid;
			$address = urlencode(current_page_url());

			elgg_register_menu_item('extras', array(
				'name' => 'bookmark',
				'text' => elgg_view_icon('push-pin-alt'),
				'href' => "bookmarks/add/$user_guid?address=$address",
				'title' => elgg_echo('bookmarks:this'),
				'class' => 'tooltip s',
				'rel' => 'nofollow',
				'priority' => 200,
			));
		}
	}

}

function ggouv_template_nologin_mainpage() {
	$force_home = (bool) get_input('home', false);
	if (elgg_is_logged_in() && !$force_home) {

		forward('activity');

	} else {

		$params = array(
				'content' => elgg_view('page/elements/nologin_mainpage_content')
		);
		$body = elgg_view_layout('one_column', $params);
		echo elgg_view_page(null, $body);

	}

	return true;
}



/**
 * Catch calls to forward() in ajax request and force an exit.
 *
 * Forces response is json of the following form:
 * <pre>
 * {
 *     "current_url": "the.url.we/were/coming/from",
 *     "forward_url": "the.url.we/were/going/to",
 *     "system_messages": {
 *         "messages": ["msg1", "msg2", ...],
 *         "errors": ["err1", "err2", ...]
 *     },
 *     "status": -1 //or 0 for success if there are no error messages present
 * }
 * </pre>
 * where "system_messages" is all message registers at the point of forwarding
 *
 * @param string $hook
 * @param string $type
 * @param string $reason
 * @param array $params
 * @return void
 * @access private
 */
function ggouv_ajax_forward_hook($hook, $type, $reason, $params) {
	if (elgg_is_xhr()) {
		// always pass the full structure to avoid boilerplate JS code.
		$params = array(
			'output' => '',
			'status' => 0,
			'system_messages' => array(
				'error' => array(),
				'success' => array()
			),
			'forward_url' => $params['forward_url'], // FULL AJAX
		);

		//grab any data echo'd in the action
		$output = ob_get_clean();

		//Avoid double-encoding in case data is json
		$json = json_decode($output);
		if (isset($json)) {
			$params['output'] = $json;
		} else {
			$params['output'] = $output;
		}

		//Grab any system messages so we can inject them via ajax too
		$system_messages = system_messages(NULL, "");

		if (isset($system_messages['success'])) {
			$params['system_messages']['success'] = $system_messages['success'];
		}

		if (isset($system_messages['error'])) {
			$params['system_messages']['error'] = $system_messages['error'];
			$params['status'] = -1;
		}

		// Added for ggouv. Add code to be executed as javascript
		$code = '';
		foreach (ggouv_execute_js() as $code) {
			$params['js_code'] .= $code;
		}

		// Check the requester can accept JSON responses, if not fall back to
		// returning JSON in a plain-text response.  Some libraries request
		// JSON in an invisible iframe which they then read from the iframe,
		// however some browsers will not accept the JSON MIME type.
		if (stripos($_SERVER['HTTP_ACCEPT'], 'application/json') === FALSE) {
			header("Content-type: text/plain");
		} else {
			header("Content-type: application/json");
		}

		echo json_encode($params);
		exit;
	}
}



/**
 * Saves user settings.
 *
 * @todo this assumes settings are coming in on a GET/POST request
 *
 * @note This is a handler for the 'usersettings:save', 'user' plugin hook
 *
 * @return void
 * @access private
 */
function ggouv_users_settings_save() {
	elgg_set_user_language();
	elgg_set_user_password();
	elgg_set_user_default_access();
	//elgg_set_user_name(); // We skip this because $user->name are the same like $user->username to use @user. $user->name are replaced by $user->realname.
	ggouv_set_user_realname();
	elgg_set_user_email();
}


/**
 * Set a user's display realname. Replace Elgg user name default.
 *
 * @return bool
 * @since 1.8.0
 * @access private
 */
function ggouv_set_user_realname() {
	$name = strip_tags(get_input('realname'));
	$user_id = get_input('guid');

	if (!$user_id) {
		$user = elgg_get_logged_in_user_entity();
	} else {
		$user = get_entity($user_id);
	}

	if (elgg_strlen($name) > 90) {
		register_error(elgg_echo('user:name:fail'));
		return false;
	}

	if (($user) && ($user->canEdit()) && ($name)) {
		if ($name != $user->realname) {
			$user->realname = $name;
			if ($user->save()) {
				system_message(elgg_echo('user:name:success'));
				return true;
			} else {
				register_error(elgg_echo('user:name:fail'));
			}
		} else {
			// no change
			return null;
		}
	} else {
		register_error(elgg_echo('user:name:fail'));
	}
	return false;
}


/**
 * Make metagroup and typo group 'open' to let's users writing to entity without subscribe.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function ggouv_template_permission_check($hook, $entity_type, $returnvalue, $params) {
	if (!$returnvalue && isset($params['entity']) && isset($params['user']) && in_array($params['entity']->getContainerEntity()->getSubtype(), array('metagroup', 'typogroup'))) {
		if (isset($params['entity']->write_access_id) && $params['entity']->write_access_id == 0) return true;
	}
	return $returnvalue;
}


/**
 * Make metagroup and typo group 'open' to let's users writing to container without subscribe.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function ggouv_template_container_permission_check($hook, $entity_type, $returnvalue, $params) {
	if (!$returnvalue && isset($params['user']) && isset($params['container']) && in_array($params['container']->getSubtype(), array('metagroup', 'typogroup'))) {
		return true;
	}
	return $returnvalue;
}


/**
 * Entity menu is list of links and info on any entity
 * @access private
 */
function ggouv_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);

	// access
	if ($entity->access_id != ACCESS_PUBLIC) {
		$access = elgg_view('output/access', array('entity' => $entity));
		$options = array(
			'name' => 'access',
			'text' => $access,
			'item_class' => 'prm',
			'href' => false,
			'priority' => 100,
		);
		$return[] = ElggMenuItem::factory($options);
	}

	if ($entity->canEdit() && $handler) {
		// edit link
		$options = array(
			'name' => 'edit',
			'text' => '&#9998;', // unicode 270E
			'title' => elgg_echo('edit:this'),
			'class' => 'gwf tooltip s t',
			'href' => "$handler/edit/{$entity->getGUID()}",
			'priority' => 200,
		);
		$return[] = ElggMenuItem::factory($options);

		// delete link
		$options = array(
			'name' => 'delete',
			'text' => elgg_view_icon('delete'),
			'title' => elgg_echo('delete:this'),
			'class' => 'tooltip s t',
			'href' => "action/$handler/delete?guid={$entity->getGUID()}",
			'confirm' => elgg_echo('deleteconfirm'),
			'priority' => 300,
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}


/**
 * Add links/info to entity menu particular to group entities
 */
function ggouv_groups_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'groups') {
		return $return;
	}

	foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access', 'likes', 'edit', 'delete'))) {
			unset($return[$index]);
		}
	}

	// membership type
	$membership = $entity->membership;
	if ($membership == ACCESS_PUBLIC) {
		if (in_array( $entity->getSubtype(), array('metagroup', 'typogroup', 'localgroup'))) {
			$mem = elgg_echo("groups:" . $entity->getSubtype());
		} else {
			$mem = elgg_echo("groups:open");
		}
	} else {
		$mem = elgg_echo("groups:closed");
	}
	$options = array(
		'name' => 'membership',
		'text' => $mem,
		'item_class' => 'prs',
		'href' => false,
		'priority' => 100,
	);
	$return[] = ElggMenuItem::factory($options);

	// number of members
	if (!in_array( $entity->getSubtype(), array('metagroup', 'typogroup'))) {
		$num_members = get_group_members($entity->guid, 10, 0, 0, true);
		$members_string = elgg_echo('groups:member');
		$options = array(
			'name' => 'members',
			'text' => $num_members . ' ' . $members_string,
			'item_class' => 'phs',
			'href' => false,
			'priority' => 200,
		);
		$return[] = ElggMenuItem::factory($options);
	}

	// feature link
	if (elgg_is_admin_logged_in()) {
		if ($entity->featured_group == "yes") {
			$url = "action/groups/featured?group_guid={$entity->guid}&action_type=unfeature";
			$wording = elgg_echo("groups:makeunfeatured");
		} else {
			$url = "action/groups/featured?group_guid={$entity->guid}&action_type=feature";
			$wording = elgg_echo("groups:makefeatured");
		}
		$options = array(
			'name' => 'feature',
			'text' => $wording,
			'item_class' => 'pls',
			'href' => $url,
			'priority' => 300,
			'is_action' => true
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}



function relatedgroups_related_menu_setup($hook, $type, $return, $params){

	$group = elgg_get_page_owner_entity();
	$othergroup = $params['entity'];

	if($group instanceof ElggGroup && $group->canEdit() &&
					$othergroup instanceof ElggGroup &&
									elgg_in_context('relatedgroups')){

		// Delete all previous links
		$return = array();

		$url = elgg_http_add_url_query_elements('action/relatedgroups/remove', array(
			'group' => $group->guid,
			'othergroup' => $othergroup->guid,
		));

		$options = array(
			'name' => 'delete',
			'href' => $url,
			'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
			'confirm' => elgg_echo('deleteconfirm'),
			'text_encode' => false,
		);
		$return[] = ElggMenuItem::factory($options);
	}
	return $return;
}



/**
 * Override the default entity icon for groups
 *
 * @return string Relative URL
 */
function ggouv_groups_icon_url_override($hook, $type, $returnvalue, $params) {
	/* @var ElggGroup $group */
	$group = $params['entity'];
	$size = $params['size'];

	$icontime = $group->icontime;
	// handle missing metadata (pre 1.7 installations)
	if (null === $icontime) {
		$file = new ElggFile();
		$file->owner_guid = $group->owner_guid;
		$file->setFilename("groups/" . $group->guid . "large.jpg");
		$icontime = $file->exists() ? time() : 0;
		create_metadata($group->guid, 'icontime', $icontime, 'integer', $group->owner_guid, ACCESS_PUBLIC);
	}
	if ($icontime) {
		// return thumbnail
		return "groupicon/$group->guid/$size/$icontime.jpg";
	}

	if ($group->getSubtype() == 'localgroup') {
		if ($size != 'large') $size = 'small';
		return elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/localgroups_avatars/'. $size . '/' . $group->getGUID() . '.jpg';
	}

	return "mod/groups/graphics/default{$size}.gif";
}



function ggouv_template_groups_fields_setup($hook, $entity_type, $returnvalue, $params) {
	$profile_defaults = array(
		'briefdescription' => 'text140',
		'interests' => 'tags',
		'description' => 'longtext',
	);
	return $profile_defaults;
}

function ggouv_profile_defaults($hook, $entity_type, $returnvalue, $params) {
	$profile_defaults = array(
		'briefdescription' => 'text140',
		'description' => 'longtext',
		'location' => 'text',
		'skills' => 'tags',
		'contactemail' => 'email',
		'website' => 'url',
		'twitter' => 'text',
		'facebook' => 'text'
	);
	return $profile_defaults;
}


/*
 * Hook for metagroup and typogroup when the 10th candidat is added to perform election.
 * We need that because nobody is owner of this kind of group. So nobody can perform election. This is only for the first election
 */
function ggouv_election_when_candidat_added($hook, $entity_type, $returnvalue, $params) {
	$mandat = get_entity($params['mandat']);
	if (!$mandat) {
		register_error(elgg_echo('groups_admins_elections:elect:fail'));
		return;
	}

	$group = get_entity($mandat->container_guid);
	if (!$group) {
		register_error(elgg_echo('groups_admins_elections:elect:fail'));
		return;
	}

	if (!in_array($group->getSubtype(), array('metagroup', 'typogroup', 'localgroup'))) {
		return;
	}

	// check if there was already an election
	$electeds = elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtypes' => 'elected',
		'metadata_name' => 'mandat_guid',
		'metadata_value' => $mandat->guid,
		'limit' => 0,
		'count' => true
	));
	if ($electeds > 0 ) {
		return false;
	}

	elgg_load_library('groups_admins_elections:utilities');
	$elected = gae_perform_election($mandat, 'random', $params['election_triggered_by'], elgg_echo('river_elected_more_message:first_random'));

	$user_elected = get_entity($elected->owner_guid);
	system_message(elgg_echo('groups_admins_elections:elect:success', array($user_elected->name)));

	$user_trigger_election = get_entity($params['election_triggered_by']);
	add_to_river('river/object/elected/create','create', $user_trigger_election->guid, $elected->guid);
}


/**
* This hooks into the getIcon API and returns a gravatar icon
*/
function gravatar_avatar_hook($hook, $type, $url, $params) {

	// check if user already has an icon
	if (!$params['entity']->icontime) {
		$icon_sizes = elgg_get_config('icon_sizes');
		$size = $params['size'];
		if (!in_array($size, array_keys($icon_sizes))) {
			$size = 'small';
		}

		// avatars must be square
		$size = $icon_sizes[$size]['w'];

		$hash = md5($params['entity']->email);
		return "https://secure.gravatar.com/avatar/$hash.jpg?r=pg&d=identicon&s=$size";
	}
}


/**
 * Add a menu item to the annotations
 */
function editablecomments_annotation_menu($hook, $type, $return, $params) {
	if ($params['annotation']->name == 'generic_comment') {


		if ($params['annotation']->canEdit()) {
			$url = "#editablecomments-edit-annotation-" . $params['annotation']->id;
			$options = array(
				'name' => 'comment-edit',
				'text' => '&#9998;', // unicode 270E
				'title' => elgg_echo('comment:edit'),
				'class' => 'gwf tooltip s',
				'href' => $url,
				'rel' => 'toggle',
				'priority' => 90
			);
			$return[] = ElggMenuItem::factory($options);
			return $return;
		}
	}
}


function mentions_user_rewrite($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;

	$returnvalue = preg_replace_callback($CONFIG->mentions_user_match_regexp,
		create_function(
			'$matches',
			'
				global $CONFIG;
				if ($user = get_user_by_username($matches[1])) {
					return "<a href=\"{$user->getURL()}\">{$matches[0]}</a>";
				} else {
					return $matches[0];
				}
			'
	), $returnvalue);

	return $returnvalue;
}

function mentions_group_rewrite($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;

	$returnvalue = preg_replace_callback($CONFIG->mentions_group_match_regexp,
		create_function(
			'$matches',
			'
				global $CONFIG;
				$db_prefix = elgg_get_config("dbprefix");
				$query = "SELECT * from {$CONFIG->dbprefix}groups_entity where name = \'{$matches[1]}\'";
				$dt = get_data($query, "entity_row_to_elggstar");
				if (count($dt) === 1) {
					return "<a href=\"groups/profile/{$dt[0]->guid}/{$matches[1]}\">{$matches[0]}</a>";
				} elseif (count($dt) > 1) {
					return "<a href=\"groups/profile/xxxx/{$matches[1]}\">{$matches[0]}</a>";
				} else {
					return $matches[0];
				}
			'
	), $returnvalue);

	return $returnvalue;
}

/**
 * SEO Friendly Titles for special characters, like accents words.
 * http://core.trac.wordpress.org/browser/branches/3.3/wp-includes/formatting.php line 855
 */
function seo_friendly_url_plugin_hook($hook, $entity_type, $returnvalue, $params) {
    $separator = "dash";
    $lowercase = TRUE;

    if ($entity_type == 'friendly:title') {
        $title = trim($params['title']);
/*
        $title = strip_tags($title);
        $title = preg_replace("`\[.*\]`U","",$title);
        $title = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$title);
        $title = htmlentities($title, ENT_COMPAT, 'utf-8');
        $title = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $title );
        $title = preg_replace( "`&([a-z])(elig);`i","\\1e", $title );
        $title = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $title);

        if ($lowercase === TRUE) {
                $title = strtolower($title);
        }

        if($separator != 'dash') {
                $title = str_replace('-', '_', $title);
            $separator = '_';
        }

        else {
                $separator = '-';
        }

        return trim($title, $separator);*/
        $title = preg_replace('/\//', '-', $title);
        $title = preg_replace('/\s+/', '-', $title);
       	return rawurlencode($title);
    }

}

function ggouv_get_installed_translations() {
	global $CONFIG;

	// Ensure that all possible translations are loaded
	reload_all_translations();

	$installed = array();

	foreach ($CONFIG->translations as $k => $v) {
		$completeness = get_language_completeness($k);
		if (elgg_is_admin_logged_in()) {
			if (($completeness < 100) || ($k == 'en')) { // admins see 0% for EN but we don't care about
				$installed[$k] = elgg_echo($k, array(), $k) . " (" . $completeness . "% " . elgg_echo('complete') . ")";
			}
		} else if ($completeness > 70 || $k == 'en') { // want more than 70% for showing the language
			$installed[$k] = elgg_echo($k, array(), $k);
		}
	}
	return $installed;
}


function ggouv_login_user_event($event, $type, $user) {
	$user_guid = $user->getGUID();

	// not first or second login
	if ($user->prev_last_login != 0) {
		//$user->last_annonce_view;

	} else if($user->last_login != 0) { // second login

	} else { // first login

		// show welcome super-popup
		ggouv_super_popup(array(
			'title' => elgg_echo('signup:welcomemessage:title'),
			'body' => deck_river_wire_filter(elgg_echo('signup:welcomemessage:body'))
		));

		// add user to his local group and add columns of this group
		if ($user->location && $group = get_entity($user->location)) {
			// join user to the group
			$group->join($user);

			// add column in deck
			// get columns user settings. It's first login, so settins doesn't exist. We create it.
			$set = str_replace("&gt;", ">", elgg_get_plugin_setting('default_columns', 'elgg-deck_river'));
			if (!$set) $set = elgg_echo('deck_river:settings:default_column:default');
			eval("\$defaults = $set;");
			// define new column for department group
			$dep = get_entity(get_dep_from_group_guid($user->location));
			$defaults['local']['column-1'] = array(
				'group' => $dep->getGUID(),
				'title' => $dep->name,
				'subtitle' => 'river:group_activity',
				'type' => 'group',
				'network' => 'elgg'
			);
			$defaults['local']['column-2'] = array(
				'group' => $dep->getGUID(),
				'title' => '!' . $dep->name,
				'subtitle' => 'river:group_mentions',
				'type' => 'group_mention',
				'network' => 'elgg'
			);
			// define new column for city group
			$defaults['local']['column-3'] = array(
				'group' => $user->location,
				'title' => $group->name,
				'subtitle' => 'river:group_activity',
				'type' => 'group',
				'network' => 'elgg'
			);
			// define new column for group mentions
			$defaults['local']['column-4'] = array(
				'group' => $user->location,
				'title' => '!' . $group->name,
				'subtitle' => 'river:group_mentions',
				'type' => 'group_mention',
				'network' => 'elgg'
			);
			// set settings
			set_private_setting($user_guid, 'deck_river_settings', serialize($defaults));
		}

		// create user board
		elgg_load_library('workflow:utilities');
		$board = workflow_get_user_board($user_guid);
		// create list 'À faire'
		$list = new ElggObject;
		$list->subtype = 'workflow_list';
		$list->container_guid = $user_guid;
		$list->board_guid = $board->getGUID();
		$list->title = elgg_echo('deck_river:signup:list');
		$list->access_id = $board->access_id;
		$list->order = 0;
		$list->save();
		// create cards
		$site_url = elgg_get_site_url();
		$strings = array(
			'0' => array(elgg_get_plugin_setting('wiki_of_help', 'elgg-ggouv_template'), elgg_get_plugin_setting('faq_of_help', 'elgg-ggouv_template')),
			'1' => array($site_url . 'profile/' . $user->username, $site_url . 'profile/' . $user->username . '/edit'),
			'2' => array($site_url . 'brainstorm/group/' . elgg_get_plugin_setting('objectives_home', 'elgg-ggouv_template') . '/top')
		);
		for ($i=0; $i < 3; $i++) {
			$card = new ElggObject;
			$card->subtype = 'workflow_card';
			$card->container_guid = $user_guid;
			$card->board_guid = $board->getGUID();
			$card->list_guid = $list->getGUID();
			$card->title = elgg_echo('deck_river:signup:card:title:' . $i);
			$card->description = elgg_echo('deck_river:signup:card:description:' . $i, $strings[$i]);
			$card->access_id = $list->access_id;
			$card->order = $i;
			$card->save();
			add_entity_relationship($card->getGUID(), 'assignedto', $user_guid);
		}
	}

}

/**
 * Store some javascript code to be executed when page change in full ajax.
 * @param  Array/String      $code      Some javascript code to be executed
 * @param  Boolean           $count     If true, return number of items
 * @return Boolean/Array                Return true when code is stored / A call with no var (ggouv_execute_js()) return an array of stored items, and clear this array.
 */
function ggouv_execute_js($code = null, $count = false) {
	if (!isset($_SESSION['js_code'])) {
		$_SESSION['js_code'] = array();
	}

	if (!$count) {
		if (!empty($code) && is_array($code)) {
			$_SESSION['js_code'] = array_merge($_SESSION['js_code'], $code);
			return true;
		} else if (!empty($code) && is_string($code)) {
			$_SESSION['js_code'][] = $code;
			return true;
		} else if (is_null($code)) {
			$returnarray = $_SESSION['js_code'];
			$_SESSION['js_code'] = array(); // clear variable fo this session
			return $returnarray;
		}
	} else {
		return count($_SESSION['js_code']);
	}
	return false;
}


/**
 * Show a super popup
 * @param  [type] $params params of js function
 */
function ggouv_super_popup($params) {
	$params = json_encode($params);
	$script = <<<TEXT
$(document).ready(function() {
	ggouv.super_popup.create($params);
});
TEXT;

	ggouv_execute_js($script);
}







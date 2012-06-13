<?php

elgg_register_event_handler('init','system','elgg_ggouv_template_init');

function elgg_ggouv_template_init() {
	global $CONFIG;
	$base = elgg_get_plugins_path() . 'elgg_ggouv_template';
	
	elgg_extend_view('css/elgg','ggouv_template/css');
	//elgg_register_js('jquery.livequery', '/mod/facebook_theme/vendors/jquery.livequery-1.1.1/jquery.livequery.min.js', 'footer');
	elgg_extend_view('js/elgg', 'ggouv_template/js');

	elgg_register_css('css.nologin.mainpage',"/mod/elgg_ggouv_template/views/default/ggouv_template/nologin_mainpage.css");
	elgg_register_js('js.nologin.mainpage',"/mod/elgg_ggouv_template/views/default/ggouv_template/nologin_mainpage.js");
	elgg_register_js('jquery.scrollTo',"/mod/elgg_ggouv_template/views/default/ggouv_template/jquery.scrollTo-min.js");

	elgg_register_event_handler('pagesetup', 'system', 'ggouv_custom_menu');

	elgg_register_plugin_hook_handler('format', 'friendly:title', 'seo_friendly_url_plugin_hook');
    
    elgg_register_library('user_ggouv', "$base/lib/user/lib.php");
	elgg_load_library('user_ggouv');

	// Register actions
	elgg_register_action("ggouv_template/header_input", "$base/actions/add.php");
	elgg_register_action('register', "$base/actions/register.php", 'public');
	elgg_register_action('profile/edit', "$base/actions/edit.php");

	// groups remove option and enable it by default.
	remove_group_tool_option('activity');
	elgg_unextend_view('groups/tool_latest', 'groups/profile/activity_module');
	
	if (elgg_is_active_plugin('search')) {
		//elgg_unextend_view('page/elements/header', 'search/search_box');
		//elgg_extend_view('page/elements/topbar', 'search/search_box');
	}

	//elgg_register_plugin_hook_handler('register', 'menu:composer', 'ggouv_theme_composer_menu_handler');
	elgg_register_plugin_hook_handler('index', 'system', 'elgg_ggouv_template_nologin_mainpage');

	// Want ggouv logo present, not Elgg's

	// provide link on @user and !group
	//$CONFIG->mentions_user_match_regexp = '/[\b]?@([\p{L}\p{M}_\.0-9]+)[\b]?/iu';
	//$CONFIG->mentions_group_match_regexp = '/[\b]?!([\p{L}\p{M}_\.0-9]+)[\b]?/iu';
	//register_plugin_hook('output', 'page', 'mentions_user_rewrite');
	//register_plugin_hook('output', 'page', 'mentions_group_rewrite');



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
				'rel' => 'nofollow',
				'priority' => 200,
			));
		}
	}

}

function elgg_ggouv_template_nologin_mainpage() {
	
	if (elgg_is_logged_in()) {
	
		forward('activity');
		
	} else {
		
		elgg_load_css('css.nologin.mainpage');
		elgg_load_js('js.nologin.mainpage');
		elgg_load_js('jquery.scrollTo');
		
		$params = array(
				'content' => elgg_view('page/elements/nologin_mainpage_content')
		);
		$body = elgg_view_layout('one_column', $params);
		echo elgg_view_page(null, $body);
	
	}
	
	return true;
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
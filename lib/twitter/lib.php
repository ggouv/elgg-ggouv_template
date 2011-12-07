<?php
/**
 * Create a new user from Twitter information
 * 
 * @param object $twitter Twitter OAuth response
 * @return ElggUser
 */
function ggouv_twitter_api_create_user($twitter) {
	// check new registration allowed
	if (!twitter_api_allow_new_users_with_twitter()) {
		register_error(elgg_echo('registerdisabled'));
		forward();
	}

	// Elgg-ify Twitter credentials
	$username = $twitter->screen_name;
	while (get_user_by_username($username)) {
		// @todo I guess we just hope this is good enough
		$username = $twitter->screen_name . '_' . rand(1000, 9999);
	}

	$password = generate_random_cleartext_password();
	$name = $twitter->name;

	$user = new ElggUser();
	$user->username = $username;
	$user->name = $username;
	$user->realname = $name;
	$user->twitter = $name;
	$user->access_id = ACCESS_PUBLIC;
	$user->salt = generate_random_cleartext_password();
	$user->password = generate_user_password($user, $password);
	$user->owner_guid = 0;
	$user->container_guid = 0;

	if (!$user->save()) {
		register_error(elgg_echo('registerbad'));
		forward();
	}

	return $user;
}

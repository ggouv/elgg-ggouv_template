<?php
/**
 * Registers a user, returning false if the username already exists
 *
 * @param string $username              The username of the new user
 * @param string $password              The password
 * @param string $name                  The user's display name
 * @param string $email                 Their email address
 * @param bool   $allow_multiple_emails Allow the same email address to be
 *                                      registered multiple times?
 * @param int    $friend_guid           GUID of a user to friend once fully registered
 * @param string $invitecode            An invite code from a friend
 *
 * @return int|false The new user's GUID; false on failure
 */
function ggouv_register_user($username, $password, $name, $email,
$allow_multiple_emails = false, $friend_guid = 0, $invitecode = '') {

	// Load the configuration
	global $CONFIG;

	// no need to trim password.
	$username = trim($username);
	$name = trim(strip_tags($name));
	$email = trim($email);

	// A little sanity checking
	if (empty($username)
	|| empty($password)
	|| empty($name)
	|| empty($email)) {
		return false;
	}

	// Make sure a user with conflicting details hasn't registered and been disabled
	$access_status = access_get_show_hidden_status();
	access_show_hidden_entities(true);

	if (!validate_email_address($email)) {
		throw new RegistrationException(elgg_echo('registration:emailnotvalid'));
	}

	if (!validate_password($password)) {
		throw new RegistrationException(elgg_echo('registration:passwordnotvalid'));
	}

	if (!validate_username($username)) {
		throw new RegistrationException(elgg_echo('registration:usernamenotvalid'));
	}

	if ($user = get_user_by_username($username)) {
		throw new RegistrationException(elgg_echo('registration:userexists'));
	}

	if ((!$allow_multiple_emails) && (get_user_by_email($email))) {
		throw new RegistrationException(elgg_echo('registration:dupeemail'));
	}

	access_show_hidden_entities($access_status);

	// Create user
	$user = new ElggUser();
	$user->username = $username;
	$user->email = $email;
	$user->name = $username;
	$user->realname = $name;
	$user->access_id = ACCESS_PUBLIC;
	$user->salt = generate_random_cleartext_password(); // Note salt generated before password!
	$user->password = generate_user_password($user, $password);
	$user->owner_guid = 0; // Users aren't owned by anyone, even if they are admin created.
	$user->container_guid = 0; // Users aren't contained by anyone, even if they are admin created.
	$user->save();

	// If $friend_guid has been set, make mutual friends
	if ($friend_guid) {
		if ($friend_user = get_user($friend_guid)) {
			if ($invitecode == generate_invite_code($friend_user->username)) {
				$user->addFriend($friend_guid);
				$friend_user->addFriend($user->guid);

				// @todo Should this be in addFriend?
				add_to_river('friends/river/create', 'friend', $user->getGUID(), $friend_guid);
				add_to_river('friends/river/create', 'friend', $friend_guid, $user->getGUID());
			}
		}
	}

	// Turn on email notifications by default
	set_user_notification_setting($user->getGUID(), 'email', true);

	return $user->getGUID();
}




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
	$user->twitter = $twitter->screen_name;
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



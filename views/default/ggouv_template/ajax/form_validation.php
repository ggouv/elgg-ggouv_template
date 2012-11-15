<?php
/**
 *	Ggouv_template plugin
 *	@package elgg-ggouv_template
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license GNU Affero General Public License, version 3 or late
 *	@link https://github.com/ggouv/elgg-ggouv_template
 **/
 
$username = get_input('username', false);
$location = get_input('location', false);

if ($username) {
	try {
		validate_username(trim($username));
	} catch (Exception $e) {
		echo 'false';
		return;
	}
	if (get_user_by_username($username)) { // already exist !
		echo 'false';
	} else {
		echo 'true';
	}
}

if ($location) {
	if ($user) { // already exist !
		echo 'true';
	} else {
		echo '"épeaépea"';
	}
}
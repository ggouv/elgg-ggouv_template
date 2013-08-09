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
		echo json_encode(false);
		return;
	}
	if (get_user_by_username($username)) { // already exist !
		echo json_encode(false);
	} else {
		echo json_encode(true);
	}

} else if ($location) {

	if (is_numeric($location)) {
		echo json_encode(get_data_ville_by_cp($location));
	} else {
		echo json_encode(false);
	}

} else {
	echo json_encode(false);
}
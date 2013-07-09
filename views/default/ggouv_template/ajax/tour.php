<?php
	$user = elgg_get_logged_in_user_entity();
	if (elgg_view_exists("ggouv_template/tour/{$user->language}")) {
		echo elgg_view("ggouv_template/tour/{$user->language}");
	} else {
		echo elgg_view('ggouv_template/tour/en');
	}
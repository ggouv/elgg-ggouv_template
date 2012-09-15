<?php
/**
 * Provide a way of setting your full name.
 *
 * @package Elgg
 * @subpackage Core
 */

$user = elgg_get_page_owner_entity();
if ($user) {

	echo "<h1>{$user->realname}</h1>";
	echo "<h2 class='mvm' style='font-weight:normal;'>@{$user->username}</h2>";

	$title = elgg_echo('user:name:label');
	$content = elgg_echo('realname') . ': ';
	$content .= elgg_view('input/text', array(
		'name' => 'realname',
		'value' => $user->realname,
	));
	echo elgg_view_module('info', $title, $content);

	// need the user's guid to make sure the correct user gets updated
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $user->guid));
}

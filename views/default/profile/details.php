<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
 */

$user = elgg_get_page_owner_entity();

$profile_fields = elgg_get_config('profile_fields');

echo '<ul class="user-stats mbm">';

$followers = elgg_get_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => $user->getGUID(),
	'inverse_relationship' => true,
	'count' => true,
	'limit' => 0
));
echo '<li><div class="stats">' . $followers . '</div>' . elgg_echo('friends:followers') . '</li>';

$following = elgg_get_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => $user->getGUID(),
	'inverse_relationship' => FALSE,
	'count' => true,
	'limit' => 0
));
echo '<li><div class="stats">' . $following . '</div>' . elgg_echo('friends:following') . '</li>';

$messages = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'thewire',
	'owner_guid' => $user->guid,
	'count' => true,
	'limit' => 0
));
echo '<li><div class="stats">' . $messages . '</div>' . elgg_echo('item:object:thewire') . '</li>';

$ideas = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
	'owner_guid' => $user->guid,
	'count' => true,
	'limit' => 0
));
echo '<li><div class="stats">' . $ideas . '</div>' . elgg_echo('item:object:idea') . '</li>';

echo '</ul>';

$even_odd = null;
if (is_array($profile_fields) && sizeof($profile_fields) > 0) {
	foreach ($profile_fields as $shortname => $valtype) {
		if ($shortname == "description") {
			// skip about me and put at bottom
			continue;
		}
		if ($shortname == "briefdescription") {
			continue; //skip
		}
		$value = $user->$shortname;
		if (!empty($value)) {
			//This function controls the alternating class
			$even_odd = ( 'odd' != $even_odd ) ? 'odd' : 'even';
			?>
			<div class="<?php echo $even_odd; ?>">
				<?php
					echo '<b>' . elgg_echo("profile:{$shortname}") .'&nbsp;: </b>';
					if ($shortname == "twitter") {
						$twitter = elgg_get_plugin_user_setting('twitter_name', $user->guid, 'twitter_api');
						if (!$twitter) $twitter = $user->twitter;
						echo "<a target='_blank' href='http://twitter.com/{$twitter}' rel='me'>{$twitter}</a>";
					} else if ($shortname == "location") {
						echo elgg_view('output/url', array(
							'href' => "groups/profile/{$user->$shortname}",
							'text' => '!' . $user->$shortname,
							'is_trusted' => true,
						));
					} else {
						echo elgg_view("output/{$valtype}", array('value' => $user->$shortname));
					}
				?>
			</div>
			<?php
		}
	}
}

echo '<div class="even"><b>' . elgg_echo("profile:time_created") . '&nbsp;: </b>' . elgg_get_friendly_time($user->time_created) . '</div>';

if (!elgg_get_config('profile_custom_fields')) {
	if ($user->isBanned()) {
		echo "<p class='profile-banned-user'>";
		echo elgg_echo('banned');
		echo "</p>";
	} else {
		if ($user->description) {
		$rand = rand(); // make this when we display user-info popup in the page of the same user
			echo '<p class="profile-aboutme-title"><a href="#profile-aboutme-contents-' . $rand . '" class="elgg-widget-collapse-button elgg-state-active elgg-widget-collapsed" rel="toggle">&nbsp;'. elgg_echo("profile:aboutme") .'</a>';
			//echo "<p class='profile-aboutme-title'><b>" . elgg_echo("profile:aboutme") . "</b>";
			echo "<div id='profile-aboutme-contents-" . $rand . "' class='hidden'>";
			echo elgg_view('output/longtext', array('value' => $user->description, 'class' => 'mtn'));
			echo "</div></p>";
		}
	}
}

echo '</div>';
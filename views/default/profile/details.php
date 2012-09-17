<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
 */

$user = elgg_extract('user', $vars, elgg_get_page_owner_entity());
$profile_fields = elgg_get_config('profile_fields');

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
						echo "<a target='_blank' href='http://twitter.com/{$user->twitter}' rel='me'>{$user->twitter}</a>";
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
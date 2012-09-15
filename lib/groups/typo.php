<?php
/**
 * Get group by title
 *
 * @param string $group The title's group
 *
 * @return GUID|false Depending on success
 */
function search_group_by_title($group) {
	global $CONFIG, $GROUP_TITLE_TO_GUID_MAP_CACHE;

	$group = sanitise_string($group);

	// Caching
	if ((isset($GROUP_TITLE_TO_GUID_MAP_CACHE[$group]))
	&& (retrieve_cached_entity($GROUP_TITLE_TO_GUID_MAP_CACHE[$group]))) {
		return retrieve_cached_entity($GROUP_TITLE_TO_GUID_MAP_CACHE[$group]);
	}

	$guid = get_data("SELECT guid from {$CONFIG->dbprefix}groups_entity where name='$group'");

	if ($guid) {
		$GROUP_TITLE_TO_GUID_MAP_CACHE[$group] = $guid[0]->guid;
	} else {
		$guid = false;
	}

	if ($guid) {
		return $guid[0]->guid;
	} else {
		return false;
	}
}
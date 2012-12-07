<?php
	$group_guid = get_input('group');
	$othergroup_guid = get_input('othergroup');
	$group = get_entity($group_guid);
	$othergroup = get_entity($othergroup_guid);
	if ($group instanceof ElggGroup && $group->canEdit()) {
		if (check_entity_relationship($group_guid, 'related', $othergroup_guid)) {
			remove_entity_relationship($group_guid, 'related', $othergroup_guid);
		}
	}
	forward("/relatedgroups/add/$group_guid");
?>

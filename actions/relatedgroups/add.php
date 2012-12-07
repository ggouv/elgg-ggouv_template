<?php

elgg_load_library('elgg:relatedgroups');

$group_guid = get_input('group');
$othergroup_guid = get_input('othergroup');
$group = get_entity($group_guid);
$othergroup = get_entity($othergroup_guid);


if ($group instanceof ElggGroup && $group->canEdit() && $othergroup instanceof ElggGroup && $group_guid != $othergroup_guid) {
	if (!check_entity_relationship($group_guid, 'related', $othergroup_guid) && $group_guid != $othergroup_guid) {
		add_entity_relationship($group_guid, 'related', $othergroup_guid);
	}
}
else{
	register_error(elgg_echo('relatedgroups:add:error'));
}
forward("/relatedgroups/add/$group_guid");

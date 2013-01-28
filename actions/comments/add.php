<?php
/**
 * Elgg add comment action
 *
 * @package Elgg.Core
 * @subpackage Comments
 */
$view = get_input('viewType', true);
$entity_guid = (int) get_input('entity_guid');
$comment_text = get_markdown_input($_REQUEST['generic_comment']);

if (empty($comment_text)) {
	register_error(elgg_echo("generic_comment:blank"));
	forward(REFERER);
}

// Let's see if we can get an entity with the specified GUID
$entity = get_entity($entity_guid);
if (!$entity) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();

$annotation = create_annotation($entity->guid,
								'generic_comment',
								$comment_text,
								"",
								$user->guid,
								$entity->access_id);

// tell user annotation posted
if (!$annotation) {
	register_error(elgg_echo("generic_comment:failure"));
	forward(REFERER);
}

// notify if poster wasn't owner
if ($entity->owner_guid != $user->guid) {

	notify_user($entity->owner_guid,
				$user->guid,
				elgg_echo('generic_comment:email:subject'),
				elgg_echo('generic_comment:email:body', array(
					$entity->title,
					$user->name,
					$comment_text,
					$entity->getURL(),
					$user->name,
					$user->getURL()
				))
			);
}

// list the last comment
$options = array(
	'guid' => $entity_guid,
	'annotation_name' => 'generic_comment',
	'pagination' => false,
	'reverse_order_by' => true,
	'full_view' => $view,
	'limit' => 1
);
echo elgg_list_annotations($options);

system_message(elgg_echo("generic_comment:posted"));

//add to river
add_to_river('river/annotation/generic_comment/create', 'comment', $user->guid, $entity->guid, "", 0, $annotation);

// Forward to the page the action occurred on
forward(REFERER);

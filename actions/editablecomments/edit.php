<?php

// Get the required variables
$annotation_id = get_input("annotation_id");
$post_comment = get_input("postComment");
$annotation = get_annotation($annotation_id);
$commentOwner = $annotation->owner_guid;
$access_id = $annotation->access_id;
		
if($annotation && $annotation->canEdit()){
	// Can edit? Either the comment owner or admin can
	$result = update_annotation($annotation_id, "generic_comment", $post_comment, "",$commentOwner, $access_id);
global $fb; $fb->info(get_annotation($annotation_id));
	if($result){
		system_message(elgg_echo("comment:edited"));
		$options = array(
			'annotation_id' => $annotation_id,
			'pagination' => false,
			'limit' => 1
		);
		echo elgg_list_annotations($options);
		echo get_annotation($annotation_id);
		//forward($annotation->getEntity()->getURL());
	}
}
else{
	system_message(elgg_echo("comment:error"));
}
		
//forward(REFERER); 

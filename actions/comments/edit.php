<?php

// Get the required variables
$annotation_id = get_input("annotation_id");
$post_comment = get_markdown_input($_REQUEST['postComment']);
$annotation = elgg_get_annotation_from_id($annotation_id);
$commentOwner = $annotation->owner_guid;
$access_id = $annotation->access_id;

if($annotation && $annotation->canEdit()){
	// Can edit? Either the comment owner or admin can
	$result = update_annotation($annotation_id, "generic_comment", $post_comment, "",$commentOwner, $access_id);

	if($result){
		system_message(elgg_echo("comment:edited"));
		$options = array(
			'annotation_id' => $annotation_id,
			'pagination' => false,
			'limit' => 1
		);
		//echo elgg_list_annotations($options);
		echo elgg_get_annotation_from_id($annotation_id)->value;
	}
}
else{
	system_message(elgg_echo("comment:error"));
}

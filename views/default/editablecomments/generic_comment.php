<?php

if ($vars['annotation']->canEdit()) {
	echo "<div class=\"editablecomments-form hidden phl mam\" id=\"editablecomments-edit-annotation-{$vars['annotation']->id}\">";
		echo elgg_view_form('editablecomments/edit', array(), array('annotation' => $vars['annotation']));
	echo "</div>";
}

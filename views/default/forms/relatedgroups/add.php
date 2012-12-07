<div>
	<label class="relatedgroups-add-autocomplete"><?php echo elgg_echo('relatedgroups:add:label'); ?></label><br />
	<?php
		echo elgg_view('input/autocomplete', array(
			'name' => 'othergroup',
			'match_on' => 'groups'
		)); ?>
</div>
<div class="elgg-foot">
<?php
	echo elgg_view('input/hidden', array(
		'name' => 'group',
		'value' => $vars['group']->guid));
	echo elgg_view('input/submit', array(
		'value' => elgg_echo('relatedgroups:add:button')));
?>
</div>

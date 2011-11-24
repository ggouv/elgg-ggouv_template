<?php
/**
 * Wire add form body
 *
 * @uses $vars['post']
 */

elgg_load_js('elgg.thewire');

$post = elgg_extract('post', $vars);

$text = elgg_echo('post');
if ($post) {
	$text = elgg_echo('thewire:reply');
}

if ($post) {
	echo elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $post->guid,
	));
}
?>

<div id="thewire-header">
	<textarea id="thewire-textarea" name="body"></textarea>
	<div id="thewire-characters-remaining">
		<span>140</span>
	</div>
	<div class="thewire-button">
	<?php
		echo elgg_view('input/submit', array(
			'value' => elgg_echo('post'),
			'id' => 'thewire-submit-button'
		));
	?>
	</div>
</div>
<div id="thewire-header-inactive"></div>

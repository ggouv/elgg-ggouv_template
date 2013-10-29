<?php
/**
 * Displays an autocomplete text input.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @todo This currently only works for ONE AUTOCOMPLETE TEXT FIELD on a page.
 *
 * @uses $vars['value']       Current value for the text input
 * @uses $vars['match_on']    Array | str What to match on. all|array(groups|users|friends)
 * @uses $vars['match_owner'] Bool.  Match only entities that are owned by logged in user.
 * @uses $vars['class']       Additional CSS class
 */

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-autocomplete {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-autocomplete";
}

$defaults = array(
	'value' => '',
	'disabled' => false,
);

$vars = array_merge($defaults, $vars);

$params = array();
if (isset($vars['match_on'])) {
	$params['match_on'] = $vars['match_on'];
	unset($vars['match_on']);
}
if (isset($vars['match_owner'])) {
	$params['match_owner'] = $vars['match_owner'];
	unset($vars['match_owner']);
}
$ac_url_params = http_build_query($params);

$vars['aria-source'] = elgg_get_site_url() . 'livesearch?' . $ac_url_params;

if (is_array($params['match_on']) || !isset($params['match_on']) || $params['match_on'] == 'all') {
	$placeholder = elgg_echo('autocomplete:placeholder:all');
} else {
	$placeholder = elgg_echo('autocomplete:placeholder:' . $params['match_on']);
}

$value = $vars['value'];
if ($value && is_int(intval($value))) {
	$entity = get_entity($value);
	if ($entity->getType() == 'group') {
		$vars['value'] = $entity->name;
	} else {
		$vars['value'] = $entity->username;
	}
}

?>

<input type="text" data-original_value="<?php echo $value; ?>" <?php echo elgg_format_attributes($vars); ?> placeholder="<?php echo $placeholder;?>"/>
<input type="hidden" name="<?php echo $vars['name']; ?>" value="<?php echo $value; ?>" />
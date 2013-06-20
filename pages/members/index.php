<?php
/**
 * Members index
 *
 */

$num_members = get_number_users();

$title = elgg_echo('gitoyens');

$options = array(
	'type' => 'user',
	'full_view' => false,
	'split_items' => 3,
	'size' => 'small',
	'limit' => 24
);

switch ($vars['page']) {
	/*case 'popular':
		$options['relationship'] = 'friend';
		$options['inverse_relationship'] = false;
		$content = elgg_list_entities_from_relationship_count($options);
		break;*/
	case 'random':
		$options['order_by'] = 'rand()';
		$options['pagination'] = false;
		$content = elgg_list_entities($options);
		break;
	case 'online':
		$content = ggouv_get_online_users();
		break;
	case 'newest':
	default:
		$content = elgg_list_entities($options);
		break;
}

$params = array(
	'content' => $content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $num_members . ' ' . strtolower($title),
	'filter_override' => elgg_view('members/nav', array('selected' => $vars['page'])),
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

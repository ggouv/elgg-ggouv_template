<?php
/**
 * Group module (also called a group widget)
 *
 * @uses $vars['title']    The title of the module
 * @uses $vars['content']  The module content
 * @uses $vars['all_link'] A link to list content
 * @uses $vars['add_link'] A link to create content
 */

$group = elgg_get_page_owner_entity();

$title = $vars['title'];

$nb = strlen($title);
$nbMil = floor($nb/2);
$pEspace = strrpos(substr($title, 0, $nbMil), " ");
if (!$pEspace) $pEspace = strrpos(substr($title, $nbMil, $nb), " ") + $nbMil;
$title = substr($title , 0 , $pEspace) . '<br/>' . substr($title , $pEspace , $nb);

if (!$vars['stats']) $vars['stats'] = 0;

$header = elgg_view('output/url', array(
	'href' => "$vars[all_link]",
	'text' => '<div class="stats mls mrm">' . $vars['stats'] . '</div><h3>' . $title . '</h3>',
	'is_trusted' => true,
));

if ($group->canWriteToContainer() && isset($vars['add_link'])) {
	$vars['content'] .= "<span class='elgg-widget-more'>{$vars['add_link']}</span>";
}

echo '<li>';
echo elgg_view_module('info', '', $vars['content'], array(
	'header' => $header,
	'class' => 'elgg-module-group',
));
echo '</li>';

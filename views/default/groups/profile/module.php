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

$nb = mb_strlen($title);
$nbMil = floor($nb/2);
$pEspace = mb_strrpos(mb_substr($title, 0, $nbMil), " ");
if (!$pEspace) $pEspace = mb_strpos($title, " ");// + $nbMil;
$title = mb_substr($title , 0 , $pEspace) . '<br/>' . mb_substr($title , $pEspace , $nb);

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

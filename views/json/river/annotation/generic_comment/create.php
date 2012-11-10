<?php
/**
 * JSON comment river view
 *
 * @uses $vars['item']
 */

global $jsonexport;
elgg_load_library('markdown_wiki:markdown');

$comment = $vars['item']->getAnnotation();

$vars['item']->summary = elgg_view('river/elements/summary', array('item' => $vars['item']), FALSE, FALSE, 'default');
$vars['item']->message = deck_river_wire_filter(elgg_get_excerpt(Markdown($comment->value), 140));

$jsonexport['activity'][] = $vars['item'];
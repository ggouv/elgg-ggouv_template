<?php
/**
 * Elgg tagcloud
 * Displays a tagcloud
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['tagcloud'] An array of stdClass objects with two elements: 'tag' (the text of the tag) and 'total' (the number of elements with this tag)
 * @uses $vars['format'] String Format of the tag cloud. Default 'cloud'
 * @uses $vars['value'] Sames as tagcloud
 * @uses $vars['type'] Entity type
 * @uses $vars['subtype'] Entity subtype
 */

if (!empty($vars['subtype'])) {
	$subtype = "&entity_subtype=" . urlencode($vars['subtype']);
} else {
	$subtype = "";
}
if (!empty($vars['type'])) {
	$type = "&entity_type=" . urlencode($vars['type']);
} else {
	$type = "";
}

if (empty($vars['tagcloud']) && !empty($vars['value'])) {
	$vars['tagcloud'] = $vars['value'];
}

$format = elgg_extract('format', $vars, 'cloud');

/* Tag size calculation
 *
 * multiplier = (maxPercent-minPercent)/(max-min);
 * size = minPercent + ((max-(max-(count-min)))*multiplier);
 */
if (!empty($vars['tagcloud']) && is_array($vars['tagcloud'])) {

	if ($format == 'list') {

		foreach ($vars['tagcloud'] as $key => $tag) {
			if ($tag->tag == '0') { // sometimes we got a tag name with 0 ??
				unset($vars['tagcloud'][$key]);
			}
		}

		foreach ($vars['tagcloud'] as $tag) {
			$url = "search?q=". urlencode($tag->tag) . "&search_type=tags$type$subtype";

			$cloud .= '<li class="elgg-tag">' . elgg_view('output/url', array(
				'text' => $tag->tag,
				'href' => $url,
				'rel' => 'tag'
			)) . '  x ' . $tag->total . '</li>';
		}

		$cloud .= elgg_view('tagcloud/extend');

		echo "<div class=\"elgg-taglist pvs\"><ul>$cloud</ul></div>";

	} else {

		$maxPercent = 200;
		$minPercent = 85;
		$max = 0;
		$min = 9999;

		foreach ($vars['tagcloud'] as $key => $tag) {
			if ($tag->tag == '0') { // sometimes we got a tag name with 0 ??
				unset($vars['tagcloud'][$key]);
			} else {
				if ($tag->total > $max) {
					$max = $tag->total;
				}
				if ($tag->total < $min) {
					$min = $tag->total;
				}
			}
		}

		$cloud = '';
		$multiplier = ($maxPercent - $minPercent) / ($max - $min);
		foreach ($vars['tagcloud'] as $tag) {
			$size = $minPercent + (($max - ($max - ($tag->total - $min))) * $multiplier); //round((log($tag->total) / log($max + .0001)) * 150) + 75;

			$url = "search?q=". urlencode($tag->tag) . "&search_type=tags$type$subtype";

			$cloud .= elgg_view('output/url', array(
				'text' => $tag->tag,
				'href' => $url,
				'class' => 'tooltip s',
				'style' => "font-size: $size%;",// opacity: $size",
				'title' => elgg_echo('tagtitle', array($tag->total, elgg_echo('item:object:'.$vars['subtype']))),
				'rel' => 'tag'
			));
		}

		$cloud .= elgg_view('tagcloud/extend');

		echo "<div class=\"elgg-tagcloud elgg-tag pvs\">$cloud</div>";

	}
}

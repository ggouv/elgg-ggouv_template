<?php
echo "<div class=\"spotlight-module\">";
echo "<h2>{$vars['title']}</h2>";

echo "<ul>";

foreach($vars['items'] as $item_url => $item_label) {
	echo "<li>".elgg_view('output/url', array(
	'href' => $item_url,
	'text' => $item_label,
	'is_trusted' => true,
	))."</li>";
}

echo "</ul>";
echo "</div>";
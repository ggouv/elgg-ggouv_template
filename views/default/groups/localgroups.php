<?php
/**
 *	Elgg-workflow plugin
 *	@package elgg-workflow
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license GNU Affero General Public License, version 3 or late
 *	@link https://github.com/ggouv/elgg-ggouv_template
 *
 *	Elgg-ggouv_template localgroups search
 *
 */

echo '<h3 class="mbs">' . elgg_echo('ggouv:search:localgroups') . '</h3>';

echo '<div style="position:relative;">';
echo elgg_view('input/text', array(
	'name' => 'body',
	'class' => 'mbm',
	'id' => 'search-localgroup',
));

echo '<div id="searching"></div></div>';

echo '<div id="map"></div>';
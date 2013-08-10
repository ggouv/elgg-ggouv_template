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

?>

<script language="Javascript">
	$(document).ready(function() {

		$('#map').height($(window).height() - $('#map').position().top - 68);

		var villes = new L.FeatureGroup();

		$("#search-localgroup").searchlocalgroup({
			beforeSendCallback: function() {
				$('label[for="location"]').addClass('hidden');
			},
			successCallback: function(response) {
				if (response) {
					if (map.hasLayer(villes)) {
						villes.clearLayers();
						map.removeLayer(villes);
					}

					var LeafletPopup = Mustache.compile($('#leaflet-popup-template').html()),
						maxHab = 0,
						maxHabKey = 0,
						markers = [];

					$.each(response, function(key, value) {
						markers[key] = L.marker([value.lat, value.long]).bindPopup(LeafletPopup(value));
						if (parseFloat(value.habitants30122008) > maxHab) {
							maxHabKey = key;
							maxHab = parseFloat(value.habitants30122008);
						}
						villes.addLayer(markers[key]);
					});
					map.addLayer(villes).fitBounds(villes.getBounds());
					markers[maxHabKey].openPopup();
				} else {
					$('#searching').addClass('notfound').html(elgg.echo('ggouv:search:localgroups:notfound'));
				}
			}
		});

	});

	$(window).bind("resize", function() {
		$('#map').height(($(window).height() - $('#map').position().top) - 68);
	});
</script>
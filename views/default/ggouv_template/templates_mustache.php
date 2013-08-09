


<!-- Template for super-popup -->
<script id="super-popup-template" type="text/template">
	<div id="super-popup" class="{{size}}">
		{{#title}}
		<div class="elgg-head">
			<h2>{{title}}</h2>
		</div>
		{{/title}}
		{{#close}}
		<a href="#">
			<span class="elgg-icon elgg-icon-delete-alt"></span>
		</a>
		{{/close}}
		<div class="elgg-body mvm">
			{{{body}}}
		</div>
		<div class="elgg-footer">
			{{#ok}}
			<a title="" class="elgg-button elgg-button-submit float-alt" href="">{{ok}}</a>
			{{/ok}}
			{{#cancel}}
			<a title="" class="elgg-button elgg-button-cancel mrm float-alt" href="#">{{cancel}}</a>
			{{/cancel}}
		</div>
	</div>
</script>


<!-- Template for leaflet popup -->
<script id="leaflet-popup-template" type="text/template">
	<div>
		<h2>{{#article}}{{article}}&nbsp;{{/article}}{{ville}}</h2>
		<span style="font-size: 1.5em;">{{cp}}</span>
		<h3><?php echo elgg_echo('groups:localgroup:departement'); ?></h3>
		<span style="font-size: 1.2em;">{{dep}}</span>
	<div>
</script>
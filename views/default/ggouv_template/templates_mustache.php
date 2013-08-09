


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

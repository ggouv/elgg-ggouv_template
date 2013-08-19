


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

<!-- Template for share menu -->
<script id="share-menu" type="text/template">
	<ul class="elgg-module-popup share-menu elgg-submenu">
		<li>
			<a href="#" onclick="javascript:elgg.deck_river.insertInThewire('{{sl}}');">
				<?php echo elgg_echo('thewire:put_shortlink_in_wire'); ?>
			</a>
		</li>
		<li>
			<a href="#" onclick="javascript:elgg.deck_river.insertInThewire('{{text}} {{sl}}');">
				<?php echo elgg_echo('thewire:put_title_shortlink_in_wire'); ?>
			</a>
		</li>
		<li class="section">
			<a href="#" onclick="javascript:(function(){var w=671,h=216,x=Number((window.screen.width-w)/2),y=Number((window.screen.height-h)/2),d=window,u='http://facebook.com/share.php?u={{sl}}';a=function(){d.open(u,'f','scrollbars=0,toolbar=0,location=0,resizable=0,status=0,width='+w+',height='+h+',left='+x+',top='+y)};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else a();void(0);})()">
				<span class="elgg-icon facebook-icon"></span>&nbsp;<?php echo elgg_echo('share:on'); ?>&nbsp;Facebook
			</a>
		</li>
		<li>
			<a href="#" onclick="javascript:(function(){var w=671,h=285,x=Number((window.screen.width-w)/2),y=Number((window.screen.height-h)/2),d=window,u='http://twitter.com/home?status={{text}} {{sl}}';a=function(){d.open(u,'t','scrollbars=0,toolbar=0,location=0,resizable=0,status=0,width='+w+',height='+h+',left='+x+',top='+y)};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else a();void(0);})()">
				<span class="elgg-icon twitter-icon"></span>&nbsp;<?php echo elgg_echo('share:on'); ?>&nbsp;Twitter
			</a>
		</li>
		<li>
			<a href="#" onclick="javascript:(function(){var w=600,h=200,x=Number((window.screen.width-w)/2),y=Number((window.screen.height-h)/2),d=window,u='https://plus.google.com/share?url={{sl}}';a=function(){d.open(u,'g','scrollbars=0,toolbar=0,location=0,resizable=0,status=0,width='+w+',height='+h+',left='+x+',top='+y)};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else a();void(0);})()">
				<span class="elgg-icon google-icon"></span>&nbsp;<?php echo elgg_echo('share:on'); ?>&nbsp;Google+
			</a>
		</li>
	</ul>
</script>

<!-- Template for leaflet popup -->
<script id="leaflet-popup-template" type="text/template">
	<div>
		<h2>{{#article}}{{article}}&nbsp;{{/article}}{{ville}}</h2>
		<a href="<?php echo elgg_get_site_url(); ?>groups/profile/{{cp}}/{{ville}}">
			<span style="font-size: 1.5em;">{{cp}}</span>
		</a>
		<h3><?php echo elgg_echo('groups:localgroup:departement'); ?></h3>
		<a href="<?php echo elgg_get_site_url(); ?>groups/profile/{{dep}}/{{nom_dep}}">
			<span style="font-size: 1.2em;">{{dep}}</span>
		</a>
	<div>
</script>
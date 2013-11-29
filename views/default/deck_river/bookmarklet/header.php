<?php

$site_url = elgg_get_site_url();

echo <<<HTML
<div class="elgg-menu-item-logo gwf float">
	<a class="t" href="$site_url" target="_blank">∇</a>
</div>

<ul class="elgg-subtype float">
	<li class="t gwf elgg-state-active" data-tab="thewire">A</li>
</ul>
HTML;
	//<li class="t gwf" data-tab="bookmarks">U</li>



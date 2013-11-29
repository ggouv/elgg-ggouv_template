<?php
/*
 * page called by views/page/default.php
 */

$user = elgg_get_logged_in_user_entity();
$site = elgg_get_site_url();

// Set context
$context = 'slidr-group';
elgg_push_context($context);

$header = elgg_view('input/text', array(
	'placeholder' => elgg_echo('search:group'),
));

$subheader = '';
if ($user_location = $user->location) {
	$subheader .= '<li class="elgg-menu-item-my-localgroup"><a class="t25" href="' . $site . 'groups/profile/' . $user_location . '"><span>!' . $user_location . '</span></a></li>';
} else {
	$subheader .= '<li class="elgg-menu-item-my-localgroup"><a class="t25" href="' . $site . 'profile/' . $user->username . '/edit?show_location=true"><span>?</span></a></li>';
}
$subheader .= '<li class="elgg-menu-item-groups-local"><a class="t25" href="' . $site . 'groups/all?filter=localgroups' . '"><span>' . elgg_echo('groups:localgroups') . '</span></a></li>';
$subheader .= '<li class="elgg-menu-item-groups-meta"><a class="t25" href="' . $site . 'groups/all?filter=metagroups' . '"><span>' . elgg_echo('groups:metagroups') . '</span></a></li>';
$subheader .= '<li class="elgg-menu-item-groups-typo"><a class="t25" href="' . $site . 'groups/all?filter=typogroups' . '"><span>' . elgg_echo('groups:typogroups') . '</span></a></li>';
$subheader .= '<li class="elgg-menu-item-groups-all"><a class="t25" href="' . $site . 'groups/all' . '"><span>' . elgg_echo('groups:all') . '</span></a></li>';


$widgets = elgg_get_widgets($user->getGUID(), $context);

// show widgets
$body = '';
foreach ($widgets[1] as $widget) { // there is only one column in slidr-group
	$body .= elgg_view_entity($widget, array(
		'show_access' => false
	));
}

// add widgets panel
$widget_types = elgg_get_widget_types($context, true);
uasort($widget_types, create_function('$a,$b', 'return strcmp($a->name,$b->name);'));

$current_handlers = array();
foreach ($widgets as $column_widgets) {
	foreach ($column_widgets as $widget) {
		$current_handlers[] = $widget->handler;
	}
}

foreach ($widget_types as $handler => $widget_type) {
	$id = "elgg-widget-type-$handler";
	// check if widget added and only one instance allowed
	if ($widget_type->multiple == false && in_array($handler, $current_handlers)) {
		$class = 'elgg-state-unavailable';
		$tooltip = elgg_echo('widget:unavailable');
	} else {
		$class = 'elgg-state-available';
		$tooltip = $widget_type->description;
	}

	if ($widget_type->multiple) {
		$class .= ' elgg-widget-multiple';
	} else {
		$class .= ' elgg-widget-single';
	}

	$footer .= "<li title=\"$tooltip\" id=\"$id\" class=\"$class\">{$widget_type->name}</li>";
}

$footer .= elgg_view('input/hidden', array(
	'name' => 'widget_context',
	'value' => $context
));
$footer .= elgg_view('input/hidden', array(
	'name' => 'show_access',
	'value' => (int)$vars['show_access']
));

$footer_button = elgg_view('output/url', array(
	'href' => '#slidr-widgets-add-panel',
	'text' => elgg_echo('widgets:add'),
	'rel' => 'toggle',
	'is_trusted' => true,
	'class' => 'widget-add-button'
));

elgg_pop_context();

echo elgg_view('graphics/ajax_loader', array('id' => 'elgg-widget-loader'));
?>

<div id="slidr-groups" class="slidr slidr-left hidden">
	<div class="slidr-header pam"><?php echo $header; ?></div>
	<ul class="slidr-subheader"><?php echo $subheader; ?></ul>
	<div class="slidr-body elgg-widgets ptm noresize">
		<div class="slidr-results hidden">
			<span class="elgg-icon elgg-icon-delete tooltips e prs float-alt link" title="<?php echo elgg_echo('close'); ?>"></span>
			<div class="loader"><img src="<?php echo $site; ?>mod/elgg-ggouv_template/graphics/loaders/loader_blue_blue_light.gif"></div>
			<div class="elgg-widget-content"><ul class="elgg-list small clearfloat mal"></ul></div>
		</div>
		<div id="elgg-widget-col-1">
			<?php echo $body; ?>
		</div>
	</div>
	<div class="elgg-widgets-add-panel hidden clearfix" id="slidr-widgets-add-panel">
		<p>
			<?php echo elgg_echo('widgets:add:description'); ?>
		</p>
		<ul>
			<?php echo $footer; ?>
		</ul>
	</div>
	<div class="slidr-footer">
		<?php echo $footer_button; ?>
	</div>
</div>

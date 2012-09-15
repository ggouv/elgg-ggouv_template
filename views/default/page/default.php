<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['title'] The page title
 * @uses $vars['body'] The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */

// backward compatability support for plugins that are not using the new approach
// of routing through admin. See reportedcontent plugin for a simple example.
if (elgg_get_context() == 'admin') {
	elgg_deprecated_notice("admin plugins should route through 'admin'.", 1.8);
	elgg_admin_add_plugin_settings_menu();
	elgg_unregister_css('elgg');
	echo elgg_view('page/admin', $vars);
	return true;
}

$ajaxified = (bool) get_input('ajaxified', false);
if ($ajaxified) {
	if (empty($vars['title'])) {
		$title = elgg_get_config('sitename');
	} else {
		$title = $vars['title'] . ' &nabla; ' . elgg_get_config('sitename');
	}
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<title><?php echo $title; ?></title>
		</head>
		<body>
			<div class="elgg-page-messages">
				<?php echo elgg_view('page/elements/messages', array('object' => $vars['sysmessages'])); ?>
			</div>
			<div class="elgg-page-body">
				<div id="JStoexecute" class="hidden">
					<?php echo elgg_view('page/elements/reinitialize_elgg'); ?>
				</div>
				<div class="elgg-inner">
					<?php echo elgg_view('page/elements/body', $vars); ?>
				</div>
			</div>
		</body>
	</html>
	<?php
	return true;
}

// Set the content type
header("Content-type: text/html; charset=UTF-8");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php echo elgg_view('page/elements/head', $vars); ?>
</head>
<body>
<div class="elgg-page elgg-page-default">
	<div class="elgg-page-messages">
		<?php echo elgg_view('page/elements/messages', array('object' => $vars['sysmessages'])); ?>
	</div>
	
	<?php if (elgg_is_logged_in()) { ?>
	
		<div class="elgg-page-topbar">
			<div class="elgg-inner">
				<?php echo elgg_view('page/elements/ggouv_menu', $vars); ?>
			</div>
		</div>
	
		<div class="elgg-page-header">
			<div class="elgg-inner">
				<?php echo elgg_view('page/elements/header', $vars); ?>
			</div>
		</div>
	
		<div class="elgg-page-body">
			<div id="JStoexecute" class="hidden">
				<?php echo elgg_view('page/elements/reinitialize_elgg'); ?>
			</div>
			<div class="elgg-inner">
				<?php echo elgg_view('page/elements/body', $vars); ?>
			</div>
		</div>
	
	<?php } else {
		
		if ( elgg_get_context() == 'activity' ) forward(elgg_get_site_url());
		
		if ( elgg_get_context() == 'main' ) { 
			$class_main = 'main';
		} else { 
			$class_main = '';
		} ?>

		<?php echo '<a href="' . elgg_get_site_url() . 'signup"><div class="ribbon">Essayez la béta !</div></a>'; ?>
	
		<div class="elgg-page-header nolog">
			<div class="elgg-inner-nolog <?php echo $class_main; ?>">
				<?php 
				echo "<div class='elgg-menu-item-logo ggouv-webfont'><a href='" . elgg_get_site_url() . "'>&nabla;</a></div>";
				echo '<h1><a href="' . elgg_get_site_url() . '">' . elgg_get_config('sitename') . '</a></h1>';
				if ( elgg_get_context() != 'main' ) echo elgg_view('core/account/login_dropdown');
				?>
			</div>
		</div>
		
		<div class="elgg-page-body nolog">
			<div class="elgg-inner-nolog <?php echo $class_main; ?>">
				<?php echo elgg_view('page/elements/body', $vars); ?>
			</div>
		</div>
	
	<?php } ?>
	
	<div class="elgg-page-footer">
		<div class="elgg-inner">
			<?php // echo elgg_view('page/elements/footer', $vars); ?>
		</div>
	</div>
</div>
<?php echo elgg_view('page/elements/foot'); ?>
</body>
</html>
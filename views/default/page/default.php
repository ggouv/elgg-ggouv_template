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
/*if (elgg_get_context() == 'admin') {
	elgg_deprecated_notice("admin plugins should route through 'admin'.", 1.8);
	elgg_admin_add_plugin_settings_menu();
	elgg_unregister_css('elgg');
	echo elgg_view('page/admin', $vars);
	return true;
}*/

$ajaxified = (bool) get_input('ajaxified', false);
$force_home = (bool) get_input('home', false);

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
				<div class="elgg-inner">
					<?php echo elgg_view('page/elements/body', $vars); ?>
				</div>
				<script type="text/html" id="JStoexecute">
					<?php echo elgg_view('page/elements/reinitialize_elgg'); ?>
				</script>
				<?php if (!elgg_is_logged_in()) echo elgg_view('core/account/login_dropdown'); ?>
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
<body<?php if (elgg_get_context() == 'main') {echo ' class="homepage"';} ?>>
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

		<div class="elgg-header-wrapper">
			<div class="rotator">
				<div class="arrows">
					<div class="up gwf center link t">í</div>
					<div class="down gwf center link t">ì</div>
				</div>
			</div>
			<div id="elgg-page-header-container" data-rotation="0">
				<div class="elgg-page-header">
					<div class="elgg-inner">
						<?php echo elgg_view('page/elements/header', $vars); ?>
					</div>
				</div>
				<div class="elgg-page-header-2">
					<div class="elgg-inner">
						<?php echo elgg_view('search/header', $vars); ?>
					</div>
				</div>
				<div class="elgg-page-header-3">
					<div class="elgg-inner">
						COORDINATION
					</div>
				</div>
			</div>
		</div>

	<?php }
	if (!elgg_is_logged_in() || elgg_get_context() == 'main') { ?>

		<div class="elgg-page-header nolog">
			<div class="elgg-inner-nolog">
				<?php
					echo "<div class='elgg-menu-item-logo gwf'><a class='t' href='" . elgg_get_site_url() . "'>&nabla;</a></div>";
					echo '<h1 class="float mls"><a href="' . elgg_get_site_url() . '">' . elgg_get_config('sitename') . '</a></h1>';
					if ($url_blog = elgg_get_plugin_setting('blog_of_site', 'elgg-ggouv_template')) $url['Blog'] = $url_blog;
					if ($url){
						echo '<ul class="header-pages float">';
						foreach ($url as $key => $value) {
							echo '<ul class="header-page mhl"><a href="' . $value . '" class="pam float">' . $key . '</a></ul>';
						}
						echo '</ul>';
					}
					echo '<ul class="float-alt">';
					echo '<span class="shareButtons hidden-desktop gwfb link float-alt">' . elgg_echo('ggouv:share') . '</span><div class="visible-desktop">';
					echo '<div class="fbbutton"><div id="fb-root"></div>';
					echo '<div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="verdana"></div></div>';
					echo '<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, "script", "facebook-jssdk"));</script>';
					echo '<a href="https://twitter.com/share" class="twitter-share-button" data-text="Un réseau social politique" data-lang="fr" data-hashtags="ggouv">Tweeter</a>';
					echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
					echo '<div class="g-plusone"></div>';
					echo '<script type="text/javascript">
					  window.___gcfg = {lang: "fr"};
					  (function() {
					    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
					    po.src = "https://apis.google.com/js/plusone.js";
					    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>';
					echo '</div></ul>';
				?>
			</div>
		</div>

	<?php } ?>

	<div class="elgg-page-body<?php if (!elgg_is_logged_in()) echo ' nolog'; ?>">
		<div id="JStoexecute" class="hidden">
			<?php echo elgg_view('page/elements/reinitialize_elgg'); ?>
		</div>
		<div class="elgg-inner">
			<?php echo elgg_view('page/elements/body', $vars); ?>
		</div>
		<?php if (!elgg_is_logged_in()) echo elgg_view('core/account/login_dropdown'); ?>
	</div>

	<div id="goTop" class="t"><div class="gwf tooltip e" title="<?php echo elgg_echo('back:to:top'); ?>">í</div></div>

	<div class="elgg-page-footer">
		<div class="elgg-inner">
			<?php // echo elgg_view('page/elements/footer', $vars); ?>
		</div>
	</div>
</div>
<?php echo elgg_view('page/elements/foot'); ?>

<?php if ($piwik_url = elgg_get_plugin_setting('piwik_tracker', 'elgg-ggouv_template')) {
	echo <<<HTML
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://$piwik_url/piwik/" : "http://$piwik_url/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script>
<noscript><p><img src="http://$piwik_url/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
HTML;

} ?>

</body>
</html>
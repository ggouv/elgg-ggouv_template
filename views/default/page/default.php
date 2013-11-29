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


$ajaxified = (bool) get_input('ajaxified', false);

$params['body'] = elgg_view('page/elements/body', $vars);
if (!elgg_is_logged_in()) $params['body'] .= elgg_view('core/account/login_dropdown');

if ($ajaxified) {
	if (empty($vars['title'])) {
		$params['title'] = elgg_get_config('sitename');
	} else {
		$params['title'] = $vars['title'] . ' &nabla; ' . elgg_get_config('sitename');
	}

	if ($vars['sysmessages']) {
		$params['system_messages'] = $vars['sysmessages'];
	} else {
		$params['system_messages'] = array(
			'error' => array(),
			'success' => array()
		);
	}

	ggouv_execute_js(elgg_view('page/elements/reinitialize_elgg'));
	$code = ''; // reset $code !
	global $dbcalls; $params['js_code'] .= 'console.log("'.$dbcalls.'", "dbcalls");'; // uncomment to see number of SQL calls
	foreach (ggouv_execute_js() as $code) {
		$params['js_code'] .= $code;
	}

	echo json_encode($params);
	exit;
}

$lang = get_current_language();

// Set the content type
header("Content-type: text/html; charset=UTF-8");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">

<head>
	<?php echo elgg_view('page/elements/head', $vars); ?>
</head>

<body class="<?php if (elgg_get_context() == 'main') {echo 'homepage t25';} else {echo 't25';} ?><?php if (!elgg_is_logged_in()) echo ' nolog'; ?>">

	<div id="overlay"></div>

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

			<?php echo elgg_view('page/elements/ggouv_slidr_left'); ?>

			<div class="elgg-header-wrapper">
				<div class="rotator">
					<div class="arrows">
						<div class="up gwf center link t">&uarr;</div>
						<div class="down gwf center link t">&darr;</div>
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

		<?php } else { ?>

			<div class="elgg-page-header">
				<div class="elgg-inner-nolog">
					<?php
						echo elgg_view('page/elements/nologin_mainpage_header');
					?>
				</div>
			</div>

		<?php } ?>

		<div class="toggle-sidebar-button gwf hidden link">&#xac06;</div>

		<div class="elgg-page-body">
			<div class="elgg-inner">
				<?php echo $params['body']; ?>
			</div>
		</div>

	</div>

	<div id="goTop" class="t"><div class="gwf tooltip e" title="<?php echo elgg_echo('back:to:top'); ?>">&uarr;</div></div>

	<?php echo elgg_view('page/elements/foot'); ?>

	<?php if ($piwik_url = elgg_get_plugin_setting('piwik_tracker', 'elgg-ggouv_template')) {
		$piwik_id = elgg_get_plugin_setting('piwik_id', 'elgg-ggouv_template');
		echo <<<HTML
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://$piwik_url/piwik/" : "http://$piwik_url/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", $piwik_id);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script>
<noscript><p><img src="http://$piwik_url/piwik/piwik.php?idsite=$piwik_id" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
HTML;

	} ?>

	<?php global $dbcalls; echo '<script type="text/javascript">console.log("'.$dbcalls.'", "dbcalls");</script>'; // uncomment to see number of SQL calls ?>

</body>
</html>
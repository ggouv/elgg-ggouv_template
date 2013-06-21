<?php
	$title = $vars["title"];
	$message = nl2br($vars["message"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
		<meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
		<base target="_blank" />

		<?php
			if(!empty($title)){
				echo "<title>" . $title . "</title>\n";
			}
		?>

		<style type="text/css">
			body {
				font: 100%/1.6 "Lucida Grande", Verdana, sans-serif;
				color: #333333;
				background-color: #F9F9F9;
				padding: 40px 0;
				margin: 0;
				width: 100%;
			}
			tr {
				border-spacing: 0px;
			}
			a {
				color: #4690d6;
			}
			#notification_container {
				width: 80%;
				margin: 0 auto;
				overflow: hidden;
			}
			#notification_header td {
				background: #DEDEDE;
				padding: 7px 0 4px 10px;
			}
			#notification_header a {
				text-decoration: none;
				font-weight: bold;
				color: #333;
				font-size: 1.6em;
			}
			#notification_wrapper {
				background: #FFFFFF;
			}
			#notification_wrapper h2 {
				border-bottom: 1px solid #CCCCCC;
				padding: 5px 0 5px 10px;
				color: #0054A7;
				font-size: 1.35em;
				line-height: 1.2em;
			}
			#notification_content {
				padding: 5px 10px 20px;
			}
			#notification_footer td {
				background: #DEDEDE;
				padding: 10px;
				text-align: right;
				font-size: 0.85em;
			}
			.clearfloat {
				clear:both;
				height:0;
				font-size: 1px;
				line-height: 0px;
			}
		</style>

	</head>

	<body>
		<table id="notification_container" cellspacing="0" cellpadding="0" width="600px">
			<tr id="notification_header">
				<td>
					<img height="24px" width="24px" style="vertical-align:text-bottom;margin-right: 5px;" src="<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/favicon/favicon.png';?>">
					<?php
						$site_url = elgg_view("output/url", array("href" => elgg_get_site_url(), "text" => elgg_get_site_entity()->name));
						echo $site_url;
					?>
				</td>
			</tr>

			<tr id="notification_wrapper">
				<td>
					<?php if(!empty($title)) echo elgg_view_title($title); ?>

					<div id="notification_content">
						<?php echo $message; ?>
					</div>
				</td>
			</tr>

			<tr id="notification_footer">
				<td>
					<?php
						if(true || elgg_is_logged_in()){
							$settings_url = $vars["url"] . "settings";
							if(elgg_is_active_plugin("notifications")){
								$settings_url = $vars["url"] . "notifications/personal";
							}
							echo elgg_echo("html_email_handler:notification:footer:advice");
							echo '<br />';
							echo elgg_echo("html_email_handler:notification:footer:settings", array("<a href='" . $settings_url . "'>", "</a>"));
						}
					?>
					<div class="clearfloat"></div>
				</td>
			</tr>
		</table>
	</body>

</html>
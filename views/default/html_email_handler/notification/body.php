<?php
	$title = $vars["title"];
	$message = nl2br($vars["message"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<base target="_blank" />
		
		<?php 
			if(!empty($title)){ 
				echo "<title>" . $title . "</title>\n";
			}
		?>
	</head>
	<body>
		<style type="text/css">
			body {
				font: 80%/1.4 "Lucida Grande", Verdana, sans-serif;
				color: #333333;
				background-color: #F4F4F4;
				padding: 40px 0;
			}
			
			a {
				color: #4690d6;
			}
			
			#notification_container {
				width: 600px;
				margin: 0 auto;
				box-shadow: 2px 2px 2px gray;
				border-radius: 8px;
				overflow: hidden;
			}
		
			#notification_header {
				background: #B6B6B6;
				padding: 2px 0 7px 10px;
			}
			
			#notification_header a {
				text-decoration: none;
				font-weight: bold;
				color: #333;
				font-size: 1.8em;
			} 
		
			#notification_wrapper {
				background: #DEDEDE;
				padding: 10px;
			}
			
			#notification_wrapper h2 {
				margin: -4px 0 5px 10px;
				color: #0054A7;
				font-size: 1.35em;
				line-height: 1.2em;
			}
			
			#notification_content {
				background: #FFFFFF;
				padding: 10px;
			}
			
			#notification_footer {
				background: #B6B6B6;
				padding: 10px;
				text-align: right;
			}
			
			#notification_footer_logo {
				float: left;
			}
			
			#notification_footer_logo img {
				border: none;
			}
			
			.clearfloat {
				clear:both;
				height:0;
				font-size: 1px;
				line-height: 0px;
			}
			
		</style>
	
		<div id="notification_container">
			<div id="notification_header">
				<img height="24px" width="24px" style="vertical-align: bottom;margin-right: 5px;" src="<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/favicon.png';?>">
				<?php 
					$site_url = elgg_view("output/url", array("href" => elgg_get_site_url(), "text" => elgg_get_site_entity()->name));
					echo $site_url;
				?>
			</div>
			<div id="notification_wrapper">
				<?php if(!empty($title)) echo elgg_view_title($title); ?>
			
				<div id="notification_content">
					<?php echo $message; ?>
				</div>
			</div>
			
			<div id="notification_footer">
				
				<?php 
					if(elgg_is_logged_in()){
						$settings_url = $vars["url"] . "settings";
						if(elgg_is_active_plugin("notifications")){
							$settings_url = $vars["url"] . "notifications/personal";
						}
						echo elgg_echo("html_email_handler:notification:footer:settings", array("<a href='" . $settings_url . "'>", "</a>"));
					}
				?>
				<div class="clearfloat"></div>
			</div>
		</div>
	</body>
</html>
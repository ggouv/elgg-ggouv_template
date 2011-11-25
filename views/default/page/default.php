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
				<?php echo elgg_view('page/elements/topbar', $vars); ?>
			</div>
		</div>
		
		<?php echo elgg_view('page/elements/ggouv-sub-menu'); ?>
	
		<div class="elgg-page-header">
			<div class="elgg-inner">
				<?php echo elgg_view('page/elements/header', $vars); ?>
			</div>
		</div>
	
		<div class="elgg-page-body">
			<div class="elgg-inner">
				<?php echo elgg_view('page/elements/body', $vars); ?>
			</div>
		</div>
	
	<?php } elseif ( elgg_get_context() == 'main' ) { ?>
	
		<div class="elgg-page-header-nolog">
			<div class="elgg-inner-nolog main">
				<?php 
				echo "<div class='elgg-menu-item-logo'><a><span class='logoGreen'>&nabla;</span><span class='logoRed'>&nabla;</span><span class='logoWhite'>&nabla;</span></a></div>";
				echo '<h1>' . elgg_get_config('sitename') . '</h1	>' . elgg_view('core/account/login_dropdown')
				?>
			</div>
		</div>
		
		<div class="elgg-page-body nolog">
			<div class="elgg-inner-nolog-main">
				<?php 
					$page_top = elgg_get_plugin_setting('page_top_for_home', 'elgg_ggouv_template');
					$page_top_entity = get_entity($page_top);
					
					$title[] = elgg_view('output/longtext', array('value' => $page_top_entity['title']));
					$desc[] = elgg_view('output/longtext', array('value' => $page_top_entity['description']));

					$pages = elgg_get_entities_from_metadata(array(
						'type' => 'object',
						'subtype' => 'page',
						'metadata_name' => 'parent_guid',
						'metadata_value' => $page_top,
					));
					foreach( $pages as $page) {
						$title[] = elgg_view('output/longtext', array('value' => $page['title']));
						$desc[] = elgg_view('output/longtext', array('value' => $page['description']));
					}
					
					$content = '<ul class="title"><li>' . implode('</li><li>', $title) . '</li></ul>';
					$content .= '<ul class="content"><li>' . implode('</li><li>', $desc) . '</li></ul>';
					
					$params = array(
							'content' => $content,
					);
					echo elgg_view_layout('one_column', $params);
				?>
			</div>
		</div>
		
	<?php } else { ?>
	
		<div class="elgg-page-header-nolog">
			<div class="elgg-inner-nolog">
				<?php 
				echo "<div class='elgg-menu-item-logo'><a><span class='logoGreen'>&nabla;</span><span class='logoRed'>&nabla;</span><span class='logoWhite'>&nabla;</span></a></div>";
				echo '<h1>' . elgg_get_config('sitename') . '</h1	>' . elgg_view('core/account/login_dropdown')
				?>
			</div>
		</div>
	
		<div class="elgg-page-body nolog">
			<div class="elgg-inner">
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
<?php // echo elgg_view('page/elements/foot'); ?>
</body>
</html>
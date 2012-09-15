<?php
/**
 * Ggouv 2 right sidebar layout
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content']     The content string for the main column
 * @uses $vars['sidebar']     Optional content that is displayed in the sidebar
 * @uses $vars['sidebar_2'] Optional content that is displayed in the alternate sidebar
 * @uses $vars['title']   Optional title for main content area
 * @uses $vars['class']       Additional class to apply to layout
 * @uses $vars['nav']     HTML of the page nav (override) (default: breadcrumbs)
 */

$class = 'elgg-layout elgg-layout-two-right-sidebar clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

?>

<div class="<?php echo $class; ?>">
	<div class="elgg-sidebar">
		<?php
			echo elgg_view('page/elements/sidebar', $vars);
		?>
	</div>
	<?php if ($vars['sidebar_2']) { ?>
		<div class="elgg-sidebar-2 mlm ptm">
			<?php
				echo elgg_view('page/elements/sidebar_2', $vars);
			?>
		</div>
	<?php } else { ?>
		<div class="elgg-sidebar-2-none ptm"></div>
	<?php } ?>

	<div class="elgg-main elgg-body margin-tablet">
		<?php
			echo $nav;
			
			if (isset($vars['title'])) {
				echo elgg_view_title($vars['title']);
			}
			// @todo deprecated so remove in Elgg 2.0
			if (isset($vars['area1'])) {
				echo $vars['area1'];
			}
			if (isset($vars['content'])) {
				echo $vars['content'];
			}
		?>
	</div>
</div>

<?php
/**
 * Page Layout
 *
 * Contains CSS for the page shell and page layout
 *
 * Default layout: 990px wide, centered. Used in default page shell
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	PAGE LAYOUT
*************************************** */
/***** DEFAULT LAYOUT ******/
<?php // the width is on the page rather than topbar to handle small viewports ?>
.elgg-page-default {
	min-width: 998px;
}
.elgg-page-default .elgg-page-body {
	padding-top: 48px;
	margin: 0 0 0 60px;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	height: 48px;
	margin: 7px 0 0 50px;
	width: 600px;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
	width: 100%;
	margin: 0 auto;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
	display: none;
}

/***** TOPBAR ******/
.elgg-page-topbar {
	background: none repeat scroll 0 0 #1F2E3D;
	height: 100%;
	position: fixed;
	width: 40px;
	border: none;
	z-index: 2;
	box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.4);
}
.elgg-page-topbar > .elgg-inner {
	padding: 0;
}

/***** PAGE MESSAGES ******/
.elgg-system-messages {
	position: fixed;
	top: 2px;
	right: 10px;
	max-width: 500px;
	z-index: 2000;
}
.elgg-system-messages li {
	margin-top: 10px;
}
.elgg-system-messages li p {
	margin: 0;
}

/***** PAGE HEADER ******/
.elgg-page-header {
	position: fixed;
	width: 100%;
	height: 48px;
	z-index: 1;
	-webkit-box-shadow: 0px 5px 5px 0px white;
	-moz-box-shadow: 0px 5px 5px 0px white;
	box-shadow: 0px 5px 5px 0px white;
	background: #4690D6 url(<?php echo elgg_get_site_url(); ?>_graphics/header_shadow.png) repeat-x bottom left;
}
.elgg-page-header > .elgg-inner {
	position: relative;
}

/***** PAGE BODY LAYOUT ******/
.elgg-layout {
	min-height: 360px;
}
.elgg-layout-one-sidebar {
}
.elgg-layout-one-sidebar.fixed-sidebar {
	margin-right: 390px;
}
.elgg-layout-one-sidebar.fixed-sidebar .elgg-sidebar {
	position: fixed;
	right: 0;
}
.elgg-layout-one-sidebar.fixed-sidebar .elgg-menu-extras {
	position: absolute;
	bottom: 0;
}
.elgg-layout-one-column {
}
.elgg-layout-two-sidebar {
	background: transparent url(<?php echo elgg_get_site_url(); ?>_graphics/two_sidebar_background.gif) repeat-y right top;
}
.elgg-sidebar {
	position: relative;
	padding: 20px 10px 0;
	float: right;
	width: 360px;
	margin: 0 0 0 10px;
	background-color: #EEE;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 20px 10px;
	float: left;
	width: 160px;
	margin: 0 10px 0 0;
}
.elgg-main {
	position: relative;
	min-height: 360px;
	padding: 10px;
}
.elgg-main > .elgg-head {
	padding-bottom: 3px;
	border-bottom: 1px solid #CCCCCC;
	margin-bottom: 10px;
}

/***** PAGE FOOTER ******/
.elgg-page-footer {
	position: relative;
}
.elgg-page-footer {
	color: #999;
}
.elgg-page-footer a:hover {
	color: #666;
}

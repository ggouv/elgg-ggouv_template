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
	min-width: 320px;
}
.elgg-page-default .elgg-page-body {
	margin: 0 0 0 60px;
	position: relative;
	padding-top: 48px;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	margin: 7px 0 0 50px;
	width: 657px;
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
	top: 0;
	width: 40px;
	border: none;
	z-index: 11;
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
	top: 0;
	width: 100%;
	height: 48px;
	z-index: 10;
	-webkit-box-shadow: 0px 5px 5px 0px white;
	-moz-box-shadow: 0px 5px 5px 0px white;
	box-shadow: 0px 5px 5px 0px white;
	/*background: #4690D6 url(<?php echo elgg_get_site_url(); ?>_graphics/header_shadow.png) repeat-x bottom left;*/
	background: #4690D6;
	background: -moz-linear-gradient(top,  #64ade5 0%, #4690d6 13%, #4690d6 87%, #346ca1 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#64ade5), color-stop(13%,#4690d6), color-stop(87%,#4690d6), color-stop(100%,#346ca1));
	background: -webkit-linear-gradient(top,  #64ade5 0%,#4690d6 13%,#4690d6 87%,#346ca1 100%);
	background: -o-linear-gradient(top,  #64ade5 0%,#4690d6 13%,#4690d6 87%,#346ca1 100%);
	background: -ms-linear-gradient(top,  #64ade5 0%,#4690d6 13%,#4690d6 87%,#346ca1 100%);
	background: linear-gradient(top,  #64ade5 0%,#4690d6 13%,#4690d6 87%,#346ca1 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4690D6', endColorstr='#4690D6',GradientType=0 );

}
.elgg-page-header > .elgg-inner {
	position: relative;
}

/***** PAGE BODY LAYOUT ******/
.elgg-layout {
	min-height: 360px;
}
.elgg-layout-one-sidebar {
	margin-right: 390px;
}
.elgg-layout-one-column {
	margin-right: 20px;
}
.elgg-layout-two-sidebar {
	background: transparent url(<?php echo elgg_get_site_url(); ?>_graphics/two_sidebar_background.gif) repeat-y right top;
}
.elgg-menu-owner-block .elgg-menu-item-activity {
	display: none;
}
@media (max-width: 1279px) {
	.elgg-layout-two-right-sidebar .elgg-main.margin-tablet {
		margin-right: 282.8px;
	}
	.elgg-sidebar-2 {
		display: none;
	}
	.elgg-menu-owner-block .elgg-menu-item-activity {
		display: block;
	}
}
.elgg-sidebar {
	position: fixed;
	padding: 10px 10px 0;
	right: 0;
	width: 360px;
	margin-left: 10px;
	background-color: #EEE;
}
#goTop {
	background-color: rgba(255, 255, 255, 0.1);
	border-radius: 6px 6px 0 0;
	bottom: -50px;
	box-shadow: 0 0 6px #666;
	height: 40px;
	position: fixed;
	right: 10px;
	width: 40px;
	cursor: pointer;
}
#goTop:hover {
	background-color: rgba(0, 0, 0, 0.5);
}
#goTop .triangle {
	border-color: rgba(180, 180, 180, 0.8) transparent;
	border-style: solid;
	border-width: 0 15px 15px;
	height: 0;
	position: relative;
	right: -5px;
	top: 12px;
	width: 0;
}
#goTop:hover .triangle {
	border-color: rgba(255, 255, 255, 0.5) transparent;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 20px 10px;
	float: left;
	width: 160px;
	margin: 0 10px 0 0;
}
.elgg-sidebar-2 {
	position: relative;
	float: right;
	width: 360px;
	margin-right: 390px;
}
.elgg-sidebar-2-none {
	float: right;
	margin-right: 390px;
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
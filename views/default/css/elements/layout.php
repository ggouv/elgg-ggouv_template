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
	margin-left: 40px;
}
.elgg-page-default .elgg-page-body {
	min-height: 3000px; /* prevent ugly effect, resized by js */
	position: relative;
	padding: 48px 0 0 20px;
	background: white;
	overflow: hidden;
	box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.2);
	-webkit-box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.2);
}
#elgg-page-header-container .elgg-inner {
	position: relative;
	top: 6px;
	left: 7px;
	width: 657px;
	height: 41px;
	z-index: 10;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
	width: 100%;
	margin: 0 auto;
}

/***** TOPBAR ******/
.elgg-page-topbar {
	background: none repeat scroll 0 0 #1F2E3D;
	height: 100%;
	position: fixed;
	top: 0;
	left: 0;
	width: 40px;
	border: none;
	z-index: 11;
	box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.4);
	-webkit-box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.4);
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
.elgg-header-wrapper{
	display: block;
	height: 48px;
	position: fixed;
	width: 100%;
	z-index: 10;
	background: white;
	-webkit-box-shadow: 3px 5px 5px 0px white;
	-moz-box-shadow: 3px 5px 5px 0px white;
	box-shadow: 3px 5px 5px 0px white;
}
.rotator {
	background: #4189CB;
	float: left;
	height: 48px;
	width: 32px;
	z-index: 1;
	overflow: hidden;
	-webkit-transform: translateZ(0px);
	-moz-transform: translateZ(0px);
	-o-transform: translateZ(0px);
	-ms-transform: translateZ(0px);
	transform: translateZ(0px);
	-webkit-box-shadow: 3px -3px 5px rgba(51, 51, 51, 0.5);
	box-shadow: 3px -3px 5px rgba(51, 51, 51, 0.5);
}
.rotator .arrows div {
	color: white;
	font-size: 30px;
	height: 20px;
	line-height: 20px;
	padding: 2px 0;
	width: 34px;
	overflow: hidden;
}
.rotator .arrows div:hover {
	font-size: 36px;
}
#elgg-page-header-container {
	margin-left: 32px;
	height: 48px;
	-webkit-transform-origin: 0 center -13.8465px;
	-moz-transform-origin: 0 center -13.8465px;
	-o-transform-origin: 0 center -13.8465px;
	-ms-transform-origin: 0 center -13.8465px;
	transform-origin: 0 center -13.8465px;
	-webkit-transform-style: preserve-3d;
	-moz-transform-style: preserve-3d;
	-ms-transform-style: preserve-3d;
	transform-style: preserve-3d;

	-webkit-transition: all 0.8s ease;
	-moz-transition: all 0.8s ease;
	-o-transition: all 0.8s ease;
}
#elgg-page-header-container.side2 {
	-webkit-transform: rotateX(-120deg);
	-moz-transform: rotateX(-120deg);
	-o-transform: rotateX(-120deg);
	-ms-transform: rotateX(-120deg);
	transform: rotateX(-120deg);
}
#elgg-page-header-container.side3 {
	-webkit-transform: rotateX(-240deg);
	-moz-transform: rotateX(-240deg);
	-o-transform: rotateX(-240deg);
	-ms-transform: rotateX(-240deg);
	transform: rotateX(-240deg);
}
.elgg-page-header, .elgg-page-header-2, .elgg-page-header-3 {
	position: absolute;
	top: 0;
	width: 100%;
	padding: 1px;
	height: 46px;
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
.elgg-page-header {
	-webkit-transform: translateZ(0px);
	-moz-transform: translateZ(0px);
	-o-transform: translateZ(0px);
	-ms-transform: translateZ(0px);
	transform: translateZ(0px);
}
.elgg-page-header-2 {
	-webkit-transform: rotateX(120deg) translateY(-48px);
	-moz-transform: rotateX(120deg) translateY(-48px);
	-o-transform: rotateX(120deg) translateY(-48px);
	-ms-transform: rotateX(120deg) translateY(-48px);
	transform: rotateX(120deg) translateY(-48px);
	-webkit-transform-origin: 0 0 0;
	-moz-transform-origin: 0 0 0;
	-o-transform-origin: 0 0 0;
	-ms-transform-origin: 0 0 0;
	transform-origin: 0 0 0;
}
.elgg-page-header-3 {
	-webkit-transform: rotateX(-120deg) translateZ(24px);
	-moz-transform: rotateX(-120deg) translateZ(24px);
	-o-transform: rotateX(-120deg) translateZ(24px);
	-ms-transform: rotateX(-120deg) translateZ(24px);
	transform: rotateX(-120deg) translateZ(24px);
	-webkit-transform-origin: 0 16px 0;
	-moz-transform-origin: 0 16px 0;
	-o-transform-origin: 0 16px 0;
	-ms-transform-origin: 0 16px 0;
	transform-origin: 0 16px 0;
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
	background-color: #EEE;
}
.elgg-menu-owner-block .elgg-menu-item-activity {
	display: none;
}
.elgg-layout-two-right-sidebar {
	margin-right: 760px;
}
@media (max-width: 1200px) {
	.elgg-sidebar-2 + .elgg-sidebar {
		display: none;
	}
}
@media (max-width: 979px) {
	.elgg-layout {
		margin-right: 10px !important;
	}
	.fixed-deck .elgg-layout {
		margin-right: 0 !important;
	}
	.elgg-sidebar {
		display: none;
	}
}
.toggle-sidebar-button {
	position: fixed;
	top: 0;
	right: 0;
	z-index: 9999;
	width: 40px;
	height: 48px;
	text-align: center;
	font-size: 4em;
	line-height: 100%;
	color: white;
	background: #4690D6;
	box-shadow: 0 -4px 6px 4px rgba(10, 10, 10, 0.2);
	-webkit-box-shadow: 0 -4px 6px 4px rgba(10, 10, 10, 0.2);
}
.elgg-sidebar {
	position: fixed;
	padding: 10px 10px 0;
	right: 0;
	width: 360px;
	height: 100%;
	margin-left: 10px;
	background-color: #EEE;
}
.cloned-sidebar {
	position: fixed;
	top: 48px;
	padding: 10px 10px 0;
	background: #EEE;
	box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.2);
	-webkit-box-shadow: 0 0 6px 4px rgba(10, 10, 10, 0.2);
}
#goTop {
	position: fixed;
	right: 30px;
	bottom: -50px;
}
#goTop div {
	background: #4690D6;
	border-radius: 6px 6px 0 0;
	box-shadow: 0 0 6px #666666;
	color: white;
	cursor: pointer;
	font-size: 4em;
	height: 28px;
	padding: 10px 7px 0;
}
#goTop div:hover {
	background: #0054A7;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 20px 10px;
	float: left;
	width: 160px;
	margin: 0 10px 0 0;
}
.elgg-sidebar-2 {
	position: fixed;
	width: 360px;
	right: 390px;
}
.elgg-sidebar-2-none {
	float: right;
	right: 390px;
}

.elgg-main {
	position: relative;
	min-height: 360px;
	padding: 10px 0 0;
}
.elgg-main > .elgg-head {
	padding-bottom: 3px;
	border-bottom: 1px solid #CCCCCC;
	margin-bottom: 10px;
}

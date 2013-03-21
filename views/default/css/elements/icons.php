<?php
/**
 * Elgg icons
 *
 * @package Elgg.Core
 * @subpackage UI
 */

?>

/* ***************************************
	ICONS
*************************************** */

.elgg-icon {
	/*background: transparent url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png) no-repeat left;*/
	width: 16px;
	height: 16px;
	margin: 0 2px;
	font-family: 'ggouv';
}
.elgg-icon:before {
	font-family: 'ggouv';
	font-size: 40px;
	float: left;
	cursor: default;

	transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
}

.elgg-icon-arrow-left:before {
	background: none;
	content: 'î';
	color: #CCC;
}
.elgg-icon-arrow-right:before {
	background: none;
	content: 'ï';
	color: #CCC;
}

.elgg-icon-response, .elgg-icon-share, .elgg-icon-hover-menu, .elgg-icon-response-all {
	color: #CCC;
	font-size: 40px;
	margin: 0;
}
.elgg-icon-response:hover, .elgg-icon-share:hover, .elgg-icon-hover-menu:hover, {
	color: #555;
}
.elgg-icon-response:before {
	content: "<";
}
.elgg-menu-item-response-all .elgg-icon-response:before {
	content: "≤";
}

.elgg-icon-share:before {
	content: "^";
}

.elgg-icon-hover-menu:before {
	content: "+";
	padding-left: 3px;
}

.elgg-menu-item-delete .elgg-icon-delete:before {
	padding-left: 5px;
}
.elgg-icon-speech-bubble-alt:before {
	content: "c";
	color: #999;
	font-size: 24px;
}

.elgg-icon-settings-alt:before {
	color: #CCC;
	content: "s";
	font-size: 36px;
	cursor: pointer;
}
.elgg-icon-settings-alt:hover:before {
	color: #4690D6;
}

.elgg-icon-refresh:before {
	content: "R";
}

.elgg-icon-retweet-sub:before {
	content: "^";
	color: #999;
	font-size: 32px;
}








.elgg-icon-arrow-two-head {
	background-position: 0 -36px;
}
.elgg-icon-attention:hover {
	background-position: 0 -54px;
	background: none;
}
.elgg-icon-attention {
	background-position: 0 -72px;
	background: none;
	padding-left: 10px;
}
.elgg-icon-attention:before {
	content: 'w';
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
	text-indent: -8px;
}
.elgg-icon-attention:hover:before {
	color: red;
}
.elgg-icon-calendar {
	background-position: 0 -90px;
}
.elgg-icon-cell-phone {
	background-position: 0 -108px;
}
.elgg-icon-checkmark:hover {
	background-position: 0 -126px;
}
.elgg-icon-checkmark {
	background-position: 0 -144px;
}
.elgg-icon-clip:hover {
	background-position: 0 -162px;
}
.elgg-icon-clip {
	background-position: 0 -180px;
}
.elgg-icon-cursor-drag-arrow {
	background-position: 0 -198px;
}
.elgg-icon-delete-alt:hover {
	background-position: 0 -216px;
}
.elgg-icon-delete-alt {
	background-position: 0 -234px;
}
.elgg-icon-delete-alt:hover {
	background-position: 0 -252px;
	background: none;
}
.elgg-icon-delete-alt {
	background-position: 0 -270px;
	background: none;
}
.elgg-icon-delete-alt:before {
	content: 'x';
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
}
.elgg-icon-delete-alt:hover:before {
	color: red;
}

.elgg-icon-delete:hover {
	background-position: 0 -252px;
	background: none;
}
.elgg-icon-delete {
	background-position: 0 -270px;
	background: none;
}
.elgg-icon-delete:before {
	content: 'X';
	color: #CCC;
	font-size: 54px;
	cursor: pointer;
}
.elgg-icon-delete:hover:before {
	color: red;
}
.elgg-icon-download:hover {
	background-position: 0 -288px;
}
.elgg-icon-download {
	background-position: 0 -306px;
}
.elgg-icon-eye {
	background-position: 0 -324px;
}
.elgg-icon-facebook {
	background-position: 0 -342px;
}
.elgg-icon-grid:hover {
	background-position: 0 -360px;
}
.elgg-icon-grid {
	background-position: 0 -378px;
}
.elgg-icon-home:hover {
	background-position: 0 -396px;
}
.elgg-icon-home {
	background-position: 0 -414px;
}
.elgg-icon-hover-menu:hover {
	background-position: 0 -432px;
}
.elgg-icon-hover-menu {
	background-position: 0 -450px;
}
.elgg-icon-info:hover {
	background-position: 0 -468px;
}
.elgg-icon-info {
	background-position: 0 -486px;
}
.elgg-icon-link:hover {
	background-position: 0 -504px;
}
.elgg-icon-link {
	background-position: 0 -522px;
}
.elgg-icon-list {
	background-position: 0 -540px;
}
.elgg-icon-lock-closed {
	background-position: 0 -558px;
}
.elgg-icon-lock-open {
	background-position: 0 -576px;
}
.elgg-icon-mail-alt:hover {
	background-position: 0 -594px;
}
.elgg-icon-mail-alt {
	background-position: 0 -612px;
}
.elgg-icon-mail:hover {
	background-position: 0 -630px;
}
.elgg-icon-mail {
	background-position: 0 -648px;
}
.elgg-icon-photo {
	background-position: 0 -666px;
}
.elgg-icon-print-alt {
	background-position: 0 -684px;
}
.elgg-icon-print {
	background-position: 0 -702px;
}
.elgg-icon-push-pin-alt:hover {
	background-position: 0 -720px;
	background:none;
}
.elgg-icon-push-pin-alt {
	background-position: 0 -738px;
	background:none;
}
.elgg-icon-push-pin-alt {
	background-position: 0 -900px;
	background: none;
	padding-left: 5px;
}
.elgg-content .elgg-icon-push-pin-alt {
	margin-right: 10px;
}
.elgg-icon-push-pin-alt:before {
	content: 'L';
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
	text-indent: -5px;
}
.elgg-icon-push-pin-alt:hover:before {
	color: #4690D6;
}
.elgg-content .elgg-icon-push-pin-alt:hover:before {
	color: #CCC;
}
.elgg-icon-push-pin {
	background-position: 0 -738px;
	background: none;
}
.elgg-icon-push-pin:before {
	content: 'v';
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
	text-indent: -5px;
}
.elgg-icon-push-pin:hover:before{
	color: #4690D6;
}
.pinned .elgg-icon-push-pin:before {
	color: #00CC00;
}
.elgg-icon-redo {
	background-position: 0 -756px;
}
.elgg-icon-refresh:hover {
	background-position: 0 -774px;
}
.elgg-icon-refresh {
	background-position: 0 -792px;
}
.elgg-icon-round-arrow-left {
	background-position: 0 -810px;
}
.elgg-icon-round-arrow-right {
	background-position: 0 -828px;
}
.elgg-icon-round-checkmark {
	background-position: 0 -846px;
}
.elgg-icon-round-minus {
	background-position: 0 -864px;
}
.elgg-icon-round-plus {
	background-position: 0 -882px;
}
.elgg-icon-rss {
	background-position: 0 -900px;
	background: none;
}
.elgg-icon-rss:before {
	content: 'r';
	color: #CCC;
	font-size: 40px;
	cursor: pointer;
	margin-left: -3px;
}
.elgg-icon-rss:hover:before {
	color: #FF9900;
}
.elgg-icon-search-focus {
	background-position: 0 -918px;
}
.elgg-icon-search {
	background-position: 0 -936px;
}
.elgg-icon-settings-alt:hover {
	background-position: 0 -954px;
}
.elgg-icon-settings-alt {
	background-position: 0 -972px;
}
.elgg-icon-settings {
	background-position: 0 -990px;
}
.elgg-icon-share:hover {
	background-position: 0 -1008px;
}
.elgg-icon-share {
	background-position: 0 -1026px;
}
.elgg-icon-shop-cart:hover {
	background-position: 0 -1044px;
}
.elgg-icon-shop-cart {
	background-position: 0 -1062px;
}
.elgg-icon-speech-bubble-alt:hover {
	background-position: 0 -1080px;
}
.elgg-icon-speech-bubble-alt {
	background-position: 0 -1098px;
}
.elgg-icon-speech-bubble:hover {
	background-position: 0 -1116px;
}
.elgg-icon-speech-bubble {
	background-position: 0 -1134px;
}
.elgg-icon-star-alt {
	background-position: 0 -1152px;
}
.elgg-icon-star-empty:hover {
	background-position: 0 -1170px;
}
.elgg-icon-star-empty {
	background-position: 0 -1188px;
}
.elgg-icon-star:hover {
	background-position: 0 -1206px;
}
.elgg-icon-star {
	background-position: 0 -1224px;
}
.elgg-icon-tag:hover {
	background-position: 0 -1242px;
}
.elgg-icon-tag {
	background-position: 0 -1260px;
	background: none;
}
.elgg-icon-tag:before {
	content: 't';
	padding: 2px 0;
	font-size: 60px;
	color: #999;
}
.elgg-icon-thumbs-down-alt:hover {
	background-position: 0 -1278px;
}
.elgg-icon-thumbs-down:hover,
.elgg-icon-thumbs-down-alt {
	background-position: 0 -1296px;
}
.elgg-icon-thumbs-down {
	background-position: 0 -1314px;
}
.elgg-icon-thumbs-up-alt:hover {
	background-position: 0 -1332px;
}
.elgg-icon-thumbs-up:hover,
.elgg-icon-thumbs-up-alt {
	background-position: 0 -1350px;
}
.elgg-icon-thumbs-up {
	background-position: 0 -1368px;
}
.elgg-icon-trash {
	background-position: 0 -1386px;
}
.elgg-icon-twitter {
	background-position: 0 -1404px;
}
.elgg-icon-undo {
	background-position: 0 -1422px;
}
.elgg-icon-user:hover {
	background-position: 0 -1440px;
}
.elgg-icon-user {
	background-position: 0 -1458px;
}
.elgg-icon-users:hover {
	background-position: 0 -1476px;
}
.elgg-icon-users {
	background-position: 0 -1494px;
}
.elgg-icon-video {
	background-position: 0 -1512px;
}

.elgg-icon.external {
	background: none;
	width: 0 !important;
}
a.external:after {
	content: "ê";
	cursor: pointer;
	font-family: 'ggouv';
	font-size: 28px;
	line-height: 0.75;
	margin: 0 -2px 0 2px;
	font-weight: normal;
}

/* ggouv */
.elgg-menu-item-edit a, .elgg-menu-item-comment-edit a {
	font-size: 32px;
	color: #CCC;
	margin-top: -4px;
	text-decoration: none;
	transition: all 0.5s ease;
}
.elgg-menu-item-edit a:hover, .elgg-menu-item-comment-edit a:hover {
	color: #4690D6;
}

.elgg-avatar > .elgg-icon-hover-menu {
	display: none;
	position: absolute;
	right: 0;
	bottom: 0;
	margin: 0;
	cursor: pointer;
}

.elgg-ajax-loader {
	background: white url(<?php echo elgg_get_site_url(); ?>_graphics/ajax_loader_bw.gif) no-repeat center center;
	min-height: 33px;
	min-width: 33px;
}

.twitter-icon:before {
	content: "1";
	cursor: pointer;
	color: #00ACEE;
}
.facebook-icon:before {
	content: "2";
	cursor: pointer;
	color: #3B5998;
}
.google-icon:before {
	content: "3";
	cursor: pointer;
	color: #EA2432;
}



/* ***************************************
	AVATAR ICONS
*************************************** */
.elgg-avatar {
	position: relative;
	display: inline-block;
}
.elgg-avatar > a > img {
	display: block;
}
.elgg-avatar-tiny > a > img {
	width: 25px;
	height: 25px;

	/* remove the border-radius if you don't want rounded avatars in supported browsers
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;

	-moz-background-clip:  border;
	background-clip:  border;

	-webkit-background-size: 25px;
	-khtml-background-size: 25px;
	-moz-background-size: 25px;
	-o-background-size: 25px;
	background-size: 25px;*/
}
.elgg-avatar-small > a > img {
	width: 40px;
	height: 40px;

	/* remove the border-radius if you don't want rounded avatars in supported browsers
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	-moz-background-clip:  border;
	background-clip:  border;

	-webkit-background-size: 40px;
	-khtml-background-size: 40px;
	-moz-background-size: 40px;
	-o-background-size: 40px;
	background-size: 40px;*/
}
.elgg-avatar-medium > a > img {
	width: 100px;
	height: 100px;
}
.elgg-avatar-large > a > img {
	width: 200px;
	height: 200px;
}

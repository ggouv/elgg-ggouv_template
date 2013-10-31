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
	content: "\2190";
	color: #CCC;
}
.elgg-icon-arrow-right:before {
	content: "\2192";
	color: #CCC;
}

.elgg-menu-river .elgg-icon {
	color: #CCC;
	margin: 0;
}
.elgg-icon-response:before {
	content: "\003C";
}
.elgg-icon-response-all:before {
	content: "\2264";
}

.elgg-icon-retweet:before {
	content: "\2194";
}
.elgg-icon-share:before {
	content: "\0072";
}

.elgg-icon-hover-menu:before {
	content: "\002B";
	padding-left: 3px;
}

.elgg-menu-item-delete .elgg-icon-delete:before {
	padding-left: 5px;
}
.elgg-icon-speech-bubble-alt:before {
	content: "\0043";
	color: #999;
	font-size: 24px;
	text-indent: 2px;
}

.elgg-icon-settings-alt:before {
	content: "\AC0A";
}
.workflow-list .elgg-icon-settings-alt:before {
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
}
.elgg-icon-settings-alt:hover:before {
	color: #4690D6;
}

.elgg-icon-refresh:before {
	content: "\AC0D";
}

.elgg-icon-retweet-sub:before {
	content: "\2194";
	color: #999;
	font-size: 32px;
}








.elgg-icon-arrow-two-head {
}
.elgg-icon-attention:hover {
}
.elgg-icon-attention {
	padding-left: 10px;
}
.elgg-icon-attention:before {
	content: "\0061";
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
	text-indent: -8px;
}
.elgg-icon-attention:hover:before {
	color: red;
}
.elgg-icon-calendar {
}
.elgg-icon-cell-phone {
}
.elgg-icon-checkmark:hover {
}
.elgg-icon-checkmark {
}
.elgg-icon-clip:hover {
}
.elgg-icon-clip {
}
.elgg-icon-cursor-drag-arrow {
}
.elgg-icon-delete-alt:hover {
}
.elgg-icon-delete-alt {
}
.elgg-icon-delete-alt:hover {
}
.elgg-icon-delete-alt {
}
.elgg-icon-delete-alt:before {
	content: "\AA02";
	color: #CCC;
	font-size: 36px;
	cursor: pointer;
}
.elgg-icon-delete-alt:hover:before {
	color: red;
}

.elgg-icon-delete:hover {
}
.elgg-icon-delete {
}
.elgg-icon-delete:before {
	content: "\2715";
	color: #CCC;
	font-size: 54px;
	cursor: pointer;
	overflow: hidden;
}
.elgg-icon-delete:hover:before {
	color: red;
}
.elgg-icon-download:hover {
}
.elgg-icon-download {
}
.elgg-icon-eye {
}
.elgg-icon-facebook {
}
.elgg-icon-grid:hover {
}
.elgg-icon-grid {
}
.elgg-icon-home:hover {
}
.elgg-icon-home {
}
.elgg-icon-hover-menu:hover {
}
.elgg-icon-hover-menu {
}
.elgg-icon-info:hover {
}
.elgg-icon-info {
}
.elgg-icon-link:hover {
}
.elgg-icon-link {
}
.elgg-icon-list {
}
.elgg-icon-lock-closed {
}
.elgg-icon-lock-open {
}
.elgg-icon-mail-alt:hover {
}
.elgg-icon-mail-alt {
}
.elgg-icon-mail:hover {
}
.elgg-icon-mail {
}
.elgg-icon-photo {
}
.elgg-icon-print-alt {
}
.elgg-icon-print {
}
.elgg-icon-push-pin-alt:hover {
	background:none;
}
.elgg-icon-push-pin-alt {
	background:none;
}
.elgg-icon-push-pin-alt {
	padding-left: 5px;
}
.elgg-content .elgg-icon-push-pin-alt {
	margin-right: 10px;
}
.elgg-icon-push-pin-alt:before {
	content: "\006A";
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
}
.elgg-icon-push-pin:before {
	content: '\006A';
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
}
.elgg-icon-refresh:hover {
}
.elgg-icon-refresh {
}
.elgg-icon-round-arrow-left {
}
.elgg-icon-round-arrow-right {
}
.elgg-icon-round-checkmark {
}
.elgg-icon-round-minus {
}
.elgg-icon-round-plus {
}
.elgg-icon-rss {
}
.elgg-icon-rss:before {
	content: "\0052";
	color: #CCC;
	font-size: 40px;
	cursor: pointer;
	margin-left: -3px;
}
.elgg-icon-rss:hover:before {
	color: #FF9900;
}
.elgg-icon-search-focus {
}
.elgg-icon-search:before {
	content: "\ABFD";
}
.elgg-icon-settings-alt:hover {
}
.elgg-icon-settings-alt {
}
.elgg-icon-settings {
}
.elgg-icon-shop-cart:hover {
}
.elgg-icon-shop-cart {
}
.elgg-icon-speech-bubble-alt:hover {
}
.elgg-icon-speech-bubble-alt {
}
.elgg-icon-speech-bubble:hover {
}
.elgg-icon-speech-bubble {
}
.elgg-icon-star-alt {
}
.elgg-icon-star-empty:hover {
}
.elgg-icon-star-empty {
}
.elgg-icon-star:hover {
}
.elgg-icon-star {
}
.elgg-icon-tag:hover {
}
.elgg-icon-tag {
	width: 12px;
}
.elgg-icon-tag:before {
	content: "\AC05";
	padding: 2px 0;
	font-size: 60px;
	color: #999;
	overflow: hidden;
}
.elgg-tags .elgg-icon-tag:before {
	font-size: 48px;
}
.elgg-icon-thumbs-down-alt:hover {
}
.elgg-icon-thumbs-down:hover,
.elgg-icon-thumbs-down-alt {
}
.elgg-icon-thumbs-down {
}
.elgg-icon-thumbs-up-alt:before {
	content: "\AA00";
	color: #999;
	font-size: 32px;
}
.elgg-icon-thumbs-up-alt:hover:before {
}
.elgg-icon-thumbs-up:before {
	content: "\AA00";
}
.elgg-icon-thumbs-up:hover:before {
}
.elgg-icon-trash:before {
	content: "\E110";
	color: #CCC;
}
.elgg-icon-trash:hover:before {
	color: red;
}
.elgg-icon-twitter:before {
	content: "\0054";
}
.elgg-icon-undo {
}
.elgg-icon-user:hover {
}
.elgg-icon-user {
}
.elgg-icon-users:hover {
}
.elgg-icon-users {
}
.elgg-icon-video {
}

.elgg-icon.external {
	width: 0 !important;
}
a.external:after {
	content: "\AC04";
	cursor: pointer;
	font-family: 'ggouv';
	font-size: 28px;
	line-height: 0.75;
	margin: 0 -2px 0 2px;
	font-weight: normal;
}

/* ggouv */
.elgg-menu-item-edit a, .elgg-menu-item-comment-edit a, .elgg-menu-item-comment-reply a, .elgg-menu-item-share a {
	font-size: 32px;
	color: #CCC;
	margin-top: -2px;
	text-decoration: none;
	transition: all 0.5s ease;
}
.elgg-menu-item-share .elgg-icon:before {
	margin-top: -3px;
	font-size: 36px;
	text-indent: -4px;
}
.elgg-menu-item-edit a:hover, .elgg-menu-item-comment-edit a:hover, .elgg-menu-item-comment-reply a:hover, .elgg-menu-item-share a:hover, .elgg-menu-item-share a.elgg-state-active {
	color: #4690D6;
}
.elgg-menu-item-comment-reply a {
	font-size: 40px;
	margin: -2px 4px 0 0;
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
	background: white url(<?php echo elgg_get_site_url(); ?>/mod/elgg-ggouv_template/graphics/loaders/loader_gray_white.gif) no-repeat center center;
	min-height: 33px;
	min-width: 33px;
}

.twitter-icon:before {
	content: "\0054";
	cursor: pointer;
	color: #00ACEE;
}
.facebook-icon:before {
	content: "\0046";
	cursor: pointer;
	color: #3B5998;
}
.google-icon:before {
	content: "\0047";
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

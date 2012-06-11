/* 
* nolog css when non logged in user
*/
.elgg-page-header.nolog {
  background: url("http://localhost/~mama/ggouv/ggouv/_graphics/header_shadow.png") repeat-x scroll left bottom #1F2E3D;
  box-shadow: 0 5px 5px 0 white;
  height: 48px;
  position: fixed;
  width: 100%;
  z-index: 1;
}
.elgg-inner-nolog {
	margin: 0;
	position: relative;
}
.elgg-inner-nolog .elgg-menu-item-logo {
	margin: 14px 0 0 15px;
	overflow: visible;
	position: relative;
	width: 38px;
	float: left;
}
.elgg-inner-nolog > h1 {
	font-size: 2em;
	color: white;
	text-shadow: 0 0 4px #999;
	padding: 13px;
	margin: 0 60px;
}
.elgg-inner-nolog > h1 a {
	text-decoration: none;
	color: inherit;
}
.elgg-page-default .elgg-page-body.nolog {
    margin:0 0 0 20px;
    padding-top:48px;
}
#login-dropdown-box {
	position: fixed;
}


/* 
* topbar
*/
.elgg-child-menu {
	background-color: #1F2E3D;
	border-radius: 0 10px 10px 0;
	box-shadow: 0 0 6px 2px rgba(10, 10, 10, 0.4);
	left: 40px;
	padding: 10px;
	position: fixed;
	display: none;
	text-align: left;
	z-index: 3;
}
.elgg-submenu-at { top: 96px }
.elgg-submenu-groups { top: 144px }
.elgg-child-menu li {
	border-radius: 6px;
	padding: 4px 8px;
}
.elgg-child-menu li:hover {
	background-color: #4690D6;
}
.elgg-child-menu li > a {
	font-weight: bold;
	color: white;
	display: block;
}
.elgg-child-menu li > a:hover {
	text-decoration: none;
}
.elgg-child-menu li a > img {
	vertical-align: middle;
}
.elgg-child-menu > .block-title {
	color: #CCC;
	border-top: 2px solid #CCC;
	border-radius: 0px;
	margin-top: 5px;
}
.elgg-child-menu  > .block-title:hover {
	background-color: transparent;
}
/* topbar icons */
.elgg-menu-item-logo {
	height: 48px !important;
	overflow: hidden;
}
.elgg-menu-item-logo > a {
	font-size:40px;
	padding-top: 15px;
	color: transparent;
	height: 33px;
	/*font-family: "Lucida Console", monospace;
	text-shadow: 0 0 0.02em #fff, -0.07em 0 0.03em #0f0, 0.07em 0 0.03em #f00;*/
	text-shadow: -0.1em 0 0.03em #0f0;
	transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
}
.elgg-menu-item-logo > a:before, .elgg-menu-item-logo > a:after {
	position: absolute;
	content: '∇';
	transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
}
.elgg-menu-item-logo > a:before {
	text-shadow:  0.03em 0 0.03em #f00;
}
.elgg-menu-item-logo > a:after {
	left: 6px;
	text-shadow: 0 0 0.02em #fff;
}
.elgg-menu-item-logo > a:hover {
	text-shadow:   -0.07em 0 4px #0f0,
                   -0.07em 0 7px #0f0,
                   -0.07em 0 8px #0f0,
                   -0.07em 0 10px #0f0,
                   -0.07em 0 15px #0f0;
}
.elgg-menu-item-logo > a:hover:before {
	text-shadow:   0.07em 0 4px #f00,
                   0.07em 0 7px #f00,
                   0.07em 0 8px #f00,
                   0.07em 0 10px #f00,
                   0.07em 0 15px #f00;
}
.elgg-menu-item-logo > a:hover:after {
	text-shadow:   0 0 1px #fff,
                   0 0 2px #fff,
                   0 0 3px #fff;
}
.ggouv-menu-item-html-char {
	padding: 5px 0 !important;
	cursor: pointer;
}
.ggouv-menu-item-html-char > a {
	font-size: 2em;
	font-weight: bold;
	/*text-shadow: 1px 0px 2px #AAAAAA;*/
	cursor: pointer;
	color: white;
	padding: 15px 0;
	transition: all 0.25s ease;
	-webkit-transition: all 0.25s ease;
	-moz-transition: all 0.25s ease;
	-o-transition: all 0.25s ease;
}
.ggouv-menu-item-html-char.hover > a {
	color: #4690D6;
	font-size: 3em;
	/*text-shadow: 4px 0px 2px #DEDEDE;*/
	transform: rotate(-10deg);
	-moz-transform: rotate(-10deg);
	-webkit-transform: rotate(-10deg);
	-o-transform: rotate(-10deg);
	-ms-transform: rotate(-10deg);
}
.ggouv-icons {
	background: transparent url(<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/ggouv_icons_full.png) no-repeat left;
	width: 25px;
	height: 25px;
	margin: 8px;
	display: inline-block;
}
/*.ggouv-icon-dashboard {
	background-position: -182px -146px;
}
.ggouv-icon-friends {
	background-position: -326px -218px;
}*/
.ggouv-icon-administration {
	background-position: -325px -82px;
}
.ggouv-icon-settings {
	background-position: -325px -352px;
}
.ggouv-icon-logout {
	background-position: -298px -55px;
}
.ggouv-icon-info {
	background-position: -113px -412px;
	width: 15px;
	height: 15px;
	margin: 2px;
}
.elgg-menu-item-info {
	border-top: 1px inset #666666;
	height: 19px !important;
	margin-top: 5px !important;
}

/* the wire-search textarea */
#thewire-header {
	position: relative;
	z-index: 7001;
	margin: 0 0 0 40px;
}
#thewire-header > #thewire-textarea {
	resize: vertical;
	height: 32px;
	min-height: 32px;
	padding: 10px 2px 0px 12px;
	margin: 0;
	color: #666;
	font: 130% Arial,Helvetica,sans-serif;
	border-radius: 4px 0 0 4px;
	border: none;
	width: 568px;
	position: absolute;
	right: -8px;
	z-index: 7001;
	-webkit-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	-moz-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	box-shadow: inset 0 2px 2px 0 #1F2E3D;
}
/* hack Chrome / Safari */
@media screen and (-webkit-min-device-pixel-ratio:0) {
	#thewire-header > #thewire-textarea {
		width: 565px;
		right: -5px;
	}
}
#thewire-header > #thewire-textarea:focus {
	background-color: white;
}
#thewire-header > #thewire-characters-remaining {
	position: absolute;
	z-index: 7003;
	right: -42px;
	top: 0;
	color: #00CC00;
	height: 32px;
	width: 38px;
	background-color: transparent;
	border: none;
	overflow: hidden;
}
#thewire-header > #thewire-characters-remaining span {
	display: block;
	font-size: 1.2em;
	height: 14px;
	padding: 9px 6px 9px 0;
	margin-left: -12px;
	border-radius: 0 4px 4px 0;
	background-color: white;
	-webkit-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	-moz-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	box-shadow: inset 0 2px 2px 0 #1F2E3D;
}
#thewire-header > .thewire-button {
	position: absolute;
	z-index: 7000;
	top: 0;
	left: 588px;
	height: 32px;
	width: 60px;
	border-radius: 0 4px 4px 0;
	overflow: hidden;
}
#thewire-header #thewire-submit-button {
	background: #FFE6E6 url(<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/send.png) left no-repeat;
	border: none;
	box-shadow: none;
	padding: 0 6px 0 20px;
	height: 32px;
	color:transparent;
	text-shadow: none;
	border-radius: 0 4px 4px 0;
	-webkit-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	-moz-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	box-shadow: inset 0 2px 2px 0 #1F2E3D;
	transition: none;
	-webkit-transition: none;
	-moz-transition: none;
	-o-transition: none;
}
#thewire-header #thewire-submit-button {
	background-position: 20px -58px;
}
#thewire-header #thewire-submit-button:hover {
	background-position: 20px -88px;
	background-color: #FF0000;
}
#thewire-header #thewire-submit-button.elgg-state-disabled:hover {
	background-position: 20px -28px;
	background-color: #FFE6E6;
}
#thewire-header-inactive {
	background: url("<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/send.png") no-repeat scroll 0 2px transparent;
	height: 30px;
	left: 648px;
	position: absolute;
	width: 30px;
	cursor: pointer;
	top: 0;
}
#thewire-header-inactive:hover {
	background-position: 0 -28px;;
}
.elgg-page-header .elgg-search {
	top: 0;
	left: 0;
	position: absolute;
	z-index: 6999;
	height: 0;
}
.elgg-page-header .elgg-search input[type="text"] {
	position: absolute;
	left: 40px;
	border: medium none;
	border-radius: 4px;
	height: 32px;
	width: 602px;
	-webkit-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	-moz-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	box-shadow: inset 0 2px 2px 0 #1F2E3D;
}
.elgg-search input[type="text"] {
	color: #0054A7;
	font: 130% Arial,Helvetica,sans-serif;
	padding: 4px 4px 0px 12px;
	background: none repeat scroll 0 0 white;
	position: relative;
	z-index: 1;
}
.elgg-page-header .elgg-search input[type="submit"] {
	background: #E6FFE6 url(<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/zoom.png) no-repeat 8px -58px;
	color: transparent;
	display: block;
	left: 40px;
	position: absolute;
	top: 0;
	width: 54px;
	border-radius: 4px 0 0 4px;
	border: none;
	height: 32px;
	-webkit-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	-moz-box-shadow: inset 0 2px 2px 0 #1F2E3D;
	box-shadow: inset 0 2px 2px 0 #1F2E3D;
}
.elgg-page-header .elgg-search input[type="submit"]:hover {
	background-position: 8px -88px;
	background-color: #00FF00;
	cursor: pointer;
}
#elgg-search-inactive {
	background: url("<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/zoom.png") no-repeat scroll 4px 2px transparent;
	height: 30px;
	left: 5px;
	position: absolute;
	width: 36px;
	cursor: pointer;
	top: 0;
}
#elgg-search-inactive:hover {
	background-position: 4px -28px;
}



/*
* river
*/
.elgg-river-layout {
	margin-left: -20px;
	padding: 0px;
}
.deck-river-lists .column-river:first-child > ul > li {
	padding-left: 10px;
}
.deck-river-listsdeck-river-lists .column-river:first-child > ul.column-header > li {
	padding-left: 5px;
}

/*
 * Groups
 */
.group_activity_module {
    float:right;
    padding-top:3px;
    width:32.22%;
}
.groups-profile.with_activity_module {
    float:left;
    width:66.12%;
}
#groups-tools.with_activity_module {
	width:66.12%;
	float:left;
}
#groups-tools.with_activity_module > li {
	width:49%;
}
#groups-tools.with_activity_module > li:nth-child(2n+1) {
    margin-right:2%;
}
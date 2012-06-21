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


/* topbar icons */
.ggouv-webfont {
	font-family: "ggouv";
}
.ggouv-webfont > a {
	padding: 5px 0;
	font-size: 50px;
	/*text-shadow: 1px 0px 2px #AAAAAA;*/
	cursor: pointer;
	color: white;
	padding: 15px 0;
	width: 40px;
	float: left;
	transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
}
.ggouv-webfont:hover > a {
	color: #4690D6;
}
.elgg-menu-item-logo {
	height: 48px !important;
	overflow: hidden;
}
.elgg-menu-item-logo > a {
	font-size: 58px;
	padding: 16px 7px 0px;
	color: transparent;
	height: 32px;
	width: 27px;
	text-shadow: -0.1em 0 0.03em #0f0;
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
	left: 5px;
}
.elgg-menu-item-logo > a:after {
	top: 16px;
	left: 4px;
	text-shadow: 0 0 0.02em #fff;
}
.elgg-menu-item-logo > a:hover {
	color: transparent;
	text-shadow:   -0.1em 0 4px #0f0,
                   -0.1em 0 7px #0f0,
                   -0.1em 0 8px #0f0,
                   -0.1em 0 10px #0f0,
                   -0.1em 0 15px #0f0;
}
.elgg-menu-item-logo > a:hover:before {
	text-shadow:   0.03em 0 4px #f00,
                   0.03em 0 7px #f00,
                   0.03em 0 8px #f00,
                   0.03em 0 10px #f00,
                   0.03em 0 15px #f00;
}
.elgg-menu-item-logo > a:hover:after {
	text-shadow:   0 0 1px #fff,
                   0 0 2px #fff,
                   0 0 3px #fff;
}
.ggouv-webfont.scale:hover > a {
	color: #4690D6;
	font-size: 70px;
}
.ggouv-webfont.rotate:hover > a {
	transform: rotate(-10deg);
	-moz-transform: rotate(-10deg);
	-webkit-transform: rotate(-10deg);
	-o-transform: rotate(-10deg);
	-ms-transform: rotate(-10deg);
}
.elgg-menu-item-at > a {
	padding-top: 25px;
}
.elgg-menu-item-info {
	height: 19px !important;
}
.elgg-menu-item-info > a {
	border-top: 1px solid #666666;
	padding: 0;
	color: white;
	font-size: 24px;
	margin-top: 5px;
}
.elgg-menu-item-info > a:hover {
	color: white;
	background-color: #4690D6;
}

/* 
* topbar sub-menu
*/
.ggouv-menu-parent {
	height: 50px !important;
}
.ggouv-menu-child {
	font-family: Arial,Tahoma,Verdana,sans-serif;
	border-radius: 0 20px 20px 0;
	margin-top: -10px;
	display: none;
	text-align: left;
	overflow: hidden;
	position: fixed;
}
.ggouv-menu-child-shadow {
	box-shadow: 0 0 6px 2px rgba(10, 10, 10, 0.4);
	border-radius: 0 10px 10px 0;
	padding: 10px;
	background-color: #1F2E3D;
	margin: 10px 10px 10px 0;
}
.ggouv-menu-parent:hover .ggouv-menu-child {
	display: inline;
}
/*.elgg-submenu-at { top: 96px }
.elgg-submenu-groups { top: 144px }*/
.ggouv-menu-child li {
	border-radius: 6px;
	padding: 4px 8px;
}
.ggouv-menu-child li:hover {
	background-color: #4690D6;
}
.ggouv-menu-child li a {
	font-weight: bold;
	color: white;
	display: block;
}
.ggouv-menu-child li a:hover {
	text-decoration: none;
}
.ggouv-menu-child li a img {
	vertical-align: middle;
}
.ggouv-menu-child .block-title {
	color: #CCC;
	border-top: 2px solid #CCC;
	border-radius: 0px;
	margin-top: 5px;
}
.ggouv-menu-child  .block-title:hover {
	background-color: transparent;
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
	width: 39px;
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
.deck-river-lists .elgg-list-item {
	background: #ffffff;
	background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#f6f6f6));
	background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 100%);
	background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 100%);
	background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 100%);
	background: linear-gradient(top,  #ffffff 0%,#f6f6f6 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 );
}

/*
 * Plugin markdown-wiki
 */
h2.markdown-wiki-create .elgg-button-action {
	text-transform: none;
}

/*
 * Output
 */
.text140-characters-remaining {
	position: relative;
}
.elgg-input-text140 input {
	padding-right: 40px;
}
.text140-characters-remaining span {
	color: #00CC00;
	position: absolute;
	right: 5px;
	font-weight: bold;
	font-size: 1.2em;
}
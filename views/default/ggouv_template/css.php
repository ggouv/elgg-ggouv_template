/*
 * Home page
 */

.elgg-page-default {
	min-width: 0px;
}
.homepage .elgg-page-body, .homepage .elgg-main {
	margin-left: 0 !important;
}
.homepage .elgg-layout-one-column {
	margin-right: 0;
}
.homepage .elgg-body {
	overflow: visible;
}
.signup {
	border: 30px solid white;
	border-radius: 130px;
	font-weight: bold;
	margin: 0px auto -120px;
	position: relative;
	width: 180px;
	clear: both;
}
.signup a {
	color: white;
	background: #4690D6;
	display: table-cell;
	border-radius: 100px;
	height: 180px;
	font-size: 1.4em;
	line-height: 1.7em;
	padding-left: 20px;
	vertical-align: middle;
	width: 160px;
}
.signup a:after {
	color: white;
	content: "\2192";
	font-size: 5em;
	position: absolute;
	right: 0;
	top: 75px;
}
.signup a:hover {
	text-decoration: none;
	background: #0054A7;
}
.homepage .elgg-body h2 {
	font-size: 2.8em;
	color: #333;
	margin-bottom: 30px;
}
.homepage .titre {
	color: #999;
	font-size: 1.7em;
	font-weight: bold;
	line-height: 1em;
	font-style: italic;
}
.homepage .color0 {
	color: #333333;
	font-size: 1.4em;
	background: transparent;
	border: none;
	width: 100%;
}
.homepage .red {
	color: #FF3D3D;
}

#section1 .span4 > div {
	background: #F9F9F9;
	max-height: 680px;
	margin: 60px 10px -20px;
	position: relative;
	-webkit-box-shadow: 0 0 5px 0 #999;
	box-shadow: 0 0 5px 0 #999;
}
#slideshow .caption, #section1 .rslides_nav span {
	background: rgba(255, 255, 255, 0.6);
	bottom: 0;
	color: rgba(0, 0, 0, 0.6);
	position: absolute;
}
#slideshow p {
	font-size: 1.3em;
	font-style: italic;
	font-weight: bold;
	line-height: 1.2em;
}
#slideshow .caption span {
	font-size: 1.2em;
	border-right: 1px solid #666;
}
#section1 .rslides_nav {
	height: 100%;
	position: absolute;
	top: 0;
	width: 50%;
	z-index: 100;
}
#section1 .rslides_nav span {
	opacity: 0;
	border-radius: 0 40px 40px 0;
	font-family: 'ggouv';
	font-size: 4em;
	height: 80px;
	line-height: 80px;
	margin: 0 -5px;
	text-align: center;
	bottom: 50%;
	width: 40px;
}
#section1 .rslides_nav:hover span {
	opacity: 1;
	text-decoration: none;
}
#section1 .rslides_nav.next {
	right: 0;
}
#section1 .rslides_nav.next span {
	right: 0;
	border-radius: 40px 0 0 40px;
}
#welcome {
	font-size: 3em;
	font-weight: bold;
	padding: 40px 0 20px;
	text-shadow: 0 -1px 0 #666666;
}
#welcome span {
	color: #1F2E3D;
	font-size: 1.1em;
}
.accroche {
	font-size: 1.8em;
	line-height: 1.4em;
	color: #0054A7;/*#4690D6;*/
	font-weight: bold;
	text-align: justify;
	clear: both;
}
.homepage .summary {
	color: #666;
	font-size: 1.5em;
	line-height: 1.5em;
	background: rgba(0, 0, 0, 0.02);
	padding: 50px 40px;
}
.homepage .summary:before, .homepage .summary:after, #slideshow p:before, #slideshow p:after {
	color: #DDD;
	content: "\0065";
	font-size: 7em;
	position: relative;
	margin: -40px -45px;
}
.homepage .summary:after, #slideshow p:after {
	content: "\0065";
	float: right !important;
	display: inline-block;
	margin: 40px -45px;
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	transform: rotate(180deg);
}
#slideshow p:before, #slideshow p:after {
	color: inherit;
	font-family: 'ggouv';
	float: none !important;
	font-size: 2em;
	font-weight: normal;
	margin: 0 5px 0 -3px;
}
#slideshow p:after {
	margin: 0 0 -8px 5px;
	vertical-align: bottom;
}
.homepage .questions {
	color: #666666;
	font-size: 1.5em;
	line-height: 1.8em;
	margin-top: 50px;
}
.homepage .questions:before {
	color: #E9E9E9;
	content: "\2192";
	font-size: 7em;
	margin: 40px 20px 110px 0;
}
.homepage .questions .q2 {
	color: #4690D6;
	font-size: 1.2em;
}
.homepage .questions .q3 {
	color: #0054A7;
	font-size: 1.5em;
}
.homepage .elgg-page-body a[href*="/wiki/"] {
	background: #E4ECF5;
	padding: 0 7px;
	border-radius: 5px;
	float: left;
	margin-top: 10px;
	font-size: 16px;
}
.homepage .elgg-page-body a[href*="/wiki/"]:before {
	font-family: "ggouv";
	content: "\2192";
	padding-right: 3px;
}
.homepage .elgg-page-body a[href*="/wiki/"]:hover {
	background: #4690D6;
	color: white;
	text-decoration: none;
}

.width80 {
	width: 80%;
	margin: 0 auto !important;
}
#section2 {
	background: #E4ECF5;
	padding-top: 130px;
}
#section3 .markdown-body h2 {
	background: transparent;
	color: #4690D6;
	font-size:2em;
	font-style: italic;
	font-weight: bold;
	line-height: 1em;
}
#section2 p, #section3 p {
	font-size: 1.2em;
}
#section2 .span8 li {
	color: #4690D6;
	font-size: 1.1em;
	list-style: none outside none;
	padding: 10px 0 10px 70px;
	position: relative;
}
#section2 li .gwf {
	color: #0054A7;
	font-size: 6em;
	left: -20px;
	position: absolute;
	top: -28px;
}
#section2 li strong {
	color: #0054A7;
}
#section2 .span4 {
	background: white;
	border-radius: 20px;
}
#section2 .elgg-item-idea {
	border: none;
	display: table;
	width: 100%;
}
#section2 .idea-left-column {
	margin: 0;
}
#section2 .elgg-subtext {
	display: none;
}

#section3 {
	padding: 50px 0;
}
#section3 .markdown-body h2 {
	border: medium none;
	margin-bottom: -10px;
	padding-top: 20px;
	clear: both;
}
#section3 .markdown-body h2 + div {
	color: #999;
	font-size: 1.7em;
	line-height: 1em;
	font-style: italic;
}
#section3 .type0 .header {
	border-bottom: 1px solid #DDD;
	color: #555;
	margin: 10px 0 15px;
	padding-bottom: 10px;
	clear: both;
}
#section3 .header.gwfb:before {
	margin-top: -23px;
}
#section3 .content {
	display: table;
	min-width: 220px;
	font-size: 0.9em;
}
#section3 .markdown-body img {
	-webkit-box-shadow: 0 0 5px 0 #999;
	box-shadow: 0 0 5px 0 #999;
}
#section3 .markdown-body .type1 {
	padding: 20px 0;
	font-size: 1.2em;
}
#section3 .markdown-body .type1:first-child {
	text-align: right;
}
#section3 .markdown-body .type0 img {
	clear: both;
	float: left;
	margin: 24px 20px 20px 0;
	max-width: 400px;
	min-width: 220px;
	width: 100%;
}
#section3 p + p + .row-fluid {
	padding-top: 20px;
}

#footer-home {
	background: none repeat scroll 0 0 #EEEEEE;
	height: 100px;
	margin-bottom: -20px;
	padding: 150px 0;
}
@media (max-width: 1599px) {
	.homepage .markdown-body {
		font-size: 10px;
	}
	.homepage a[href*="/wiki/"] {
		font-size: 13px;
	}
	#section3 .header.gwfb:before {
		margin-top: -19px;
	}
	#slideshow .caption {
		font-size: 0.85em;
	}
}
@media (max-width: 1199px) {
	#section1 .span4 > div {
		height: 300px;
		margin: 60px 90px 40px;
		overflow: hidden;
	}
	#slideshow img {
		width: 50%;
	}
	#slideshow .caption {
		width: 50%;
		float: left;
		position: relative;
		background: #F9F9F9;
		font-size: 1em;
	}
	#section1 .rslides_nav {
		width: 25%;
	}
	#section1 .rslides_nav span {
		bottom: 110px;
	}
	#section1 .rslides_nav.next {
		right: 50%;
	}
	#section2 .color0 {
		float: left;
		width: 50%;
	}
	#section2 .group-idea-list {
		-webkit-columns: 2 20px;
		-moz-columns: 2 20px;
		columns: 2 20px;
	}
	#section3 .markdown-body .type1:first-child {
		float: left;
		padding-top: 0;
		text-align: left;
	}
}

/*
* nolog css when non logged in user
*/
.elgg-page-header.nolog {
	background: #1F2E3D;
	-webkit-box-shadow: 0 5px 5px 0 white;
	box-shadow: 0 5px 5px 0 white;
	height: 46px;
	position: fixed;
	width: 100%;
	z-index: 9;
}
.elgg-inner-nolog {
	margin: 0;
	position: relative;
	padding-right: 160px;
}
.elgg-inner-nolog .elgg-menu-item-logo {
	margin: 0 0 0 15px;
	overflow: visible;
	position: relative;
	width: 38px;
	float: left;
}
.elgg-inner-nolog > h1 {
	font-size: 2em;
	color: white;
	text-shadow: 0 0 4px #999;
	padding: 11px;
}
.elgg-inner-nolog > h1 a {
	text-decoration: none;
	color: inherit;
}
.header-pages {
	border-left: 1px solid #666;
	height: 38px;
	margin: 3px 4px 4px 20px;
}
.header-page a {
	font-size: 1.6em;
	color: #EEE;
	border-radius: 4px;
}
.header-page a:hover {
	text-decoration: none;
	background: #4690D6;
}
.elgg-inner-nolog ul.float-alt {
	padding: 10px 18px 10px 0;
	border-right: 1px solid #666;
	margin: 3px 20px 4px;
	height: 18px;
	position: relative;
	width: 30%;
}
.elgg-inner-nolog .fbbutton, .elgg-inner-nolog .twitter-share-button {
	float: right;
	width: 100px;
}
.elgg-inner-nolog #___plusone_0 {
	width: 100px !important;
	margin: -2px 0 !important;
	float: right !important;
}
.elgg-inner-nolog .float-alt:hover .visible-desktop {
	display: block !important;
}
.elgg-page-default .elgg-page-body.nolog {
	margin:0 0 0 20px;
	padding-top:48px;
}
.elgg-page-default .shareButtons {
	color: #EEE;
	font-size: 1.3em;
	margin-top: -2px;
	padding: 3px 6px;
	border-radius: 4px;
}
.elgg-page-default .shareButtons:before {
	content: "\0072";
	font-size: 2em;
	padding-right: 5px;
}
.elgg-page-default .float-alt:hover .shareButtons {
	background: #4690D6;
}
#login-dropdown-box {
	position: fixed;
}
@media (max-width: 979px) {
	.elgg-inner-nolog .float-alt:hover .visible-desktop {
		background: white;
		border-radius: 5px 0 5px 5px;
		display: block !important;
		padding: 10px 8px 5px;
		position: absolute;
		right: 18px;
		top: 29px;
		width: 120px;
		border: 5px solid #4690D6;
		z-index: -1;
		box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	}
	.elgg-inner-nolog .float-alt .visible-desktop > * {
		float: left;
		padding-bottom: 8px;
	}
	.elgg-inner-nolog #___plusone_0 {
		margin: 1px 0 0 !important;
	}
}


/* topbar icons */
.gwf, .gwfb:before, .gwfa:after {
	font-family: "ggouv";
	font-weight: normal;
	float: left;
}
.elgg-menu-item-logo {
	height: 48px !important;
	overflow: hidden;
}
.elgg-menu-item-dashboard {
	overflow: hidden;
}
.elgg-menu-topbar .elgg-menu-item-logo a, .elgg-menu-item-logo a {
	font-size: 58px;
	padding: 16px 7px 0px;
	color: transparent;
	height: 32px;
	width: 27px;
	text-shadow: -0.1em 0 0.03em #0f0;
	float: left;
}
.elgg-menu-item-logo > a:before, .elgg-menu-item-logo > a:after {
	position: absolute;
	content: '∇';
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
	text-decoration: none;
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
.ajaxLoading .elgg-menu-item-logo {
	background: url(<?php echo elgg_get_site_url(); ?>/mod/elgg-ggouv_template/graphics/loaders/loader_white_black.gif) no-repeat scroll 5px 8px transparent;
}
.ajaxLoading .elgg-menu-item-logo a {
	-webkit-transform: scale(0);
	-moz-transform: scale(0);
	-o-transform: scale(0);
	-ms-transform: scale(0);
	transform: scale(0);
}
.gwf.scale:hover > a {
	color: #4690D6;
	font-size: 70px;
}
.gwf.rotate:hover > a {
	transform: rotate(-10deg);
	-moz-transform: rotate(-10deg);
	-webkit-transform: rotate(-10deg);
	-o-transform: rotate(-10deg);
	-ms-transform: rotate(-10deg);
}
.elgg-menu-item-at > a {
	padding-top: 25px;
}
.elgg-menu-topbar > li > a {
	padding: 5px 0;
	font-size: 50px;
	/*text-shadow: 1px 0px 2px #AAAAAA;*/
	cursor: pointer;
	color: white;
	padding: 15px 0;
	width: 40px;
	float: left;
}
.elgg-menu-item-dashboard > a {
	padding: 0 !important;
}
.elgg-menu-item-info {
	height: 19px !important;
	border-top: 1px solid #666666;
	color: white;
	font-size: 24px;
	float: left !important;
	cursor: pointer;
}
.elgg-menu-item-info:hover {
	color: white;
	background-color: #4690D6;
}

/*
* site info popup
*/
#site-info-popup {
	background-color: #1F2E3D;
	bottom: 0;
	box-shadow: 0 0 6px 4px #0A0A0A inset;
	margin: 0 -10px -20px;
	padding: 10px 10px 30px;
	position: fixed;
	width: 100%;
	z-index: 11;
}
#site-info-popup .spotlight {
	margin: 0 10%;
}
#site-info-popup h2 {
	color: white;
	text-shadow: 1px -1px 0 black;
}
#site-info-popup .elgg-icon-delete {
	left: 20px;
	position: absolute;
	top: 10px;
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
.elgg-menu-item-groups .ggouv-menu-child-shadow {

}
.elgg-menu-item-groups table ul ul {
	height: 100%;
}
.ggouv-menu-parent:hover .ggouv-menu-child {
	display: inline;
}
.ggouv-menu-child li {
	border-radius: 6px;
	padding: 4px 8px;
	cursor: pointer;
	margin: 2px 0;
}
.elgg-menu-item-groups .ggouv-menu-child-shadow ul:first-child {
	padding-left: 0;
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
}
.ggouv-menu-child .hr {
	border-right: 2px solid #CCCCCC;
	height: 30px;
}
.ggouv-menu-child  .block-title:hover {
	background-color: transparent;
}



/*
* river
*/
.elgg-river-layout {
	margin: 0 0 0 -20px;
	padding: 0px;
}
#deck-river-lists .column-river:first-child > ul > li {
	padding-left: 10px;
}
#deck-river-lists .column-river:first-child > ul.column-header > li {
	padding-left: 5px;
}
.elgg-river .elgg-list-item {
	background: -moz-linear-gradient(top,  rgba(255,255,255,0) 0%, rgba(200, 200, 200,0.1) 100%) white;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0)), color-stop(100%,rgba(200, 200, 200,0.1))) white;
	background: -webkit-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(200, 200, 200,0.1) 100%) white;
	background: -o-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(200, 200, 200,0.1) 100%) white;
	background: -ms-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(200, 200, 200,0.1) 100%) white;
	background: linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(200, 200, 200,0.1) 100%) white;
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#1a969696',GradientType=0 ) white;
}
.column-header:before {
	color: #CCCCCC;
	font-size: 2.8em;
	height: 30px;
	padding: 6px;
	text-shadow: -1px 1px 0 white;
}
.column-header[data-network="elgg"]:before {
	content: "∇";
	font-size: 3em;
	font-weight: bold;
	padding: 7px;
}
.column-header[data-network="twitter"]:before {
	content: "\0054";
}
.column-header[data-network="facebook"]:before {
	content: "\0046";
}
.elgg-river-item .elgg-icon-arrow-right {
	margin: 5px;
	padding-right: 10px;
}
.elgg-river table span.gwf {
	float: none;
	font-size: 10em;
	color: #EEE;
}


/*
 * Comments
 */
#comments {
	border-bottom: 1px solid #DDD;
}
#comments:before {
	color: #CCC;
	content: "C";
	font-size: 2.2em;
	padding-right: 5px;
}

/*
 * Plugin markdown-wiki + special debate
 */
h2.markdown-wiki-create .elgg-button-action {
	text-transform: none;
}
.markdown-body .subject {
	width: 100%;
}
/* Editor */
.markdown-editor {
	background-color: white;
	margin: -2px 5px;
	padding: 2px 2px 0 0;
	position: absolute;
	right: 0;
	top: 0;
	font-size: 32px;
}
.markdown-editor.fly {
	opacity: 0.8;
}
.markdown-editor:hover {
	opacity: 1 !important;
}
.markdown-editor .btn {
	float: left;
	width: 21px;
}
.markdown-editor .sep {
	margin: -2px -4px 0 6px;
	float: left;
	font-size: 16px;
	color: #999;
}
.markdown-editor > div:last-child {
	padding-right: 5px;
}
.markdown-editor .btn:before {
	cursor: pointer;
	text-align: center;
}
.markdown-editor .btn:hover:before {
	background-color: #4690D6;
	box-shadow: 0 0 5px #666;
	border-radius: 2px;
	font-size: 48px;
	margin: -5px 0;
	padding: 5px 0;
	position: relative;
}
.editor-title:before {
	content: "\F034";
}
.editor-bold:before {
	content: "\E01F";
}
.editor-italic:before {
	content: "\E079";
}
.editor-strike:before {
	content: "\E159";
}
.editor-bullet:before {
	content: "\F0CA";
}
.editor-numeric:before {
	content: "\F0CB";
}
.editor-quote:before {
	content: "\0065";
}
.editor-code:before {
	content: "\E032";
}
.editor-link:before {
	content: "U";
}
.editor-image:before {
	content: "\0070";
}
.editor-zero:before {
	content: "\F03B";
}
.elgg-menu-entity .elgg-menu-item-history a:before, .elgg-menu-entity .elgg-menu-item-discussion a:before {
	content: "\007A";
	font-size: 32px;
	margin: 0 2px;
	color: #CCC;
}
.elgg-menu-entity .elgg-menu-item-history a, .elgg-menu-entity .elgg-menu-item-discussion a {
	font-size: 0;
}
.elgg-menu-entity .elgg-menu-item-discussion a:before {
	content: "\006B";
}
.elgg-menu-entity .elgg-menu-item-history a:hover:before, .elgg-menu-entity .elgg-menu-item-discussion a:hover:before {
	color: #4690D6;
}


/*
 * Plugin workflow
 */
#card-forms .elgg-input-checkboxes {
	margin-top: 4px;
}
#card-forms .card-checklist .elgg-icon-delete {
	margin-top: 1px !important;
}
.workflow-list .elgg-icon-workflow-list {
	background: none;
}
.workflow-list .elgg-icon-workflow-list:before {
	background: none;
	color: #999;
	content: "\AC06";
	font-size: 36px;
	margin-left: -5px;
	font-weight: normal;
	-moz-transform: scaleX(0.6);
	-webkit-transform: scaleX(0.6);
	-o-transform: scaleX(0.6);
	-ms-transform: scaleX(0.6);
	transform: scaleX(0.6);
}

.elgg-icon-workflow-info:before {
	color: #999999;
	content: "\0069";
	font-size: 27px;
}
.workflow-card-info .elgg-icon {
	margin: -8px 7px 0 -3px;
}
.elgg-icon-workflow-speech-bubble:before  {
	color: #4690D6;
	content: "\0043";
	font-size: 28px;
}

.elgg-icon-workflow-calendar:before {
	color: #999999;
	content: "\0064";
	font-size: 27px;
}
.workflow-card-duedate-overdue .elgg-icon-workflow-calendar:before {
	color: red;
}
.workflow-card-info .elgg-icon-workflow-checklist {
	margin: -8px 4px 0 -1px;
}
.workflow-card-info .elgg-icon-workflow-checklist:before {
	color: #999999;
	content: "\AC08";
	font-size: 24px;
}
.workflow-card-checklist-complete .elgg-icon-workflow-checklist:before {
	color: green;
}



/*
 * plugin brainstorm
 */
.brainstorm-vote-popup .blanc {
	left: -8px;
}
.brainstorm-vote-popup .triangle {
	top: 5px;
}
.brainstorm-vote-popup .elgg-button:hover {
	color: white;
	text-shadow: none;
}
.brainstorm-vote-popup {
	-webkit-box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
	box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
	border-radius: 4px;
}


/*
 * plugin Answers...
 */
.question-view .elgg-comments {
	margin-top: 5px;
	border: none !important;
}
.question-view .elgg-comments:before {
	display: none;
}

/*
 * plugin bookmarks
 */
.favicon {
	vertical-align: text-top;
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
/* hack Chrome / Safari */
@media screen and (-webkit-min-device-pixel-ratio:0) {
	.text140-characters-remaining span {
		top: 4px;
	}
}


/*
 * xoxco tags
 */
div.tagsinput {
	-moz-box-sizing: border-box;
	border: 1px solid #CCCCCC;
	box-shadow: 1px 1px 2px 0 rgba(0, 0, 0, 0.2) inset;
	padding: 2px 5px 5px;
	width: 100%;
	overflow-y: auto;
	margin-top: 2px;
}
div.tagsinput.focus {
	background: none repeat scroll 0 0 #E4ECF5;
	border: 1px solid #4690D6;
	box-shadow: 1px 1px 2px 0 #4690D6 inset;
	color: #333333;
}
div.tagsinput span.tag {
	background-color: #4690D6;
	border-radius: 0px;
	color: white;
	display: block;
	float: left;
	margin: 3px 5px 0 0;
	padding: 1px 0 1px 5px;
	text-decoration: none;
}
div.tagsinput span.tag a {
	color: #4690D6;
	height: 12px;
	text-decoration: none;
	top: -1px;
	right: -3px;
}
div.tagsinput span.tag a:before {
	font-size: 40px;
}
div.tagsinput input {
	box-shadow: none;
	min-width: 440px !important;
	margin: 0;
	border: 1px solid transparent;
	padding: 2px 0 0;
	background: transparent;
	color: #000;
	outline: 0;
	margin: 3px 5px 0 0;
}
div.tagsinput div {
	display: block;
	float: left;
}
div.tagsinput .tags_clear {
	clear: both;
	width: 100%;
	height: 0;
}
div.tagsinput .not_valid {
	color: #90111A !important;
}

/*
 * profile
 */
.profile-action-menu .elgg-icon-attention:before {
	margin: 0 5px 0 0;
}
.profile-aboutme-title .elgg-widget-collapse-button {
	color: #555;
	font-weight: bold;
}
.profile-aboutme-title .elgg-widget-collapse-button:hover {
	color: #333;
}
.profile-action-menu.inlist {
	float: right;
}
.inlist .add_friend, .inlist .remove_friend {
	font-size: 30px;
	color: #CCC;
}
.inlist .add_friend:hover, .inlist .remove_friend:hover {
	text-decoration: none;
	color: #4690D6;
}


/*
 * super popup
 */
body, #super-popup {
	-webkit-transform-origin: 50% 50%;
	-moz-transform-origin: 50% 50%;
	-ms-transform-origin: 50% 50%;
	-o-transform-origin: 50% 50%;
	transform-origin: 50% 50%;
}
.super-popup-active body {
	height: 100%;
	position: fixed;
	-webkit-transform: scale(0.9);
	-moz-transform: scale(0.9);
	-ms-transform: scale(0.9);
	-o-transform: scale(0.9);
	transform: scale(0.9);
}
.super-popup-active body:before, .super-popup-active body:after, .super-popup-active .elgg-page:before {
	background: white;
	content: " ";
	height: 150%;
	position: absolute;
	width: 100%;
	z-index: 1000;
}
.super-popup-active body:before {
	top: -150%;
}
.super-popup-active body:after {
	bottom: -150%;
}
.super-popup-active .elgg-page:before {
	left: -100%;
	top: -10%;
}
.super-popup-active .elgg-page {
	height: 100%;
	overflow: hidden;
}
.super-popup-active #overlay {
	box-shadow: 0 0 600px 200px white inset;
	height: 102%;
	left: -5%;
	position: fixed;
	top: -1%;
	width: 110%;
	z-index: 9999;
}
.super-popup-active #goTop div {
	display: none;
}
#super-popup {
	display: none;
	background: white;
	border-radius: 5px;
	box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.4);
	min-height: 120px;
	max-height: 460px;
	left: 50%;
	margin: -250px -320px;
	padding: 20px 20px 7px;
	position: fixed;
	top: 50%;
	width: 600px;
	z-index: 9999;
	-webkit-transform: scale(0.6);
	-moz-transform: scale(0.6);
	-ms-transform: scale(0.6);
	-o-transform: scale(0.6);
	transform: scale(0.6);
}
#super-popup.tiny {
	height: 134px;
	margin: -160px -220px;
	width: 400px;
}
.super-popup-active #super-popup {
	display: block;
	-webkit-transform: scale(1.2);
	-moz-transform: scale(1.2);
	-ms-transform: scale(1.2);
	-o-transform: scale(1.2);
	transform: scale(1.2);
}
#super-popup .elgg-body {
	min-height: 80px;
}
#super-popup .elgg-footer {
	margin-right: -10px;
}
#super-popup .elgg-icon-delete-alt {
	position: absolute;
	top: 10px;
	right: 10px;
}



/* leaflet */
.leaflet-map-pane,
.leaflet-tile,
.leaflet-marker-icon,
.leaflet-marker-shadow,
.leaflet-tile-pane,
.leaflet-overlay-pane,
.leaflet-shadow-pane,
.leaflet-marker-pane,
.leaflet-popup-pane,
.leaflet-overlay-pane svg,
.leaflet-zoom-box,
.leaflet-image-layer,
.leaflet-layer{position:absolute;}
.leaflet-container{overflow:hidden;outline:0;}
.leaflet-tile,
.leaflet-marker-icon,
.leaflet-marker-shadow{-moz-user-select:none;-webkit-user-select:none;user-select:none;}
.leaflet-marker-icon,
.leaflet-marker-shadow{display:block;}
.leaflet-clickable{cursor:pointer;}
.leaflet-dragging, .leaflet-dragging .leaflet-clickable{cursor:move;}
.leaflet-container img{max-width:none !important;}
.leaflet-container img.leaflet-image-layer{max-width:15000px !important;}
.leaflet-tile-pane{z-index:2;}
.leaflet-objects-pane{z-index:3;}
.leaflet-overlay-pane{z-index:4;}
.leaflet-shadow-pane{z-index:5;}
.leaflet-marker-pane{z-index:6;}
.leaflet-popup-pane{z-index:7;}
.leaflet-tile{filter:inherit;visibility:hidden;}
.leaflet-tile-loaded{visibility:inherit;}
.leaflet-zoom-box{width:0;height:0;}
.leaflet-control{position:relative;z-index:7;pointer-events:auto;}
.leaflet-top,
.leaflet-bottom{position:absolute;z-index:1000;pointer-events:none;}
.leaflet-top{top:0;}
.leaflet-right{right:0;}
.leaflet-bottom{bottom:0;}
.leaflet-left{left:0;}
.leaflet-control{float:left;clear:both;}
.leaflet-right .leaflet-control{float:right;}
.leaflet-top .leaflet-control{margin-top:10px;}
.leaflet-bottom .leaflet-control{margin-bottom:10px;}
.leaflet-left .leaflet-control{margin-left:10px;}
.leaflet-right .leaflet-control{margin-right:10px;}
.leaflet-control-zoom{-moz-border-radius:7px;-webkit-border-radius:7px;border-radius:7px;}
.leaflet-control-zoom{padding:5px;background:rgba(0, 0, 0, 0.25);}
.leaflet-control-zoom a{background-color:rgba(255, 255, 255, 0.75);}
.leaflet-control-zoom a, .leaflet-control-layers a{background-position:50% 50%;background-repeat:no-repeat;display:block;}
.leaflet-control-zoom a{-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:19px;height:19px;}
.leaflet-control-zoom a:hover{background-color:#fff;}
.leaflet-touch .leaflet-control-zoom a{width:27px;height:27px;}
.leaflet-control-zoom-in{background-image:url(<?php echo elgg_get_site_url(); ?>/mod/elgg-ggouv_template/vendors/leaflet-0.4/images/zoom-in.png);margin-bottom:5px;}
.leaflet-control-zoom-out{background-image:url(<?php echo elgg_get_site_url(); ?>/mod/elgg-ggouv_template/vendors/leaflet-0.4/images/zoom-out.png);}
.leaflet-control-layers{box-shadow:0 1px 7px #999;background:#f8f8f9;-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;}
.leaflet-control-layers a{background-image:url(<?php echo elgg_get_site_url(); ?>/mod/elgg-ggouv_template/vendors/leaflet-0.4/images/layers.png);width:36px;height:36px;}
.leaflet-touch .leaflet-control-layers a{width:44px;height:44px;}
.leaflet-control-layers .leaflet-control-layers-list,
.leaflet-control-layers-expanded .leaflet-control-layers-toggle{display:none;}
.leaflet-control-layers-expanded .leaflet-control-layers-list{display:block;position:relative;}
.leaflet-control-layers-expanded{padding:6px 10px 6px 6px;font:12px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;color:#333;background:#fff;}
.leaflet-control-layers input{margin-top:2px;position:relative;top:1px;}
.leaflet-control-layers label{display:block;}
.leaflet-control-layers-separator{height:0;border-top:1px solid #ddd;margin:5px -10px 5px -6px;}
.leaflet-container .leaflet-control-attribution{background-color:rgba(255, 255, 255, 0.7);box-shadow:0 0 5px #bbb;margin:0;}
.leaflet-control-attribution,
.leaflet-control-scale-line{padding:0 5px;color:#333;}
.leaflet-container .leaflet-control-attribution,
.leaflet-container .leaflet-control-scale{font:11px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;}
.leaflet-left .leaflet-control-scale{margin-left:5px;}
.leaflet-bottom .leaflet-control-scale{margin-bottom:5px;}
.leaflet-control-scale-line{border:2px solid #777;border-top:none;color:black;line-height:1;font-size:10px;padding-bottom:2px;text-shadow:1px 1px 1px #fff;background-color:rgba(255, 255, 255, 0.5);}
.leaflet-control-scale-line:not(:first-child){border-top:2px solid #777;padding-top:1px;border-bottom:none;margin-top:-2px;}
.leaflet-control-scale-line:not(:first-child):not(:last-child){border-bottom:2px solid #777;}
.leaflet-touch .leaflet-control-attribution, .leaflet-touch .leaflet-control-layers{box-shadow:none;}
.leaflet-touch .leaflet-control-layers{border:5px solid #bbb;}
.leaflet-fade-anim .leaflet-tile, .leaflet-fade-anim .leaflet-popup{opacity:0;-webkit-transition:opacity 0.2s linear;-moz-transition:opacity 0.2s linear;-o-transition:opacity 0.2s linear;transition:opacity 0.2s linear;}
.leaflet-fade-anim .leaflet-tile-loaded, .leaflet-fade-anim .leaflet-map-pane .leaflet-popup{opacity:1;}
.leaflet-zoom-anim .leaflet-zoom-animated{-webkit-transition:-webkit-transform 0.25s cubic-bezier(0.25,0.1,0.25,0.75);-moz-transition:-moz-transform 0.25s cubic-bezier(0.25,0.1,0.25,0.75);-o-transition:-o-transform 0.25s cubic-bezier(0.25,0.1,0.25,0.75);transition:transform 0.25s cubic-bezier(0.25,0.1,0.25,0.75);}
.leaflet-zoom-anim .leaflet-tile,
.leaflet-pan-anim .leaflet-tile,
.leaflet-touching .leaflet-zoom-animated{-webkit-transition:none;-moz-transition:none;-o-transition:none;transition:none;}
.leaflet-zoom-anim .leaflet-zoom-hide{visibility:hidden;}
.leaflet-popup{position:absolute;text-align:center;}
.leaflet-popup-content-wrapper{padding:1px;text-align:left;}
.leaflet-popup-content{margin:14px 20px;}
.leaflet-popup-tip-container{margin:0 auto;width:40px;height:20px;position:relative;overflow:hidden;}
.leaflet-popup-tip{width:15px;height:15px;padding:1px;margin:-8px auto 0;-moz-transform:rotate(45deg);-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg);}
.leaflet-container a.leaflet-popup-close-button{position:absolute;top:0;right:0;padding:4px 5px 0 0;text-align:center;width:18px;height:14px;font:16px/14px Tahoma, Verdana, sans-serif;color:#c3c3c3;text-decoration:none;font-weight:bold;}
.leaflet-container a.leaflet-popup-close-button:hover{color:#999;}
.leaflet-popup-content p{margin:18px 0;}
.leaflet-popup-scrolled{overflow:auto;border-bottom:1px solid #ddd;border-top:1px solid #ddd;}
.leaflet-container{background:#ddd;}
.leaflet-container a{color:#0078A8;}
.leaflet-container a.leaflet-active{outline:2px solid orange;}
.leaflet-zoom-box{border:2px dotted #05f;background:white;opacity:0.5;}
.leaflet-div-icon{background:#fff;border:1px solid #666;}
.leaflet-editing-icon{border-radius:2px;}
.leaflet-popup-content-wrapper, .leaflet-popup-tip{background:white;box-shadow:0 3px 10px #888;-moz-box-shadow:0 3px 10px #888;-webkit-box-shadow:0 3px 14px #999;}
.leaflet-popup-content-wrapper{-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;}
.leaflet-popup-content{font:12px/1.4 "Helvetica Neue", Arial, Helvetica, sans-serif;}


/*! http://responsiveslides.com v1.53 by @viljamis */

.rslides {
  position: relative;
  list-style: none;
  overflow: hidden;
  width: 100%;
  padding: 0;
  margin: 0;
  }

.rslides li {
  -webkit-backface-visibility: hidden;
  position: absolute;
  display: none;
  width: 100%;
  left: 0;
  top: 0;
  }

.rslides li:first-child {
  position: relative;
  display: block;
  float: left;
  }

.rslides img {
  display: block;
  height: auto;
  float: left;
  width: 100%;
  border: 0;
  }

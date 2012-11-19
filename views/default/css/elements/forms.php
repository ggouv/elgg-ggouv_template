<?php
/**
 * CSS form/input elements
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	Form Elements
*************************************** */
fieldset > div {
	margin-bottom: 15px;
	position: relative;
	clear: both;
}
fieldset > div:last-child {
	margin-bottom: 0;
}
.elgg-form-alt > fieldset > .elgg-foot {
	border-top: 1px solid #CCC;
	padding: 10px 0;
}
label {
	font-weight: bold;
	color: #333;
	font-size: 110%;
}
label.error {
	background-color: transparent;
	color: red;
	font-size: 80%;
	padding: 0;
	position: absolute;
	right: 3px;
	bottom: -1px;
}
label.error.valid:after {
	color: #51C600;
	content: "œ";
	font-family: 'ggouv';
	font-size: 60px;
	font-weight: normal;
	position: absolute;
	right: 5px;
	bottom: 4px;
}
fieldset > div > label {
	background-color: #DEDEDE;
	padding: 2px 10px 3px;
}
input, textarea {
	border: 1px solid #ccc;
	color: #666;
	font: 120% Arial, Helvetica, sans-serif;
	padding: 5px;
	width: 100%;
	-webkit-box-shadow: 1px 1px 2px 0 rgba(0, 0, 0, 0.2) inset;
	box-shadow: 1px 1px 2px 0 rgba(0, 0, 0, 0.2) inset; 
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
input[type=text]:focus, textarea:focus {
	border: solid 1px #4690d6;
	-webkit-box-shadow: 1px 1px 2px 0 rgba(70, 145, 214, 0.5) inset;
	box-shadow: 1px 1px 2px 0 #4690D6 inset;
	background: #e4ecf5;
	color:#333;
}
textarea {
	height: 200px;
}

.pad {
	width: 15px;
	height: 30px;
	background-color: red;
	position: absolute;
}
.elgg-longtext-control {
	float: right;
	margin-left: 14px;
	font-size: 80%;
	cursor: pointer;
}
.description-wrapper {
	width: 100%;
	margin: 1px 0 15px 0;
}
.elgg-input-longtext {
	float: left;
	width: 50%;
	resize: none;
	overflow: hidden;
}
/*.elgg-input-longtext.markdown-body {
	margin-left: 15px;
}*/
.elgg-input-longtext.allWidth {
	width: 100%;
}
/* hack Chrome / Safari */
@media screen and (-webkit-min-device-pixel-ratio:0) {
	.elgg-input-longtext {
		margin-top: 1px;
	}
}
.elgg-preview-longtext {
	height: 188px;
}
.previewPaneWrapper .elgg-preview-longtext {
	margin-top: 1px !important;
	display: table;
}
.elgg-output-longtext.markdown-body {
	font-size: inherit;
}
.description-wrapper .toggle-longtext {
	background-color: #CCC;
	border-radius: 4px 4px 4px 4px;
	color: white;
	font-size: 28px;
	height: 18px;
	position: absolute;
	right: 0;
	text-indent: 1px;
	top: 0;
	width: 18px;
	cursor: pointer;
}
.description-wrapper .toggle-longtext:hover {
	background-color: #555;
}
.previewPaneWrapper.toggle {
	width: 100%;
}
.previewPaneWrapper.toggle div {
	margin-left: 0px;
	background-color: white;
}


.elgg-input-access {
	margin:5px 0 0 0;
}

input[type="checkbox"],
input[type="radio"] {
	margin:0 3px 0 0;
	padding:0;
	border:none;
	width:auto;
}
.elgg-input-checkboxes.elgg-horizontal li,
.elgg-input-radios.elgg-horizontal li {
	display: inline;
	padding-right: 10px;
}


/* ***************************************
	FRIENDS PICKER
*************************************** */
.friends-picker-main-wrapper {
	margin-bottom: 15px;
}
.friends-picker-container h3 {
	font-size:4em !important;
	text-align: left;
	margin:10px 0 20px !important;
	color:#999 !important;
	background: none !important;
	padding:0 !important;
}
.friends-picker .friends-picker-container .panel ul {
	text-align: left;
	margin: 0;
	padding:0;
}
.friends-picker-wrapper {
	margin: 0;
	padding:0;
	position: relative;
	width: 100%;
}
.friends-picker {
	position: relative;
	overflow: hidden;
	margin: 0;
	padding:0;
	width: 730px;
	height: auto;
	background-color: #dedede;
	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}
.friendspicker-savebuttons {
	background: white;
	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	
	margin:0 10px 10px;
}
.friends-picker .friends-picker-container { /* long container used to house end-to-end panels. Width is calculated in JS  */
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	list-style-type: none;
}
.friends-picker .friends-picker-container .panel {
	float:left;
	height: 100%;
	position: relative;
	width: 730px;
	margin: 0;
	padding:0;
}
.friends-picker .friends-picker-container .panel .wrapper {
	margin: 0;
	padding:4px 10px 10px 10px;
	min-height: 230px;
}
.friends-picker-navigation {
	margin: 0 0 10px;
	padding:0 0 10px;
	border-bottom:1px solid #ccc;
}
.friends-picker-navigation ul {
	list-style: none;
	padding-left: 0;
}
.friends-picker-navigation ul li {
	float: left;
	margin:0;
	background:white;
}
.friends-picker-navigation a {
	font-weight: bold;
	text-align: center;
	background: white;
	color: #999;
	text-decoration: none;
	display: block;
	padding: 0;
	width:20px;
	
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}
.tabHasContent {
	background: white;
	color:#333 !important;
}
.friends-picker-navigation li a:hover {
	background: #333;
	color:white !important;
}
.friends-picker-navigation li a.current {
	background: #4690D6;
	color:white !important;
}
.friends-picker-navigation-l, .friends-picker-navigation-r {
	position: absolute;
	top: 46px;
	text-indent: -9000em;
}
.friends-picker-navigation-l a, .friends-picker-navigation-r a {
	display: block;
	height: 40px;
	width: 40px;
}
.friends-picker-navigation-l {
	right: 48px;
	z-index:1;
}
.friends-picker-navigation-r {
	right: 0;
	z-index:1;
}
.friends-picker-navigation-l {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat left top;
}
.friends-picker-navigation-r {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat -60px top;
}
.friends-picker-navigation-l:hover {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat left -44px;
}
.friends-picker-navigation-r:hover {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat -60px -44px;
}
.friendspicker-savebuttons .elgg-button-submit,
.friendspicker-savebuttons .elgg-button-cancel {
	margin:5px 20px 5px 5px;
}
.friendspicker-members-table {
	background: #dedede;
	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	
	margin:10px 0 0;
	padding:10px 10px 0;
}

/* ***************************************
	AUTOCOMPLETE
*************************************** */
<?php //autocomplete will expand to fullscreen without max-width ?>
.ui-autocomplete {
	position: absolute;
	cursor: default;
}
.elgg-autocomplete-item .elgg-body {
	max-width: 370px;
}
.ui-autocomplete {
	background-color: white;
	border: 1px solid #ccc;
	overflow: hidden;
}
.ui-autocomplete .ui-menu-item {
	padding: 2px 4px;
}
.ui-autocomplete .ui-menu-item:hover {
	background-color: #eee;
}
.ui-autocomplete a:hover {
	text-decoration: none;
	color: #4690D6;
}
.elgg-user-picker .elgg-userpicker-remove {
	font-family: 'ggouv';
	color: #CCCCCC;
	content: "X";
	cursor: pointer;
	font-size: 54px;
	text-decoration: none;

	transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
}
.elgg-user-picker .elgg-userpicker-remove:hover {
	color: red;
}

/* ***************************************
	USER PICKER
*************************************** */
.elgg-user-picker-list li:first-child {
	border-top: 1px dotted #ccc;
	margin-top: 5px;
}
.elgg-user-picker-list > li {
	border-bottom: 1px dotted #ccc;
}

/* ***************************************
      DATE PICKER
**************************************** */
.ui-datepicker {
	display: none;

	margin-top: -2px;
	width: 208px;
	background-color: white;
	border: 2px solid #4690D6;
	overflow: hidden;

	-webkit-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
}
.ui-datepicker-inline {
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.ui-datepicker-header {
	position: relative;
	background: #4690D6;
	color: white;
	padding: 2px 0;
	border-bottom: 2px solid #4690D6;
}
.ui-datepicker-header a {
	color: white;
}
.ui-datepicker-prev, .ui-datepicker-next {
    position: absolute;
    top: 5px;
	cursor: pointer;
}
.ui-datepicker-prev {
    left: 6px;
}
.ui-datepicker-next {
    right: 6px;
}
.ui-datepicker-title {
    line-height: 1.8em;
    margin: 0 30px;
    text-align: center;
	font-weight: bold;
}
.ui-datepicker-calendar {
	margin: 4px;
}
.ui-datepicker th {
	color: #0054A7;
	border: none;
    font-weight: bold;
    padding: 5px 6px;
    text-align: center;
}
.ui-datepicker td {
	padding: 1px;
}
.ui-datepicker td span, .ui-datepicker td a {
    display: block;
    padding: 2px;
	line-height: 1.2em;
    text-align: right;
    text-decoration: none;
}
.ui-datepicker-calendar .ui-state-default {
	border: 1px solid #ccc;
    color: #4690D6;;
	background: #fafafa;
}
.ui-datepicker-calendar .ui-state-hover {
	border: 1px solid #aaa;
    color: #0054A7;
	background: #eee;
}
.ui-datepicker-calendar .ui-state-active,
.ui-datepicker-calendar .ui-state-active.ui-state-hover {
	font-weight: bold;
    border: 1px solid #0054A7;
    color: #0054A7;
	background: #E4ECF5;
}

<?php
/**
 * CSS buttons
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* **************************
	BUTTONS
************************** */

/* Base */
.elgg-button {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial,sans-serif;
	text-transform:uppercase;
	
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;

	width: auto;
	padding: 3px 4px 2px;
	margin-bottom: 4px;
	cursor: pointer;
	outline: none;
	
	-webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.40);
	-moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.40);
	box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.40);
	
	transition: all 0.25s ease;
	-webkit-transition: all 0.25s ease;
	-moz-transition: all 0.25s ease;
	-o-transition: all 0.25s ease;
}
a.elgg-button {
	padding: 3px 6px 2px;
}

/* Submit: This button should convey, "you're about to take some definitive action" */
.elgg-button-submit {
	/*color: white;
	text-shadow: 1px 1px 0px black;
	text-decoration: none;
	border: 1px solid #4690d6;
	background: #4690d6 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	background-color: #4690D6; 
	background-image: -moz-linear-gradient(center top , #4690D6, #4D90FE);*/	
	background: #4690d6;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzQ2OTBkNiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM0ZDkwZmUiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-linear-gradient(top,  #4690d6 0%, #4d90fe 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#4690d6), color-stop(100%,#4d90fe));
	background: -webkit-linear-gradient(top,  #4690d6 0%,#4d90fe 100%);
	background: -o-linear-gradient(top,  #4690d6 0%,#4d90fe 100%);
	background: -ms-linear-gradient(top,  #4690d6 0%,#4d90fe 100%);
	background: linear-gradient(top,  #4690d6 0%,#4d90fe 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4690d6', endColorstr='#4d90fe',GradientType=0 );

	border: 1px solid #3079ED;
	color: white;
}

.elgg-button-submit:hover {
	border-color: #0054a7;
	
	-webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.80);
	-moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.80);
	box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.80);
}

.elgg-button-submit:active {
	border-color: #0054a7;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.elgg-button-submit.elgg-state-disabled {
	background: #999;
	border-color: #999;
	cursor: default;
}

/* Cancel: This button should convey a negative but easily reversible action (e.g., turning off a plugin) */
.elgg-button-cancel {
	color: #333;
	background: #ddd url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	border: 1px solid #999;
}
.elgg-button-cancel:hover {
	color: #444;
	background-color: #999;
	background-position: left 10px;
	text-decoration: none;
}

/* Action: This button should convey a normal, inconsequential action, such as clicking a link */
.elgg-button-action {
	background: #ccc url(<?php echo elgg_get_site_url(); ?>_graphics/button_background.gif) repeat-x 0 0;
	border:1px solid #999;
	color: #333;
	padding: 2px 15px;
	text-align: center;
	font-weight: bold;
	text-decoration: none;
	text-shadow: 0 1px 0 white;
	cursor: pointer;
	
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.elgg-button-action:hover,
.elgg-button-action:focus {
	background: #ccc url(<?php echo elgg_get_site_url(); ?>_graphics/button_background.gif) repeat-x 0 -15px;
	color: #111;
	text-decoration: none;
	border: 1px solid #999;
}

/* Delete: This button should convey "be careful before you click me" */
.elgg-button-delete {
	color: #bbb;
	text-decoration: none;
	border: 1px solid #333;
	background: #555 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	text-shadow: 1px 1px 0px black;
}
.elgg-button-delete:hover {
	color: #999;
	background-color: #333;
	background-position: left 10px;
	text-decoration: none;
}

.elgg-button-dropdown {
	padding:3px 6px;
	text-decoration:none;
	display:block;
	font-weight:bold;
	position:relative;
	margin-left:0;
	color: white;
	border:1px solid #71B9F7;
	
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:4px;
	
	-webkit-box-shadow: 0 0 0;
	-moz-box-shadow: 0 0 0;
	box-shadow: 0 0 0;
	
	/*background-image:url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png);
	background-position:-150px -51px;
	background-repeat:no-repeat;*/
}

.elgg-button-dropdown:after {
	content: " \25BC ";
	font-size:smaller;
}

.elgg-button-dropdown:hover {
	background-color:#71B9F7;
	text-decoration:none;
}

.elgg-button-dropdown.elgg-state-active {
	background: #ccc;
	outline: none;
	color: #333;
	border:1px solid #ccc;
	
	-webkit-border-radius:4px 4px 0 0;
	-moz-border-radius:4px 4px 0 0;
	border-radius:4px 4px 0 0;
}

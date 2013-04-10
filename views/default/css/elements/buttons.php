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
	color: white;
	background-color: white;

	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;

	width: auto;
	padding: 3px 6px 2px;
	margin-bottom: 4px;
	cursor: pointer;
	outline: none;

	-webkit-box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.1);
	box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.1);

	transition: background-color 0.25s ease, border 0.25s ease, color 0.25s ease;
	-webkit-transition: background-color 0.25s ease, border 0.25s ease, color 0.25s ease;
	-moz-transition: background-color 0.25s ease, border 0.25s ease, color 0.25s ease;
	-o-transition: background-color 0.25s ease, border 0.25s ease, color 0.25s ease;
}
.elgg-button:active {
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
.elgg-button:hover {/*, .elgg-button:focus {*/
	color: white;
	text-decoration: none;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);

	-webkit-box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.2);
	box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.2);
}

/* Submit: This button should convey, "you're about to take some definitive action" */
.elgg-button-submit {
	border: 1px solid #398235;
	background-color: #51C600;
}

.elgg-button-submit:hover, .elgg-button-submit:focus {
	background-color: #359930;
	border: 1px solid #045900;
}
.elgg-button-submit.elgg-state-disabled {
	background: #999;
	border-color: #999;
	cursor: default;
}
.elgg-button-submit.elgg-state-disabled:hover {
	text-shadow: none;
}
.elgg-button-submit.elgg-state-disabled:active {
	-webkit-box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.15);
	box-shadow: inset 0px -10px 10px 2px rgba(0, 0, 0, 0.15);;
}

/* Cancel: This button should convey a negative but easily reversible action (e.g., turning off a plugin) */
.elgg-button-cancel {
	border: 1px solid #999;
	color: #333;
}
.elgg-button-cancel:hover, .elgg-button-cancel:focus {
	background-color: #999;
}

/* Action: This button should convey a normal, inconsequential action, such as clicking a link */
.elgg-button-action {
	border: 1px solid #999;
	color: #333;
}

.elgg-button-action:hover, .elgg-button-action:focus {
	background-color: #55ADFF;
	border: 1px solid #4690D6;
}
.elgg-button-action:active {
	border-color: #0054a7;
}

/* Delete: This button should convey "be careful before you click me" */
.elgg-button-delete {
	border: 1px solid #999;
	color: #333;
}
.elgg-button-delete:hover, .elgg-button-delete:focus {
	background-color: #ff3019;
	border: 1px solid #cf0404;
}
.elgg-button-delete:active {
	border-color: #C81906;
}

.elgg-button-dropdown {
	text-decoration: none;
	color: #333;
	border: 1px solid #999;

	/*-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:4px;

	-webkit-box-shadow: 0 0 0;
	-moz-box-shadow: 0 0 0;
	box-shadow: 0 0 0;*/

	/*background-image:url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png);
	background-position:-150px -51px;
	background-repeat:no-repeat;*/
}

.elgg-button-dropdown:after {
	content: "ì";
	padding-left: 5px;
	font-family: "ggouv";
	font-size: 1.2em;
	font-weight: normal;
	text-transform: none;
	vertical-align: sub;
}

.elgg-button-dropdown:hover {
	background-color: #71B9F7;
	text-decoration: none;
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
.elgg-button.group_admin_only {
	border:1px solid red;
}

/*
 * Add webfont icon
 */
.elgg-button-delete:before {
	font-family: "ggouv";
	font-size: 54px;
	font-weight: normal;
	margin-right: 4px;
	float: left;
	content: "X";
	color: #ff3019;
}
.elgg-button-delete:hover:before {
	color: #333;
}
.elgg-button.gwfb:before {
	font-size: 32px;
	margin: -2px 4px 0 0 ;
	text-transform: lowercase;
}
.elgg-button.edit-button:before {
	content: "ë";
}
.elgg-button.invit-button:before {
	content: "m";
}
.elgg-button.leave-button:before {
	content: "l";
}
.elgg-button.join-button:before {
	content: "j";
}
.elgg-button.refresh-button:before {
	content: "R";
	margin-top: -1px;
	text-transform: uppercase;
}
.elgg-button.archive-button:before {
	content: "â";
}
.elgg-button.add_friend:before {
	content: "o";
}
.elgg-button.remove_friend:before {
	content: "p";
}
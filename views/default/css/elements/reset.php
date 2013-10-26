<?php
/**
 * CSS reset
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* Generated at http://everythingfonts.com/font-face October 25, 2013 */
@font-face {
	font-family: 'ggouv';
	src: url('<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/fonts/'; ?>ggouv-web-font.eot');
	src: url('<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/fonts/'; ?>ggouv-web-font.eot?#iefix') format('embedded-opentype'),
		url('<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/fonts/'; ?>ggouv-web-font.woff') format('woff'),
		url('<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/fonts/'; ?>ggouv-web-font.ttf') format('truetype'),
		url('<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/fonts/'; ?>ggouv-web-font.otf') format("opentype"),
		url('<?php echo elgg_get_site_url() . 'mod/elgg-ggouv_template/graphics/fonts/'; ?>ggouv-web-font.svg#ggouv') format('svg');
	font-weight: normal;
	font-style: normal;
	font-variant:normal;
}


/* ***************************************
	RESET CSS
*************************************** */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-weight: inherit;
	font-style: inherit;
	font-size: 100%;
	font-family: inherit;
	vertical-align: baseline;
}
body {
	background-color: white;
}
<?php // force vertical scroll bar ?>
html, body {
	height: 100%;
}
img {
	border-width:0;
	border-color:transparent;
}
:focus {
	outline: 0 none;
}
ol, ul {
	list-style: none;
}
em, i {
	font-style:italic;
}
ins {
	text-decoration:none;
}
del {
	text-decoration:line-through;
}
strong, b {
	font-weight:bold;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
caption, th, td {
	text-align: left;
	font-weight: normal;
	vertical-align: top;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: "";
}
blockquote, q {
	quotes: "" "";
}
a {
	text-decoration: none;
}

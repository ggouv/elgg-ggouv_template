<?php
/**
 * Displays the default shortcut icon overriding the default ELGG view.
 */
?>

<link rel="icon" type="image/png" href="<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo elgg_get_site_url(); ?>mod/elgg_ggouv_template/graphics/favicon.ico" />

<?php /* seems not usefull, apple goes automaticaly search on disk for these format :
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png"> */
?>
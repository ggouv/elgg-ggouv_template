<?php
/**
 *	Elgg-ggouv_template plugin
 *	@package elgg-ggouv_template
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license GNU Affero General Public License, version 3 or late
 *	@link https://github.com/ggouv/elgg-ggouv_template
 **/
?>

<div class="social-connect">
	<h2 class ="mbl"><?php echo elgg_echo('registration:social-connect'); ?></h2>
	<a href="<?php echo elgg_get_site_url(); ?>twitter_api/forward">
		<span class="twitter-icon gwfb t"></span>Twitter
	</a>
	<a href="<?php echo elgg_get_site_url(); ?>twitter_api/forward">
		<span class="facebook-icon gwfb t"></span>Facebook
	</a>
	<a href="<?php echo elgg_get_site_url(); ?>twitter_api/forward">
		<span class="google-icon gwfb t"></span>Google
	</a>
</div>

<div class="register-helper username hidden">
	<?php echo elgg_echo('registration:helper:username'); ?>
</div>
<div class="register-helper name hidden">
	<?php echo elgg_echo('registration:helper:name'); ?>
</div>
<div class="register-helper email hidden">
	<?php echo elgg_echo('registration:helper:email'); ?>
</div>
<div class="register-helper location hidden">
	<?php echo elgg_echo('registration:helper:location'); ?>
</div>
<div class="register-location">
	<span><?php echo elgg_echo('registration:localisation:text'); ?></span>
	<div id="map" class="mtm"></div>
</div>
<div class="register-helper password hidden">
	<?php echo elgg_echo('registration:helper:password'); ?>
	<div id="complexity" class="mvs">0 %</div>
	<div id="progressbar">
		<div id="progress"></div>
	</div>
</div>


<style type="text/css">
	#progressbar {
		display: block;
		height: 18px;
		overflow: hidden;
		width: 400px;
	}
	#progress {
		display:block;
		height:18px;
		width:0%;
		border-radius: 4px;
	}
	.progressbarValid {
		background-color:green;
		background-image: -o-linear-gradient(-90deg, #8AD702 0%, #389100 100%);
		background-image: -moz-linear-gradient(-90deg, #8AD702 0%, #389100 100%);
		background-image: -webkit-linear-gradient(-90deg, #8AD702 0%, #389100 100%);
		background-image: -ms-linear-gradient(-90deg, #8AD702 0%, #389100 100%);
		background-image: linear-gradient(-90deg, #8AD702 0%, #389100 100%);
	}
	.progressbarInvalid {
		background-color:red;
		background-image: -o-linear-gradient(-90deg, #F94046 0%, #92080B 100%);
		background-image: -moz-linear-gradient(-90deg, #F94046 0%, #92080B 100%);
		background-image: -webkit-linear-gradient(-90deg, #F94046 0%, #92080B 100%);
		background-image: -ms-linear-gradient(-90deg, #F94046 0%, #92080B 100%);
		background-image: linear-gradient(-90deg, #F94046 0%, #92080B 100%);
	}
	#complexity {
		font-size: 20px;
		font-weight: bold;
	}
</style>
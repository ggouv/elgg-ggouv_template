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
	<!--h2 class ="mbl"><?php echo elgg_echo('registration:social-connect'); ?></h2>
	<a href="<?php echo elgg_get_site_url(); ?>twitter_api/forward">
		<span class="twitter-icon gwfb t"></span>Twitter
	</a>
	<a href="<?php echo elgg_get_site_url(); ?>twitter_api/forward">
		<span class="facebook-icon gwfb t"></span>Facebook
	</a>
	<a href="<?php echo elgg_get_site_url(); ?>twitter_api/forward">
		<span class="google-icon gwfb t"></span>Google
	</a-->
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
<div class="register-helper password hidden pam">
	<?php echo elgg_echo('registration:helper:password'); ?>
	<div id="complexity" class="mvs">0 %</div>
	<div id="progressbar">
		<div id="progress"></div>
	</div>
</div>


<style type="text/css">
	.elgg-form-login, .elgg-form-account {
		max-width: 450px;
	}
	.register-helper, .register-location {
		margin-left: 500px;
		position: absolute;
		top: 15px;
		width: 100%;
		font-style: italic;
	}
	.register-helper.username {
		top: 60px;
	}
	.register-helper.name {
		top: 140px;
	}
	.register-helper.email {
		top: 192px;
	}
	.register-helper.location {
		top: 254px;
	}
	.register-location {
		opacity: 0;
	}
	.elgg-form-signup #searching.loading {
		right: -35px;
		top: 20px;
	}
	.register-helper.password {
		background: white;
		border-radius: 0 10px 10px 0;
		top: 316px;
		width: 280px;
	}
	.social-connect {
		border-left: 2px solid #CCCCCC;
		left: 500px;
		padding-left: 50px;
		position: absolute;
		top: 10px;
		z-index: 1;
	}
	.social-connect a {
		clear: both;
		float: left;
		font-size: 30px;
		margin: 10px;
		padding: 20px;
		text-decoration: none;
		text-shadow: 1px 1px 1px #CCCCCC;
		width: 70%;
	}
	.social-connect a:hover {
		background-color: #F4F4F4;
	}
	.social-connect span:before {
		float: left;
		margin-top: 2px;
	}
	.social-connect span { /*.twitter-icon {*/
		font-size: 68px;
		width: 80px;
		float: left;
	}
	.social-connect a:hover span {
		font-size: 88px;
	}
	.back-socialnetwork {
		color: #999999;
		float: right;
		margin-top: -22px;
		position: relative;
		cursor: pointer;
	}
	.back-socialnetwork:hover {
		color: #555;
	}
	.back-socialnetwork:after {
		content: "►";
	}
	#progressbar {
		display: block;
		height: 18px;
		overflow: hidden;
		width: 280px;
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
<?php
	echo "<div class='elgg-menu-item-logo gwf'><a class='t' href='" . elgg_get_site_url() . "'>&nabla;</a></div>";
	echo '<h1 class="float mls"><a href="' . elgg_get_site_url() . '">' . elgg_get_config('sitename') . '</a></h1>';
	if ($url_blog = elgg_get_plugin_setting('blog_of_site', 'elgg-ggouv_template')) $url['Blog'] = $url_blog;
	if ($url){
		echo '<ul class="header-pages float">';
		foreach ($url as $key => $value) {
			echo '<ul class="header-page mhl"><a href="' . $value . '" class="pam float">' . $key . '</a></ul>';
		}
		echo '</ul>';
	}
	echo '<ul class="float-alt">';
	echo '<span class="shareButtons hidden-desktop gwfb link float-alt">' . elgg_echo('ggouv:share') . '</span><div class="visible-desktop">';
	echo '<div class="fbbutton"><div id="fb-root"></div>';
	echo '<div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="verdana"></div></div>';
	echo '<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));</script>';
	echo '<a href="https://twitter.com/share" class="twitter-share-button" data-text="Un réseau social politique" data-lang="fr" data-hashtags="ggouv">Tweeter</a>';
	echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
	echo '<div class="g-plusone"></div>';
	echo '<script type="text/javascript">
	  window.___gcfg = {lang: "fr"};
	  (function() {
	    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
	    po.src = "https://apis.google.com/js/plusone.js";
	    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>';
	echo '</div></ul>';
?>
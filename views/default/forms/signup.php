<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

$password = $password2 = '';
$username = get_input('u');
$email = get_input('e');
$name = get_input('n');
$location = get_input('l');

if (elgg_is_sticky_form('register')) {
	extract(elgg_get_sticky_values('register'));
	elgg_clear_sticky_form('register');
}

?>
<span class="back-socialnetwork hidden"><?php echo elgg_echo('registration:back:socialnetwork'); ?></span>
<br/><div>
	<label><?php echo elgg_echo('registration:username'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'username',
		'value' => $username,
		'class' => 'required namecheckcar',
		'minlength' => 4,
		'maxlength' => 30
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('registration:name'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'name',
		'value' => $name,
		'class' => '',
		'maxlength' => 90
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('email'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'email',
		'value' => $email,
		'class' => 'required email',
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('Code postal'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'location',
		'value' => $location,
		'class' => 'digits registerCP',
		'minlength' => 5,
		'maxlength' => 5
	));
	?>
	<span id="searching"></span>
</div>
<div>
	<label><?php echo elgg_echo('password'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'id' => 'password',
		'name' => 'password',
		'value' => $password,
		'class' => 'required',
		'minlength' => 6,
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('passwordagain'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password2',
		'value' => $password2,
		'class' => 'required',
		'equalTo' => '#password',
		'minlength' => 6,
	));
	?>
</div>

<?php
// view to extend to add more fields to the registration form
echo elgg_view('register/extend');

// Add captcha hook
echo elgg_view('input/captcha');

echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('register'), 'id' => 'button-signup'));
echo '</div>';

?>

<script language="Javascript">
	$(document).ready(function() {

		/*
		Complexify function for password

		http://github.com/danpalmer/jquery.complexify.js
		This code is distributed under the WTFPL v2:
		*/
		(function($){$.fn.extend({complexify:function(options,callback){var MIN_COMPLEXITY=49;var MAX_COMPLEXITY=120;var CHARSETS=[[48,57],[65,90],[97,122],[33,47],[58,64],[91,96],[123,126],[128,255],[256,383],[384,591],[592,687],[688,767],[768,879],[880,1023],[1024,1279],[1328,1423],[1424,1535],[1536,1791],[1792,1871],[1920,1983],[2304,2431],[2432,2559],[2560,2687],[2688,2815],[2816,2943],[2944,3071],[3072,3199],[3200,3327],[3328,3455],[3456,3583],[3584,3711],[3712,3839],[3840,4095],[4096,4255],[4256,4351],
		[4352,4607],[4608,4991],[5024,5119],[5120,5759],[5760,5791],[5792,5887],[6016,6143],[6144,6319],[7680,7935],[7936,8191],[8192,8303],[8304,8351],[8352,8399],[8400,8447],[8448,8527],[8528,8591],[8592,8703],[8704,8959],[8960,9215],[9216,9279],[9280,9311],[9312,9471],[9472,9599],[9600,9631],[9632,9727],[9728,9983],[9984,10175],[10240,10495],[11904,12031],[12032,12255],[12272,12287],[12288,12351],[12352,12447],[12448,12543],[12544,12591],[12592,12687],[12688,12703],[12704,12735],[12800,13055],[13056,13311],
		[13312,19893],[19968,40959],[40960,42127],[42128,42191],[44032,55203],[55296,56191],[56192,56319],[56320,57343],[57344,63743],[63744,64255],[64256,64335],[64336,65023],[65056,65071],[65072,65103],[65104,65135],[65136,65278],[65279,65279],[65280,65519],[65520,65533]];var defaults={minimumChars:8,strengthScaleFactor:1};if($.isFunction(options)&&!callback){callback=options;options={}}options=$.extend(defaults,options);function additionalComplexityForCharset(str,charset){for(var i=str.length-1;i>=0;i--)if(charset[0]<=
		str.charCodeAt(i)&&str.charCodeAt(i)<=charset[1])return charset[1]-charset[0]+1;return 0}return this.each(function(){$(this).keyup(function(){var password=$(this).val();var complexity=0,valid=false;for(var i=CHARSETS.length-1;i>=0;i--)complexity+=additionalComplexityForCharset(password,CHARSETS[i]);complexity=Math.log(Math.pow(complexity,password.length))*(1/options.strengthScaleFactor);valid=complexity>MIN_COMPLEXITY&&password.length>=options.minimumChars;complexity=complexity/
		MAX_COMPLEXITY*100;complexity=complexity>100?100:complexity;callback.call(this,valid,complexity)})})}})})(jQuery);

		$('.elgg-form-signup').validate({
			success: "valid",
			rules: {
				username: {
					remote: {
						url: 'ajax/view/ggouv_template/ajax/form_validation',
						type: 'POST'
					}
				}
			},
			messages: {
				username: {
					minlength: $.validator.format(elgg.echo('registration:usernametooshort', [4])),
					maxlength: $.validator.format(elgg.echo('registration:usernametoolong', [30])),
					remote: $.validator.format(elgg.echo('registration:userexists'))
				},
				location: {
					minlength: $.validator.format(elgg.echo('registration:locationtooshort', [5]))
				}
			},
			invalidHandler: ggouv.shakeButton
		});


		if ($(".elgg-form-signup input[name='username']").val().length) $('.elgg-form-signup').valid(); // perform valid() in case of REFERER

		// resize stuffs
		$('.elgg-form-signup, #map, .social-connect').height(Math.max($('.elgg-form-signup').height(), $(window).height() - $('.elgg-form-signup').position().top - 93));
		$('#map').width($(window).width() - 540);

		var villes = new L.FeatureGroup();
		$('.elgg-form-signup input').focus(function() {
			$('.social-connect').hide();
			$('.back-socialnetwork').show().click(function() {
				$(this).hide();
				$('.register-location').hide();
				$('.social-connect').show();
			});
			var name = $(this).attr('name');
			if (name == 'password2') name = 'password';
			if (name != 'location') $('.register-helper, .register-location').hide();
			if (name == 'location' && $(this).val().length > 4 && $(this).val() != '75000') {
				$('.register-location').fadeIn(300);
			} else {
				$('.register-helper.'+name).fadeIn(300);
			}
		}).blur(function() {
			if ($(this).attr('name') != 'location') $('.register-helper, .register-location').hide();
		});
		$("#password").complexify({strengthScaleFactor: 0.5, minimumChars: 6 }, function (valid, complexity) {
			if (!valid) {
				$('#progress').css({'width':complexity + '%'}).removeClass('progressbarValid').addClass('progressbarInvalid');
			} else {
				$('#progress').css({'width':complexity + '%'}).removeClass('progressbarInvalid').addClass('progressbarValid');
			}
			$('#complexity').html(Math.round(complexity) + ' %');
		});
		$(".elgg-form-signup input[name='location']").keyup(function(k) {
			if ($(".elgg-form-signup input[name='location']").val().length < 5) {
				$('.register-location').hide();
				$('.register-helper.location').html(elgg.echo('registration:helper:location')).show();
				if (map.hasLayer(villes)) {
					villes.clearLayers();
					map.removeLayer(villes);
				}
			} else {
				$('.register-location, .register-helper.location').show();
			}
		}).searchlocalgroup({
			nbrChar: 5,
			beforeSendCallback: function() {
				$('label[for="location"]').addClass('hidden').css('display', '');
			},
			successCallback: function(response) {
				if ($(".elgg-form-signup input[name='location']").val() == '75000') {
					$('.register-helper.location').html(elgg.echo('registration:helper:location:paris'));
					$('.register-location').hide();
					$('input[name="location"]').addClass('notfound');
					$('label[for="location"]').removeClass('hidden');
				} else if (response == false) {
					$('#map').css({opacity: 0});
					$('label[for="location"]').removeClass('valid hidden').html(elgg.echo('ggouv:search:localgroups:notfound'));
					$('.register-location').show().animate({opacity: 1});
					$('.register-helper.location').html(elgg.echo('registration:helper:location'));
					$('input[name="location"]').addClass('notfound');
				} else {
					$('#map').css({opacity: 1});
					$('.register-location').show().animate({opacity: 1});
					$('.register-helper.location').html(elgg.echo('registration:helper:location'));
					$('label[for="location"]').removeClass('valid hidden').html('');
					$('input[name="location"]').removeClass('notfound');
					if (map.hasLayer(villes)) {
						villes.clearLayers();
						map.removeLayer(villes);
					}

					var maxHab = 0,
						maxHabKey = 0,
						markers = [];
					$.each(response, function(key, value) {
						var LeafletPopup = $('<div>').append(
						$('<h2>').html(value.article+' '+value.ville).after(
							$('<span>', {style: 'font-size: 1.5em;'}).html(value.cp).after(
								$('<h3>').html(elgg.echo('groups:localgroup:departement')).after(
									$('<span>', {style: 'font-size: 1.2em;'}).html(value.dep+' ('+value.nom_dep+')')
						))).clone()).remove().html();

						markers[key] = L.marker([value.lat, value.long]).bindPopup(LeafletPopup);
						if (parseFloat(value.habitants30122008) > maxHab) {
							maxHabKey = key;
							maxHab = parseFloat(value.habitants30122008);
						}
						villes.addLayer(markers[key]);
					});
					map.addLayer(villes).fitBounds(villes.getBounds());
					markers[maxHabKey].openPopup();
				}
			}
		});


	});

	$(window).bind("resize", function() {
		$('.elgg-form-signup').height('auto');
		$('.elgg-form-signup, #map, .social-connect').height(Math.max($('.elgg-form-signup').height(), $(window).height() - $('.elgg-form-signup').position().top - 93));
		$('#map').width($(window).width() - 540);
	});

</script>

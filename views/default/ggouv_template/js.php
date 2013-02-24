
// js for ggouv template
elgg.provide('elgg.ggouv_template');

elgg.ggouv_template.init = function() {

	// hide developers-log when empty
	if ( $('.developers-log').html() == '' ) $('.developers-log').hide();

	$(document).ready(function() {
		elgg.ggouv_template.ready();
	});


	/*
	* Ajaxified site
	*/
	parsePage = function(url, data) {
		var data = data || false,
			fragment = data.fragment || false;

		if (data.dataForm) {
			dataPost = data.dataForm + '&ajaxified=true';
		} else {
			dataPost = 'ajaxified=true';
		}
		elgg.post(url, {
			data: dataPost,
			success: function(response, textStatus, xmlHttp) {
				if (response.match('^{"output":')) { // This is for action ! note: when server is down > Object { readyState=0, status=0, statusText="error"}
					var urlP = elgg.parse_url(url),
						urlM = urlP.path,
						HTTPredirect = elgg.normalize_url(decodeURIComponent(xmlHttp.getResponseHeader('Redirect')));

					if (urlM.match('/action/groups/featured') || urlM.match('/action/groups/leave')) {
						History.pushState(data, null, data.origin); //parsePage(window.location.href);
					} else if (HTTPredirect != null) {
						if (urlM.match('/action/brainstorm/delete')) {
							var brainstorm_guid = elgg.parse_str(urlP.query).guid;
							$('.elgg-body #elgg-object-'+brainstorm_guid).css('background-color', '#FF7777').fadeOut();
						}
						History.pushState(data, null, HTTPredirect); // catch forward() from > header('Redirect': ... see ggouv_template_forward_hook
					} else if (xmlHttp.status = 200) {
						window.location.replace(url); // in case of...
					}

					elgg.register_error(JSON.parse(response).system_messages.error);
					elgg.system_message(JSON.parse(response).system_messages.success);

				} else {
					var title = $(response).filter('title').text();
					$('title').html(title);
					$('.elgg-page-messages').html($(response).filter('.elgg-page-messages').html());
					$('.elgg-page-body').html($(response).filter('.elgg-page-body').html());
					eval($('#JStoexecute').text()); // hack to reload js/initialize_elgg forked in page/elements/reinitialize_elgg

					if (!data.noscroll) $(window).scrollTop(0);

					elgg.ggouv_template.reloadTemplateFunctions();
				}
				if (fragment && $('#'+fragment).length) {
					$(window).scrollTo($('#'+fragment), 'slow', {offset:-60});
				}
				$('#ajaxified-loader').addClass('hidden');
			},
			error: function(response) {
				console.log(response, 'error');
				$('#ajaxified-loader').addClass('hidden');
			}
			/*error: function(jqXHR, textStatus, errorThrown){
				document.location.href = url;
				return false;
			}*/
		});
	}

	var History = window.History;
	if (History.enabled) {
		var rootUrl = History.getRootUrl();
		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack) {
			var $this = $(obj),
				url = $this.attr('href') || '';
			// Check link
			return url.substring(0,rootUrl.length) === rootUrl || url.indexOf(':') === -1;
		};

		// prevent scroll with link finished by #
		$(".elgg-page-body a:internal[href$='#']").live('click', function(e){
			e.preventDefault();
			return false;
		});

		// ajaxify links
		$(".elgg-page-body a:internal:not("+
								"[href=''],"+
								"[href^='#'],"+
								"[href$='#'],"+
								"[rel=toggle],"+
								"[rel=popup],"+
								"[href*='/admin/'],"+
								"[href*='/ajax/'],"+
								"[href*='view=rss'],"+
								"[href*='address='],"+
								"[href*='/avatar/edit'],"+
								"[href*='/action/widgets/delete'],"+
								"[href*='/action/workflow/list/delete'],"+
								"[href*='notifications/personal']),"+
			".elgg-page-topbar a:internal:not([href*='/admin/'],"+
									" [href*='/ajax/'],"+
									" [href*='/logout']),"+
			"#site-info-popup a:internal:not([href*='home=true']),"+
			".deck-popup.pinned a:internal:not([href^='#'])"
		).live('click', function(e) {
			var $this = $(this),
				url = elgg.normalize_url(decodeURIComponent($this.attr('href'))),
				urlP = elgg.parse_url(url),
				ExecAction = function(url, callback) {
					elgg.action(url, {
						success: function(json) {
							callback();
						}
					});
				};

			if ( e.which == 2 || e.metaKey ) { return true; } // Continue as normal for cmd clicks etc

			// first, verify if there is confirmation. Continue on true.
			if (!$this.hasClass('elgg-requires-confirmation') || $this.hasClass('elgg-requires-confirmation') && elgg.ui.requiresConfirmation(e, $this)) {

				// if it's an actions, do action and skip history.
				if (url.match('/action/comments/delete')) {
					ExecAction(url, function() {
						$('#item-annotation-'+elgg.parse_str(urlP.query).annotation_id).css('background-color', '#FF7777').fadeOut();
						if ($('#card-forms').length) elgg.workflow.addCommentonCard($this.parents('#card-forms').find('input[name="entity_guid"]').val(), -1);
					});
				} else if (url.match('/action/friends/add')) {
					ExecAction(url, function() {
						$('a.elgg-button.add_friend').blur().removeClass('add_friend').addClass('remove_friend').text(elgg.echo('friend:remove')).attr('href', function(i, val) {
							return elgg.get_site_url() + 'action/friends/remove?' + elgg.parse_url(val, 'query')
						});
						var stats = $('.user-stats li:first-child .stats');
						stats.html(parseInt(stats.html())+1);
					});
				} else if (url.match('/action/friends/remove')) {
					ExecAction(url, function() {
						$('a.elgg-button.remove_friend').blur().removeClass('remove_friend').addClass('add_friend').text(elgg.echo('friend:add')).attr('href', function(i, val) {
							return elgg.get_site_url() + 'action/friends/add?' + elgg.parse_url(val, 'query')
						});
						var stats = $('.user-stats li:first-child .stats');
						stats.html(parseInt(stats.html())-1);
					});
				} else if (url.match('/action/river/delete')) {
					ExecAction(url, function() {
						$('.item-river-'+elgg.parse_str(urlP.query).id).css('background-color', '#FF7777').fadeOut();
					});
				} else if (url.match('/action/workflow/delete')) {
					ExecAction(url, function() {
						var board_guid = elgg.parse_str(urlP.query).guid;
						$('#elgg-object-'+board_guid).css('background-color', '#FF7777').fadeOut();
						$('.workflow-sidebar .elgg-list-item.board-'+board_guid).css('background-color', '#FF7777').fadeOut();
					});

				// it's a link
				} else {

					var fragment = urlP.fragment || false,
						path_url = urlP.path,
						url_origin = elgg.normalize_url(decodeURIComponent(window.location.href)),
						path_origin = elgg.parse_url(url_origin, 'path');

					if (fragment && path_origin == path_url) { //same page, got to #hash
						if ($('#'+fragment).length) $(window).scrollTo($('#'+fragment), 'slow', {offset:-60});
					} else {
						History.pushState({origin: url_origin, fragment: fragment}, null, url.split("#")[0]);
					}
				}
			}
			e.preventDefault();
			return false;
		});

		// ajaxify submit forms
		$("input[type=submit]:not("+
						"[id='thewire-submit-button'],"+
						"[id='button-signin'],"+
						"[id='button-signup'],"+
						"[id='workflow-edit-card-submit'],"+
						"[class*='workflow-card-submit'],"+
						"[id='workflow-list-submit'],"+
						"[class*='noajaxified'])"
		).die().live('click', function(e) {
			var form = $(this).parents('form'),
				dataForm = form.serialize(),
				replaceHighlight = function(elem, t) {
					elem.effect("highlight", {}, 3000)
						.find('.elgg-output').replaceWith($('<div>', {'class': 'elgg-output markdown-body'}).html(ShowdownConvert(t)));
					elem.find('pre code').each(function(i, e) {
						if (e.className == '') $(e).addClass('no-highlight');
						hljs.highlightBlock(e);
					});
				};

			if (form.hasClass('elgg-form-editablecomments-edit')) { // Special for editable comment

				elgg.action('editablecomments/edit', {
					data: dataForm,
					success: function(json) {
						var annotation_id = form.find('input[name=annotation_id]').val();

						$('#editablecomments-edit-annotation-'+annotation_id).toggle();
						replaceHighlight($('#item-annotation-'+annotation_id), json.output);
					}
				});

			} else if (form.hasClass('elgg-form-comments-add')) { // Special for live comment

				elgg.action('livecomments/add', {
					data: dataForm,
					success: function(json) {
						var orderBy = form.hasClass('desc') ? 'desc' : 'asc',
							comBlock = form.parents('.elgg-comments'),
							ul = comBlock.find('ul.elgg-list-annotation'),
							li = $(json.output).find('li:first'),
							txt = li.find('.elgg-output').html(),
							liID = li.attr('id');

						if (orderBy ==  'asc') {
							if (ul.length < 1) {
								comBlock.prepend(json.output);
								if (!form.hasClass('tiny')) comBlock.prepend($('<h3>', {id: 'comments'}).html(elgg.echo('comments')));
							} else {
								ul.append($(json.output).find('li:first'));
							}
						} else if (orderBy == 'desc') {
							if (ul.length < 1) {
								comBlock.prepend($('<h3>', {id: 'comments'}).html(elgg.echo('comments')), json.output);
							} else {
								ul.prepend(li);
							}
						}
						replaceHighlight($('#'+liID), txt);
						form.find('textarea').val('').height(190);
						form.find('.preview-markdown').html('').height(178);
						elgg.markdown_wiki.edit.init();
					}
				});

			} else { // ajaxify others forms

				var url = elgg.normalize_url(decodeURIComponent(form.attr('action'))),
					url_origin = elgg.normalize_url(decodeURIComponent(window.location.href));

				History.pushState({origin: url_origin, dataForm: dataForm}, null, url);

			}
			e.preventDefault();
			return false;
		});

		$(window).bind('statechange',function() { //History.Adapter.bind(window, 'statechange', function(event) {
			var State = History.getState();

			if (State) {
				$('#ajaxified-loader').removeClass('hidden');
				parsePage(State.url, State.data);
			}
		});
	}

	//Custom jquery validation message. Need to be called after plugin jquery validation loaded
	jQuery.extend(jQuery.validator.messages, {
		required: elgg.echo('forms:required'),
		remote: elgg.echo('forms:remote'),
		email: elgg.echo('registration:notemail'),
		url: elgg.echo('forms:url'),
		date: elgg.echo('forms:date'),
		dateISO: elgg.echo('forms:dateISO'),
		number: elgg.echo('forms:number'),
		digits: elgg.echo('forms:digits'),
		creditcard: "Please enter a valid credit card number.",
		equalTo: elgg.echo('registration:passwordagainnotvalid'),
		accept: "Please enter a value with a valid extension.",
		maxlength: jQuery.validator.format(elgg.echo('forms:maxlength')),
		minlength: jQuery.validator.format(elgg.echo('forms:minlength')),
		rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
		range: jQuery.validator.format("Please enter a value between {0} and {1}."),
		max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
		min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
	});

}
elgg.register_hook_handler('init', 'system', elgg.ggouv_template.init);


elgg.ggouv_template.reloadTemplateFunctions = function() {
	$('body').removeClass('homepage');
	$('.tipsy').remove(); // in case of
	if (typeof piwikTracker != 'undefined' && typeof piwikTracker.trackPageView == 'function') {
		piwikTracker.setDocumentTitle(document.title);
		piwikTracker.setCustomUrl(window.location.href);
		piwikTracker.trackPageView();
	}
	elgg.trigger_hook('ready', 'system');
	elgg.ui.widgets.init();

	elgg.userpicker.init();
	elgg.autocomplete.init();
	elgg.markdown_wiki.reload();
	elgg.deck_river.init();
	elgg.brainstorm.init();
	elgg.tags.init();
	elgg.workflow.reload();
	elgg.answers.init();
	elgg.ggouv_pad.resize();
	elgg.ggouv_template.ready();

	// compatibility for refresh button in board view
	$('.elgg-menu-item-refresh-board .elgg-button').die().live('click', function(e) {
		var url = elgg.normalize_url(decodeURIComponent($(this).attr('href')));
		$('#ajaxified-loader').removeClass('hidden');
		parsePage(url);
		e.preventDefault();
		return false;
	});

	// Reload autocomplete elgg.userpicker.userList @todo remove it for next version. Elgg 1.8.9 don't fix it
	elgg.userpicker.userList = {};
	$('.elgg-user-picker-list li input').each(function(i, elem) {
		$(elgg.userpicker.userList).prop($(elem).val(), true);
	});
}


elgg.ggouv_template.ready = function() {
	eval($('#JStoexecute').text());
	/*
	 * Resize, scroll and sidebar
	 */

	// Tooltip
	$('.tooltip').tipsy({
		live: true,
		offset: function() {
			if ($(this).hasClass('o8')) return 8;
			return 5;
		},
		fade: true,
		html: true,
		delayIn: 500,
		gravity: function() {
			if ($(this).hasClass('nw')) return 'nw';
			if ($(this).hasClass('n')) return 'n';
			if ($(this).hasClass('ne')) return 'ne';
			if ($(this).hasClass('w')) return 'w';
			if ($(this).hasClass('e')) return 'e';
			if ($(this).hasClass('sw')) return 'sw';
			if ($(this).hasClass('s')) return 's';
			if ($(this).hasClass('se')) return 'se';
			return 'n';
		}
	});

	// go top button
	$(window).scroll(function() {
		if ($(window).scrollTop() > 300) {
			$('#goTop').css('bottom', 0);
		} else {
			$('#goTop').css('bottom', -50);
		}
	});
	$('#goTop').click(function() {
		$(window).scrollTo(0, 500);
	});

	// site-info-popup from info button in vertical menu
	$('.elgg-menu-item-info').die().live('click', function() {
		if (!$('#site-info-popup').length) {
			$('.elgg-page-body').after($('<div>', {id: 'site-info-popup', 'class': 'row-fluid hidden'}));
		}
		elgg.get('ajax/view/ggouv_template/ajax/site_info_popup', {
			success: function(response) {
				$('#site-info-popup').html(response).toggle('slide', {direction:'down'});
			},
			error: function() {
				$('#site-info-popup').remove();
			}

		});
	});
	$('#site-info-popup .elgg-icon-delete').die().live('click', function() {
		$('#site-info-popup').fadeOut(500, function() {
			$(this).remove();
		});
	});

	// Sidebar
	if (!$('.elgg-page-admin').length && $(window).scrollTop() + $(window).height() > $('.elgg-sidebar').height() + 48 + 10) {
		$('.elgg-sidebar').css({'position': 'fixed', 'bottom': 0});
	} else if (!$('.elgg-page-admin').length) {
		$('.elgg-sidebar').css({'position': 'absolute', 'bottom': 'auto'});
	}
	var resizeSidebar = function() {
		// special code for elgg-markdown_wiki page history
		if ($('#slider').length && ($('.history-module .elgg-body').height() < $('#ownerContainer').height())) {
			$('#slider').height(0);
			var maxHeight = 0;
			$('.elgg-sidebar > *:not(script)').each(function() {
				maxHeight += $(this).outerHeight(true);
			});
			$('#slider').height($(window).height() - maxHeight - 48 - 21); // 48 = $('.elgg-page-header').height()
			var nbrDiff = $('.diff-output .diff').length -1;
			if ($('#ownerContainer .owner:not(.hidden)').length) {
				var uiValue = $('#ownerContainer .owner:not(.hidden)');
			} else {
				uiValue = $('#ownerContainer .owner:first');
			}
			var OwnerOffset = uiValue.position();
			var valString = uiValue.attr('id');
			var value = valString.substr(valString.indexOf('owner-') + "owner-".length);
			$('#ownerContainer').stop().css({top: (nbrDiff-value)*($('#slider').height()/nbrDiff) - OwnerOffset.top});
		}
		var maxHeight = 0;
		$('.elgg-sidebar > *:not(script, #goTop)').each(function() {
			maxHeight += $(this).outerHeight(true);
		});
		var exPos = $(window).height() - $('.elgg-sidebar > .elgg-menu-extras-default').height();
		if (exPos > maxHeight) {
			$('.elgg-sidebar').height($(window).height() - 48 - 10); // 48 = $('.elgg-page-header').height()   // 10 = sidebar padding
		} else {
			$('.elgg-sidebar').css('position', 'absolute');
			$('.elgg-sidebar .elgg-menu-extras-default').css('position', 'relative');
			$(window).scroll(function() {
				if ($(window).scrollTop() + $(window).height() > $('.elgg-sidebar').height() + 48 + 10) {
					$('.elgg-sidebar').css({'position': 'fixed', 'bottom': 0});
				} else {
					$('.elgg-sidebar').css({'position': 'absolute', 'bottom': 'auto'});
				}
			});
		}
	}

	// Group activity
	var resizeGroupActivity = function() {
		$('.group_activity_module .elgg-module > .elgg-body > .elgg-river').height($(window).height() - 48 - 51);
	}

	if (!$('.elgg-page-admin').length) {
		resizeSidebar();
		if ($('.group_activity_module').length && $('.group_activity_module').is(':visible')) {
			var TheColumn = $('.group_activity_module');
			resizeGroupActivity();
			elgg.deck_river.LoadEntity(elgg.get_page_owner_guid(), $('.group_activity_module'));
		}
		$('.elgg-sidebar, .elgg-sidebar-2, .elgg-sidebar-2 .group_activity_module').fitElement('width', 5, { minSize: '252.8px', maxSize: '360px' }, $(window), function() {
			$('.elgg-sidebar-2, .elgg-layout-one-sidebar').css('margin-right', $('.elgg-sidebar').width() + 30);
		});
	}

	// Resize if groups-profile-fields is taller than 200px
	if ($('.groups-profile-fields').length) {
		if ($('.groups-profile-fields').height() > 200) {
			$('.groups-profile-fields .description').prepend('<a rel="toggle" class="elgg-widget-collapse-button elgg-state-active elgg-widget-collapsed" href="#groups-description">&nbsp;'+ elgg.echo('groups:description') +'</a>');
			$('.groups-profile-fields #groups-description').hide();
		}
	}

	// validate forms
	jQuery.validator.addMethod("namecheckcar", function(value, element) {
		return this.optional(element) || /^[a-zA-Z][a-zA-Z0-9_-]{3,30}$/.test(value);
	}, elgg.echo('registration:namecheckcar'));

	$('.elgg-form-groups-edit').validate({
		invalidHandler: function(form, validator) {
			$('.elgg-form .elgg-button-submit').animate({'margin-left': 10}, 100, function() {
				$(this).effect("shake", {times:2, distance:10}, 100, function() {
					$(this).animate({'margin-left': 0}, 100);
				});
			});
		}
	});

	$('.elgg-form-profile-edit, .elgg-form-user-requestnewpassword').validate({
		invalidHandler: function(form, validator) {
			$('.elgg-form .elgg-button-submit').animate({'margin-left': 10}, 100, function() {
				$(this).effect("shake", {times:2, distance:10}, 100, function() {
					$(this).animate({'margin-left': 0}, 100);
				});
			});
		}
	});

	$('.elgg-form-signup').validate({
		success: "valid",
		rules: {
			username: {
				remote: {
					url: 'ajax/view/ggouv_template/ajax/form_validation',
					type: 'POST',
				}
			}
		},
		messages: {
			username: {
				minlength: elgg.echo('registration:usernametooshort', [4]),
				maxlength: elgg.echo('registration:usernametoolong', [30]),
				remote: elgg.echo('registration:userexists'),
			},
			location: {
				minlength: elgg.echo('registration:locationtooshort', [5]),
			}
		},
		invalidHandler: function(form, validator) {
			$('.elgg-form .elgg-button-submit').animate({'margin-left': 10}, 100, function() {
				$(this).effect("shake", {times:2, distance:10}, 100, function() {
					$(this).animate({'margin-left': 0}, 100);
				});
			});
		}
	});

	if ($('.elgg-form-signup').length) {
		$('.elgg-form-signup, #map, .social-connect').height($(window).height() - $('.elgg-form-signup').position().top - 93);
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
			} else {
				$('.register-location, .register-helper.location').show();
			}
		}).searchlocalgroup(function(response) {
			if ($(".elgg-form-signup input[name='location']").val() == '75000') {
				$('.register-helper.location').html(elgg.echo('registration:helper:location:paris'));
				$('.register-location').hide();
			} else if (response == false) {
				$('#map').css({opacity: 0});
				$('#searching').addClass('notfound').html(elgg.echo('ggouv:search:localgroups:notfound'));
				$('.register-location').show().animate({opacity: 1});
				$('.register-helper.location').html(elgg.echo('registration:helper:location'));
			} else {
				$('#map').css({opacity: 1});
				$('.register-location').show().animate({opacity: 1});
				$('.register-helper.location').html(elgg.echo('registration:helper:location'));
				if (hasMarkers) map.removeLayer(villes);
				var maxHab = 0,
					maxNorth = -90,
					maxSouth = 90,
					maxEast = -180,
					maxOuest = 180,
					maxHabKey = 0,
					markers = [];
				$.each(response, function(key, value) {
					var popupContent = $('<div>').append(
						$('<h2>').html(value.article+' '+value.ville).after(
							$('<span>', {style: 'font-size: 1.5em;'}).html(value.cp).after(
								$('<h3>').html(elgg.echo('groups:localgroup:departement')).after(
									$('<span>', {style: 'font-size: 1.2em;'}).html(value.dep)
						))).clone()).remove().html();
					markers.push(L.marker([value.lat, value.long]).bindPopup(
					popupContent));
					if (parseFloat(value.lat) > maxNorth) maxNorth = parseFloat(value.lat);
					if (parseFloat(value.lat) < maxSouth) maxSouth = parseFloat(value.lat);
					if (parseFloat(value.long) > maxEast) maxEast = parseFloat(value.long);
					if (parseFloat(value.long) < maxOuest) maxOuest = parseFloat(value.long);
					if (parseFloat(value.habitants30122008) > maxHab) {
						maxHabKey = key;
						maxHab = parseFloat(value.habitants30122008);
					}
				});
				villes = L.layerGroup(markers);
				map.addLayer(villes).fitBounds([[maxSouth, maxOuest], [maxNorth, maxEast]]).setZoom(12);
				markers[maxHabKey].openPopup();
				hasMarkers = true;
			}
		}, 5);
	}
	/*jQuery.validator.addMethod("registerCP", function(value, element) {
		if (value.length != 5) return false;
		elgg.post('ajax/view/ggouv_template/ajax/get_city', {
			dataType: 'json',
			data: {
				city: value,
			},
			beforeSend:  function() {
				$('#map').removeClass().html('').addClass('loading');
			},
			success: function(response) {
				$('#map').removeClass().html('');
				return true;
			},
			error: function() {
				valuevalid = '"erreur avec le serveur"';
			}
		});
	}, elgg.echo('registration:CPinvalid'));*/




	// map for local group in group profile
	if ($('.groups-profile-map').length) {
		var groupMap = $("#map"),
			zoom = groupMap.attr('data-zoom'),
			latitude = groupMap.attr('data-lat'),
			longitude = groupMap.attr('data-long'),
			cloudmadeUrl = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png',
			cloudmade = new L.TileLayer(cloudmadeUrl, {
				maxZoom: 18,
				attribution: ''
			});
		map = new L.Map('map');
		map.setView(new L.LatLng(latitude, longitude), zoom).addLayer(cloudmade); //map.setView([51.505, -0.09], 12);
	}

	// map for local group in groups search
	if ($('#search-localgroup').length) {
		$('#map').height($(window).height() - $('#map').position().top - 68);
		var groupMap = $("#map"),
			zoom = 6,
			latitude = 46.763056,
			longitude = 2.424722,
			cloudmadeUrl = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png',
			cloudmade = new L.TileLayer(cloudmadeUrl, {
				maxZoom: 12,
				attribution: ''
			});
		map = new L.Map('map');
		map.setView(new L.LatLng(latitude, longitude), zoom).addLayer(cloudmade);

		// live search
		var timeout,
			villes,
			hasMarkers = false;
		$("#search-localgroup").keypress(function(e) {
			if ( e.which == 13) return false;
			var search_input = $(this).val();

			if (search_input.length > 2) { // @todo when is numeric, trigger only with 5 chars
				if (timeout) {
					clearTimeout(timeout);
					timeout = null;
				}

				timeout = setTimeout(function() {
					search_input = $("#search-localgroup").val();
					if (search_input.length > 2) { // @todo check why need to do it again ?
						elgg.post('ajax/view/ggouv_template/ajax/get_city', {
							dataType: 'json',
							data: {
								city: search_input,
							},
							beforeSend:  function() {
								$('#searching').removeClass().html('').addClass('loading');
							},
							success: function(response) {
								$('#searching').removeClass().html('');
								if (response) {
									clearTimeout(timeout);
									if (hasMarkers) map.removeLayer(villes);
									var maxHab = 0,
										maxNorth = -90,
										maxSouth = 90,
										maxEast = -180,
										maxOuest = 180,
										maxHabKey = 0,
										markers = [];
									$.each(response, function(key, value) {
										var popupContent = $('<div>').append(
											$('<h2>').html(value.article+' '+value.ville).after(
												$('<a>', {href: elgg.get_site_url()+'groups/profile/'+value.cp+'/'+value.ville, style: 'font-size: 1.5em;'}).html(value.cp).after(
													$('<h3>').html(elgg.echo('groups:localgroup:departement')+' :').after(
														$('<a>', {href: elgg.get_site_url()+'groups/profile/'+value.dep+'/'+value.nom_dep, style: 'font-size: 1.2em;'}).html(value.dep)
											))).clone()).remove().html();
										markers.push(L.marker([value.lat, value.long]).bindPopup(
										//'<h2>'+value.article+' '+value.ville+'</h2><a href="'+elgg.get_site_url()+'groups/profile/'+value.cp+'/'+value.ville+'">'+ value.cp + '</a>'));

										popupContent));
										if (parseFloat(value.lat) > maxNorth) maxNorth = parseFloat(value.lat);
										if (parseFloat(value.lat) < maxSouth) maxSouth = parseFloat(value.lat);
										if (parseFloat(value.long) > maxEast) maxEast = parseFloat(value.long);
										if (parseFloat(value.long) < maxOuest) maxOuest = parseFloat(value.long);
										if (parseFloat(value.habitants30122008) > maxHab) {
											maxHabKey = key;
											maxHab = parseFloat(value.habitants30122008);
										}
									});
									villes = L.layerGroup(markers);
									//map.addLayer(villes).setView([response[maxHabKey].lat, response[maxHabKey].long], 12);
									map.addLayer(villes).fitBounds([[maxSouth, maxOuest], [maxNorth, maxEast]]).setZoom(12);
									markers[maxHabKey].openPopup();
									hasMarkers = true;
								} else {
									$('#searching').addClass('notfound').html(elgg.echo('ggouv:search:localgroups:notfound'));
								}
							},
							error: function() {
								$('#searching').removeClass().html('');
							}
						});
					}
				}, 500);
			}
		});
	}

	$(window).bind("resize", function() {
		if (!$('.elgg-page-admin').length) resizeSidebar();
		if ($('.group_activity_module').length) {
			resizeGroupActivity();
		}
		if ($('#search-localgroup').length) {
			$('#map').height(($(window).height() - $('#map').position().top) - 68);
		}
		var texta = $('.input-markdown');
		if (texta) {
			texta.each(function() {
				var textarea = $(this),
					fieldset = textarea.parents('fieldset'),
					previewPane = fieldset.find('.preview-markdown'),
					outputPane = fieldset.find('.output-markdown'),
					syntaxPane = fieldset.find('.help-markdown');
					elgg.markdown_wiki.resizePanes(textarea, previewPane, outputPane, syntaxPane);
			});
		}
	});
}


$.fn.searchlocalgroup = function(mapLoaded, nbrChar) {
	var nbrChar = nbrChar || 2;
	TheInput = this;
	var groupMap = $("#map"),
		zoom = 6,
		latitude = 46.763056,
		longitude = 2.424722,
		cloudmadeUrl = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png',
		cloudmade = new L.TileLayer(cloudmadeUrl, {
			maxZoom: 12,
			attribution: ''
		});
	map = new L.Map('map');
	map.setView(new L.LatLng(latitude, longitude), zoom).addLayer(cloudmade);

	// live search
	var timeout,
		villes,
		hasMarkers = false;
	TheInput.keyup(function(e) {
		if ( e.which == 13) return false;
		var search_input = $(this).val();
		if (search_input.length > nbrChar-1) { // @todo when is numeric, trigger only with 5 chars
			if (timeout) {
				clearTimeout(timeout);
				timeout = null;
			}

			timeout = setTimeout(function() {
				search_input = TheInput.val();
				if (search_input.length > nbrChar-1) { // @todo check why need to do it again ?
					elgg.post('ajax/view/ggouv_template/ajax/get_city', {
						dataType: 'json',
						data: {
							city: search_input,
						},
						beforeSend:  function() {
							$('#searching').removeClass().html('').addClass('loading');
						},
						success: function(response) {
							$('#searching').removeClass().html('');
							clearTimeout(timeout);
							if (mapLoaded) mapLoaded(response);
						}
					});
				}
			}, 500);
		}
	});
}

/**
 * Counter for thewire area
 */
elgg.provide('elgg.thewire');

elgg.thewire.init = function() {
	$("#thewire-textarea").live('keydown', function() {
		elgg.thewire.textCounter(this, $("#thewire-characters-remaining span"), 140);
	});
	$("#thewire-textarea").live('keyup', function() {
		elgg.thewire.textCounter(this, $("#thewire-characters-remaining span"), 140);
	});
}

/**
 * Update the number of characters with every keystroke
 *
 * @param {Object}  textarea
 * @param {Object}  status
 * @param {integer} limit
 * @return void
 */
elgg.thewire.textCounter = function(textarea, status, limit) {
	var remaining_chars = $(textarea).val().length;
	status.html(remaining_chars);

	if (remaining_chars > limit) {
		status.css("color", "#D40D12");
		$("#thewire-submit-button").attr('disabled', 'disabled');
		$(".thewire-button").addClass('elgg-state-disabled');
	} else {
		status.css("color", "");
		$("#thewire-submit-button").removeAttr('disabled', 'disabled');
		$(".thewire-button").removeClass('elgg-state-disabled');
	}
};
elgg.register_hook_handler('init', 'system', elgg.thewire.init);


/**
 * Counter for input/text140
 */
elgg.provide('elgg.counter140');

elgg.counter140.init = function() {
	$(".elgg-input-text140").live('keydown', function() {
		elgg.counter140.textCounter($(this), $(this).parent().find("span"), 140);
	});
	$(".elgg-input-text140").live('keyup', function() {
		elgg.counter140.textCounter($(this), $(this).parent().find("span"), 140);
	});
};

/**
 * Update the number of characters left with every keystroke
 *
 * @param {Object}  input
 * @param {Object}  status
 * @param {integer} limit
 * @return void
 */
elgg.counter140.textCounter = function(textarea, status, limit) {

	var remaining_chars = limit - $.trim(textarea.val()).length,
		formParent = textarea.parents('form');
	status.html(remaining_chars);

	if (remaining_chars < 0) {
		status.css("color", "#D40D12");
		formParent.find('input[type=submit]').attr('disabled', 'disabled');
		formParent.find('input[type=submit]').addClass('elgg-state-disabled');
	} else {
		status.css("color", "");
		var otherText140 = formParent.find('.elgg-input-text140').not(textarea), rem = false;
		if (!otherText140) rem = true;
		otherText140.each(function() {
			if ($.trim($(this).val()).length < 140) rem = true;
		});
		if (rem) {
			textarea.parents('form').find('input[type=submit]').removeAttr('disabled', 'disabled');
			textarea.parents('form').find('input[type=submit]').removeClass('elgg-state-disabled');
		}
	}
};
elgg.register_hook_handler('init', 'system', elgg.counter140.init);



/**
 * Resize element for responsive layout
 *
 * @param {string}		css element
 * @param {object}		(optional) object where compression is based, default: $(this).
 * @param {integer}		(optional) turn tweak up/down compression
 * @param {array}		(optional) max and min limits, and modificateur
 * @param {string}		(optional) function to execute when finish
 */
(function( $ ){
	$.fn.fitElement = function(element, kompressor, options, based, callback ) {
		// Setup options
		var compressor = kompressor || 1,
		settings = $.extend({
			'minSize' : Number.NEGATIVE_INFINITY,
			'maxSize' : Number.POSITIVE_INFINITY,
			'modificator' : 0
		}, options);
		return this.each(function() {
			var $this = $(this);
			var container = based || $this;
			// Resizer() resizes items based on the object width divided by the compressor
			var resizer = function() {
				var newCSS = Math.max(Math.min(container.width()/(compressor), parseFloat(settings.maxSize)), parseFloat(settings.minSize)) + settings.modificator;
				$this.css(element, newCSS);
				// Execute callback if any
				if (callback) callback();
			};

			// Call once to set
			resizer();
			// Call on resize. Opera debounces their resize by default
			$(window).bind('resize', resizer);
		});
	};
})( jQuery );


/*
 * Xoxco tags
 */
elgg.provide('elgg.tags');

elgg.tags.init = function() {
	var time = (new Date).getTime(),
		i = 0,
		tidyTags = function(e){
			var tags = ($(e.target).val() + ',' + e.tags).split(',');
			var target = $(e.target);
			target.importTags('');
			for(var i = 0, z = tags.length; i<z; i++){
				var tag = $.trim(tags[i]);
				if(!target.tagExist(tag)){
					target.addTag(tag);
				}
			}
			$('#' + target[0].id + '_tag').trigger('focus');
		};
	$('.elgg-input-tags').each(function () {
		if (! this.id) {
			this.id = 't' + time + '_' + i++;
		}
	}).tagsInput({
		width: '100%',
		height: 'auto',
		placeholderColor:'#666',
		defaultText: elgg.echo('xoxco:input:default'),
		onAddTag: function (tag) {
			if (tag.indexOf(',') > 0) {
				tidyTags({target: this, tags: tag});
			}
		}
	});
	$('.tagsinput').find('input').focusin(function() {
		$('.tagsinput').addClass('focus');
	}).focusout(function() {
		$('.tagsinput').removeClass('focus');
	});
};

elgg.register_hook_handler('init', 'system', elgg.tags.init);



/* French initialisation for the jQuery UI date picker plugin. */
/* Written by Keith Wood (kbwood{at}iinet.com.au) and Stéphane Nahmani (sholby@sholby.net). */
jQuery(function($){
	$.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: '&#x3c;Préc',
		nextText: 'Suiv&#x3e;',
		currentText: 'Courant',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
		'Jul','Aoû','Sep','Oct','Nov','Déc'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
});



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

// End of js for ggouv_template plugin

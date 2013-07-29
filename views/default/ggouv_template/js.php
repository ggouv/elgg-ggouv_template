
// js for ggouv template
elgg.provide('elgg.ggouv_template');

// Loaded for the first time only
elgg.ggouv_template.init = function() {
	var stashedDeck = {};

	// we wait everything is loaded
	$(document).ready(function() {
		elgg.ggouv_template.reload();

		// hide developers-log when empty
		if ( $('.developers-log').html() == '' ) $('.developers-log').hide();

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
				var t = $(this);
				if (t.hasClass('nw')) return 'nw';
				if (t.hasClass('n')) return 'n';
				if (t.hasClass('ne')) return 'ne';
				if (t.hasClass('w')) return 'w';
				if (t.hasClass('e')) return 'e';
				if (t.hasClass('sw')) return 'sw';
				if (t.hasClass('s')) return 's';
				if (t.hasClass('se')) return 'se';
				return 'n';
			}
		});

		// ggouv logo
		$('.elgg-menu-item-logo').live('click', function() {
			$(this).children('a').click();
		});

		// goTop button
		$(window).scroll(function() {
			if ($(window).scrollTop() > 300) {
				$('#goTop').css('bottom', 0);
			} else {
				$('#goTop').css('bottom', -50);
			}
		});
		$('#goTop').live('click', function() {
			$(window).scrollTo(0, 500);
		});

		// site-info-popup from info button in vertical menu
		$('.elgg-menu-item-info').live('click', function() {
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
		$('#site-info-popup .elgg-icon-delete').live('click', function() {
			$('#site-info-popup').fadeOut(500, function() {
				$(this).remove();
			});
		});

		// 3D rotate header
		$('.rotator .arrows div').live('click', function() {
			var header = $('#elgg-page-header-container'),
				q = $(this).hasClass('up') ? -1 : 1,
				degree = header.data('rotation') + q * 120;/*
				count = Number(header.attr('class').replace('side', ''))+q;

			if (count == 4) count = 1;
			if (count == 0) count = 3;
			header.attr('class', 'side'+count);*/

			header.css({
				'-webkit-transform': 'rotateX(' + degree + 'deg)',
				'-moz-transform': 'rotateX(' + degree + 'deg)',
				'-ms-transform': 'rotateX(' + degree + 'deg)',
				'-o-transform': 'rotateX(' + degree + 'deg)',
				'transform': 'rotateX(' + degree + 'deg)'
			}).data('rotation', degree);
		});
	});


	/**
	 * Ajaxified website. Get page called by link or submit form.
	 * @param  {[type]} url
	 * @param  {[type]} data
	 * @return {[type]}
	 */
	parsePage = function(url, data) {
		var data = data || false,
			fragment = data.fragment || false
			activityTab = url.match(elgg.get_site_url() +'activity(.*)'),
			stashDeck = function() { // stash deck river before change elgg-page-body
				if ($('body').hasClass('fixed-deck')) {
					var deckOrigin = data.origin.replace(/#$/, ''),
						drl = $('#deck-river-lists');

					$('.elgg-menu-item-logo a').attr('href', deckOrigin);
					drl.attr('data-scrollBkp', drl.scrollLeft()); // store horizontal deck scroll
					$.each(drl.find('.elgg-river'), function(i, e) {
						$(e).attr('data-scrollBkp', e.scrollTop); // store all columns scroll
					});
					stashedDeck[deckOrigin.match(elgg.get_site_url() +'activity(.*)')[1]] = $('.elgg-page-body').contents();
				}
			};

		// if user go back to the deck-river and river is stashed, we show it and skip elgg.post
		if (activityTab && stashedDeck[activityTab[1]]) {
			stashDeck();
			$('.elgg-page-body').html(stashedDeck[activityTab[1]]);
			$('body').attr('class', 'fixed-deck');
			var drl = $('#deck-river-lists');
			drl.scrollLeft(drl.attr('data-scrollBkp'));
			$.each(drl.find('.elgg-river'), function(i, e) {
				$(e).scrollTop($(e).attr('data-scrollBkp'));
			});
			elgg.friendly_time.update();
			elgg.deck_river.SetColumnsHeight();
			elgg.deck_river.SetColumnsWidth();
			if (data.callback) data.callback();
			return true;
		}

		$('body').addClass('ajaxLoading');

		if (data.dataForm) {
			dataPost = data.dataForm + '&ajaxified=true';
		} else {
			dataPost = 'ajaxified=true';
		}

		elgg.post(url, {
			data: dataPost,
			success: function(response, textStatus, xmlHttp) {
				var urlParsed = elgg.parse_url(url),
					urlPath = urlParsed.path;

				try {
					var jsonResponse = $.parseJSON(response);

					eval(jsonResponse.js_code); // execute javascript from ggouv_execute_js. It's include hack to reload js/initialize_elgg forked from page/elements/reinitialize_elgg
					elgg.register_error(jsonResponse.system_messages.error);
					elgg.system_message(jsonResponse.system_messages.success);

					if (jsonResponse.forward_url) {
						/* This is an action !
						 * If it's not an action, response doesn't got a forward_url
						 * note: when server is down > Object { readyState=0, status=0, statusText="error"}
						*/
						forward_url = elgg.normalize_url(decodeURIComponent(jsonResponse.forward_url));

						if (urlPath.match('/action/groups/featured') || urlPath.match('/action/groups/leave')) {
							History.replaceState(data, null, data.origin);
						} else if (forward_url != null) {
							if (urlPath.match('/action/brainstorm/delete')) {
								var brainstorm_guid = elgg.parse_str(urlParsed.query).guid;
								$('.elgg-body #elgg-object-'+brainstorm_guid).css('background-color', '#FF7777').fadeOut();
							}
							History.replaceState(data, null, forward_url); // catch forward(). See ggouv_ajax_forward_hook
						} else if (xmlHttp.status = 200) {
							window.location.replace(url); // in case of...
						}

					} else { // So this is a page

						var respBody = $(jsonResponse.body),
							orignParsed = data.origin ? elgg.parse_url(data.origin) : false,
							urlOffset = !elgg.isUndefined(urlParsed.query) ? urlParsed.query.match(/offset=(\d+)/) : false;

						$('title').html(jsonResponse.title);

						if (urlOffset && orignParsed.path == urlPath) { // same url. Only query offset change, we just slide page body.
							var numOrigin = elgg.isUndefined(orignParsed.query) ? 0 : parseInt(orignParsed.query.match(/offset=(\d+)/)[1]),
								numDest = parseInt(urlOffset[1]);

							$('.elgg-page-body .elgg-main .elgg-pagination').html(respBody.find('.elgg-main .elgg-pagination').html());
							if (numOrigin < numDest) {
								var u = $('.elgg-page-body .elgg-main .elgg-list'),
									slideWidth = u.outerWidth(true),
									v = respBody.find('.elgg-main .elgg-list').clone().css({
										position: 'absolute',
										top: u.position().top,
										left: slideWidth
									});
								u.after(v).add(v).animate({left: '-='+slideWidth+'px'}, function() {
									u.remove();
									v.removeAttr('style');
								});
							} else {
								var u = $('.elgg-page-body .elgg-main .elgg-list'),
									slideWidth = u.outerWidth(true),
									v = respBody.find('.elgg-main .elgg-list').clone().css({
										position: 'absolute',
										top: u.position().top,
										right: slideWidth
									});
								u.after(v).add(v).animate({right: '-='+slideWidth+'px'}, function() {
									u.remove();
									v.removeAttr('style');
								});
							}

						} else {

							stashDeck();
							$('.elgg-page-body').html(respBody);

						}

						if (!data.noscroll) $(window).scrollTop(0);

						elgg.ggouv_template.reloadJsFunctions();
					}

					if (fragment && $('#'+fragment).length) {
						$(window).scrollTo($('#'+fragment), 'slow', {offset:-60});
					}
					$('body').removeClass('ajaxLoading');

					if (data.callback) data.callback();

				} catch (err) { // So this is a page
					console.log(err);
				}
			},
			error: function(response) {
				console.log(response, 'error');
				$('body').removeClass('ajaxLoading');
			}
			/*error: function(jqXHR, textStatus, errorThrown){
				document.location.href = url;
				return false;
			}*/
		});
	}

	var History = window.History;
	if (History.enabled) {
		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack) {
			var $this = $(obj),
				url = $this.attr('href') || '';
			// Check link
			return url.indexOf(elgg.get_site_url()) === 0 || url.indexOf(':') === -1 || site_shorturl && url.indexOf(site_shorturl) === 0;
		};

		// prevent scroll with link finished by #
		$(".elgg-page-body a:internal[href$='#']").live('click', function(e){
			e.preventDefault();
			return false;
		});

		// ajaxify links
		$("a:internal:not("+
								"[href^='#'],"+
								"[href$='#'],"+
								"[rel=toggle],"+
								"[rel=popup],"+
								"[href*='/admin/'],"+
								"[href*='/ajax/'],"+
								"[href*='/logout'],"+
								"[href*='view=rss'],"+
								"[href*='address='],"+
								"[href*='/avatar/edit'],"+
								"[href*='/action/widgets/delete'],"+
								"[href*='/action/workflow/list/delete'],"+
								"[href*='notifications/personal'],"+
								"[href*='"+elgg.get_site_url()+"split'],"+
								"[class*='"+elgg.get_site_url()+"tour'],"+
								"[class='ui-corner-all'])" // autocomplete popup
		).live('click', function(e) {
			var href = $(this).attr('href');
			if (elgg.isUndefined(href) || href == '') return false; // skip if href is empty
			if (e.which == 2 || e.metaKey) return true; // Continue as normal for cmd clicks

			var $this = $(this),
				url = elgg.normalize_url(decodeURIComponent(href)),
				urlParsed = elgg.parse_url(url),
				ExecAction = function(url, callback) {
					elgg.action(url, {
						success: function(json) {
							callback();
						}
					});
				};

			// first, verify if there is confirmation. Continue on true.
			if (!$this.hasClass('elgg-requires-confirmation') || $this.hasClass('elgg-requires-confirmation') && elgg.ui.requiresConfirmation(e, $this)) {

				// if it's an actions, do action and skip history.
				if (url.match('/action/comments/delete')) {
					ExecAction(url, function() {
						$('#item-annotation-'+elgg.parse_str(urlParsed.query).annotation_id).css('background-color', '#FF7777').fadeOut();
						if ($('#card-forms').length) elgg.workflow.addCommentonCard($this.closest('#card-forms').find('input[name="entity_guid"]').val(), -1);
					});
				} else if (url.match('/action/friends/add')) {
					ExecAction(url, function() {
						var query = elgg.parse_url(url, 'query'),
							friend = query.match(/friend=\d+/)[0],
							stats = $('.user-stats li:first-child .stats');

						$('a.tooltip.add_friend[href*="'+friend+'"]').html('&#44033;'); // unicode AC01
						$('a.elgg-button.add_friend[href*="'+friend+'"]').html(elgg.echo('friend:remove'));
						$('a.add_friend[href*="'+friend+'"]')
							.blur()
							.removeClass('add_friend')
							.addClass('remove_friend')
							.attr({
								href: elgg.get_site_url() + 'action/friends/remove?' + query,
								title: elgg.echo('friend:remove')
							});
						stats.html(parseInt(stats.html())+1);
					});
				} else if (url.match('/action/friends/remove')) {
					ExecAction(url, function() {
						var query = elgg.parse_url(url, 'query'),
							friend = query.match(/friend=\d+/)[0],
							stats = $('.user-stats li:first-child .stats');

						$('a.tooltip.remove_friend[href*="'+friend+'"]').html('&#44032;'); // unicode AC00
						$('a.elgg-button.remove_friend[href*="'+friend+'"]').html(elgg.echo('friend:add'));
						$('a.remove_friend[href*="'+friend+'"]')
							.blur()
							.removeClass('remove_friend')
							.addClass('add_friend')
							.attr({
								href: elgg.get_site_url() + 'action/friends/add?' + query,
								title: elgg.echo('friend:add')
							});
						stats.html(parseInt(stats.html())-1);
					});
				} else if (url.match('/action/river/delete')) {
					ExecAction(url, function() {
						$('.item-river-'+elgg.parse_str(urlParsed.query).id).css('background-color', '#FF7777').fadeOut();
					});
				} else if (url.match('/action/message/delete')) {
					ExecAction(url, function() {
						$('.elgg-list-item[data-object_guid="'+elgg.parse_str(urlParsed.query).guid+'"]').css('background-color', '#FF7777').fadeOut();
					});
				} else if (url.match('/action/workflow/delete')) {
					ExecAction(url, function() {
						var board_guid = elgg.parse_str(urlParsed.query).guid;
						$('#elgg-object-'+board_guid).css('background-color', '#FF7777').fadeOut();
						$('.workflow-sidebar .elgg-list-item.board-'+board_guid).css('background-color', '#FF7777').fadeOut();
					});
				} else if (url.match('/action/deck_river/network/delete')) {
					ExecAction(url, function() {
						var network_guid = elgg.parse_str(urlParsed.query).guid;
						$('#elgg-object-'+network_guid).css('background-color', '#FF7777').fadeOut();
						$('#thewire-network .net-profile input[value="'+network_guid+'"]').closest('.net-profile').remove();
					});

				// it's a link
				} else {
					var fragment = urlParsed.fragment || false,
						path_url = urlParsed.path,
						url_origin = elgg.normalize_url(decodeURIComponent(window.location.href)),
						path_origin = elgg.parse_url(url_origin, 'path');

					// History.js doesn't accept url on another domain, so we have to replace shorturl by handler for shorten url
					if (url.indexOf(site_shorturl) === 0) url = elgg.get_site_url() + 'u/' + url.replace(site_shorturl, '');

					if (fragment && path_origin == path_url) { //same page, go to #hash
						if ($('#'+fragment).length) $(window).scrollTo($('#'+fragment), 'slow', {offset:-60});
					} else if (path_origin == path_url && /members\/random/.test(path_url)) {
						parsePage(elgg.get_site_url()+'members/random');
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
						//"[id='button-signup'],"+
						"[id='workflow-edit-card-submit'],"+
						"[class*='workflow-card-submit'],"+
						"[id='workflow-list-submit'],"+
						"[class*='noajaxified'])"
		).die().live('click', function(e) {
			var form = $(this).closest('form'),
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
							comBlock = form.closest('.elgg-comments'),
							ul = comBlock.find('ul.elgg-list-annotation'),
							li = $(json.output).find('li:first'),
							txt = li.find('.elgg-output').html(),
							liID = li.attr('id');

						if (orderBy ==  'asc') {
							if (ul.length < 1) {
								comBlock.prepend(json.output);
								if (!form.hasClass('tiny')) comBlock.prepend($('<h3>', {id: 'comments', 'class': 'gwfb pbs'}).html(elgg.echo('comments')));
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
						CloneHelpMarkdown($('#'+liID).find('.help-markdown'));
						form.find('textarea').val('').height(190);
						form.find('.preview-markdown').html('').height(178);
						elgg.markdown_wiki.edit.init();
					}
				});

			} else if (form.hasClass('elgg-form-answers-answer-edit')) { // Special for edit answer
				elgg.action('answers/answer/edit', {
					data: dataForm,
					success: function(response) {
						if (response.status == 0) {
							var answer_guid = form.find('input[name=answer_guid]').val(),
								answer_text = form.find('textarea[name=answer_text]').val();
							replaceHighlight($('#elgg-object-'+answer_guid+' .answer-output'), answer_text);
							$('#elgg-object-'+answer_guid+' .elgg-menu-item-edit a').click();
						}
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
			if (State) parsePage(State.url, State.data);
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


elgg.ggouv_template.reloadJsFunctions = function() {
	$('.tipsy').remove(); // in case of because sometimes tooltip stick

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
	//elgg.bookmarks.init();
	elgg.tags.init();
	elgg.workflow.reload();
	elgg.answers.init();
	//elgg.ggouv_pad.resize();
	elgg.ggouv_template.reload();

	// compatibility for refresh button in board view
	$('.elgg-menu-item-refresh-board .elgg-button').die().live('click', function(e) {
		var url = elgg.normalize_url(decodeURIComponent($(this).attr('href')));
		$('body').addClass('ajaxLoading');
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


elgg.ggouv_template.reload = function() {

	if ($('#section1').length) { // this is homepage @todo find another way to check if it's homepage. Because someone can write a blog or wiki page with title section1 for example
		$('body').addClass('homepage');
		$("#slideshow").removeClass('hidden').responsiveSlides({ // hidden class to prevent ugly effect
			nav: true,
			timeout: 20000, // 20 seconds
			pause: true,
			prevText: '<span class="t">&larr;</span>',
			nextText: '<span class="t">&rarr;</span>'
		});
	} else {
		$('body').removeClass('homepage');
	}

	/*
	 * Resize, scroll and sidebar
	 */

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
		$('#goTop').removeClass('hidden');
	}

	// Group activity
	var resizeGroupActivity = function() {
		$('#group_activity_module .elgg-river').height($(window).height() - 48 - 51);
	}

	if (!$('.elgg-page-admin').length) {
		resizeSidebar();
		var TheColumn = $('#group_activity_module');

		if (TheColumn.is(':visible')) {
			resizeGroupActivity();
			elgg.deck_river.LoadRiver(TheColumn, elgg.get_page_owner_guid());
		}
		$('.elgg-sidebar, .elgg-sidebar-2').fitElement('width', 5, { minSize: '252.8px', maxSize: '360px' }, $(window), function() {
			$('.elgg-sidebar-2, .elgg-layout-one-sidebar, .elgg-sidebar-2 #group_activity_module').css('margin-right', $('.elgg-sidebar').width() + 30);
		});
	}

	// Resize if groups-profile-fields is taller than 200px
	if ($('.groups-profile-fields').length) {
		var gpf = $('.groups-profile-fields');

		if (gpf.height() > 200) {
			gpf.height($('.groups-profile .elgg-image').height())
				.append($('<div>', {id: 'toggle-group-description'}).html(elgg.echo('groups:description:show_more')).click(function() {
					var t = $(this);
					if (t.hasClass('less')) {
						t.html(elgg.echo('groups:description:show_more')).removeClass('less').appendTo(gpf);
						gpf.animate({height: $('.groups-profile .elgg-image').height() + 'px'});
					} else {
						t.html(elgg.echo('groups:description:show_less')).addClass('less').appendTo(gpf.find('.description'));
						gpf.animate({height: '100%'});
					}
				}));
		}
	}

	/**
	 * validate forms using jQuery validate
	*/

	// add method for name
	$.validator.addMethod("namecheckcar", function(value, element) {
		return this.optional(element) || /^[a-zA-Z][a-zA-Z0-9_]{3,30}$/.test(value);
	}, elgg.echo('registration:namecheckcar'));

	// shake submit button
	var shakeButton = function() {
		$('.elgg-form .elgg-button-submit').animate({'margin-left': 10}, 100, function() {
			$(this).effect("shake", {times:2, distance:10}, 100, function() {
				$(this).animate({'margin-left': 0}, 100);
			});
		});
	};

	$('.elgg-form-groups-edit, .elgg-form-profile-edit, .elgg-form-user-requestnewpassword').validate({
		invalidHandler: shakeButton
	});

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
				minlength: elgg.echo('registration:usernametooshort', [4]),
				maxlength: elgg.echo('registration:usernametoolong', [30]),
				remote: elgg.echo('registration:userexists')
			},
			location: {
				minlength: elgg.echo('registration:locationtooshort', [5])
			}
		},
		invalidHandler: shakeButton
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
			zoom = groupMap.data('zoom'),
			latitude = groupMap.data('lat'),
			longitude = groupMap.data('long'),
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
								city: search_input
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
		if ($('#group_activity_module').length) {
			resizeGroupActivity();
		}
		if ($('#search-localgroup').length) {
			$('#map').height(($(window).height() - $('#map').position().top) - 68);
		}
		var texta = $('.input-markdown');
		if (texta) {
			texta.each(function() {
				var textarea = $(this),
					fieldset = textarea.closest('fieldset'),
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
							city: search_input
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
		formParent = textarea.closest('form');
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
			textarea.closest('form').find('input[type=submit]').removeAttr('disabled', 'disabled');
			textarea.closest('form').find('input[type=submit]').removeClass('elgg-state-disabled');
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


//override confirm
/*(function() {
  var proxied = window.confirm;
  window.confirm = function() {
    // do something here
    return proxied.apply(this, arguments);
  };
})();*/

/**
 * Override javascript confirm() and wrap it into a jQuery-UI Dialog box
 *
 * @depends $.getOrCreateDialog
 *
 * @param { String } the alert message
 * @param { String/Object } the confirm callback
 * @param { Object } jQuery Dialog box options
 */
/*function confirm(message, callback, options) {
	var defaults = {
		modal : true,
		resizable : false,
		buttons : {
			Ok: function() {
				$(this).dialog('close');
				return (typeof callback == 'string') ?
					window.location.href = callback :
					callback();
			},Cancel: function() {
				$(this).dialog('close');
				return false;
			}
		},
		show : 'fade',
		hide : 'fade',
		minHeight : 50,
		dialogClass : 'modal-shadow'
	}

	$confirm = $.getOrCreateDialog('confirm');
	// set message
	$("p", $confirm).html(message);
	// init dialog
	$confirm.dialog($.extend({}, defaults, options));
}


ggouv_confirm2 = function(msg) {

	var proxied = window.confirm;
	window.confirm = function() {
		var $this = this;
		console.log(arguments);
		ggouv_super_popup(arguments[0], 'tiny', function() {
			console.log($this);
			return proxied.apply($this, arguments);
		});
	};
	return confirm(msg);
};

/*
window.confirm = function (msg) {
	//ggouv_confirm(msg, 'tiny');
	$dialog_alert.html(msg).dialog('open');
};*
$dialog_confirm = $('<div></div>').dialog({
            resizable: false,
            height: 100,
            modal: true,
            autoOpen: false,
            buttons: {
                "Ok - Configurable": function () {
                    $(this).dialog("close");
                    return window.alert.apply(this);
                },
                "Cancel - Configurable": function () {
                    $(this).dialog("close");
                    return false;
                }
            }
        });

ggouv_confirm = function (msg, size) {
	//ggouv_super_popup(msg, 'tiny');
	$( "#super-popup").html(msg).dialog({
            resizable: false,
            height:140,
            modal: true,
            //autoOpen: false,
            buttons: {
                "Yes": function()
                {
                    $(this).dialog( "close" );
                    return true;
                },
                "No": function()
                {
                    $( this ).dialog( "close" );
                    return false;
                }
            }
        });
};*/

elgg.provide('ggouv');
elgg.provide('ggouv.super_popup');

/**
 * Display modal popup with overlay
 * @param  array options {
 *                            title: null,
 *                            body: null,
 *                            cancel: false,
 *                       }
 */
ggouv.super_popup.create = function(options) {
	var superPopupTemplate = Mustache.compile($('#super-popup-template').html()),
		superPopup = $('#super-popup'),
		options = $.extend({
					size: null,
					title: null,
					close: true,
					body: null,
					createdCallback: $.noop,
					activeCallback: $.noop,
					destroyCallback: $.noop,
					ok: 'OK',
					okCallback: function(){ggouv.super_popup.deactivate()},
					cancel: false,
					cancelCallback: function(){ggouv.super_popup.deactivate()},
				}, options),
		execFunction = function(func) {
			if (typeof(func) === 'string') {
				console.log(func);
				eval(func);
			} else {
				func();
			}
		};

	if (options.cancel === true) options.cancel = elgg.echo('cancel');

	$('.elgg-page').prepend(superPopupTemplate(options));
	execFunction(options.createdCallback);

	$('#super-popup').find('.elgg-icon-delete-alt, .elgg-button-cancel').click(function() {
		execFunction(options.cancelCallback);
	});
	$('#super-popup').find('.elgg-button-submit').click(function() {
		execFunction(options.okCallback);
	});
	$(window).keyup(function(e) {
		if ( e.keyCode === 27 && options.close) execFunction(options.cancelCallback); // esc key
	});

	$('html').addClass('super-popup-active');
	execFunction(options.activeCallback);
};


/**
 * Delete modal popup with overlay
 */
ggouv.super_popup.deactivate = function() {
	$('html').removeClass('super-popup-active');
	$('#super-popup').remove();
	setTimeout(function() {elgg.deck_river.SetColumnsHeight();},500);
};


/*
(function($){

	window.confirm = function(params){

		if($('#confirmOverlay').length){
			// A confirm is already shown on the page:
			return false;
		}

		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){

			// Generating the markup for the buttons:

			buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'<span></span></a>';

			if(!obj.action){
				obj.action = function(){};
			}
		});

		var markup = [
			'<div id="confirmOverlay">',
			'<div id="confirmBox">',
			'<h1>',params.title,'</h1>',
			'<p>',params.message,'</p>',
			'<div id="confirmButtons">',
			buttonHTML,
			'</div></div></div>'
		].join('');

		$(markup).hide().appendTo('body').fadeIn();

		var buttons = $('#confirmBox .button'),
			i = 0;

		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){

				// Calling the action attribute when a
				// click occurs, and hiding the confirm.

				obj.action();
				$.confirm.hide();
				return false;
			});
		});
	}

	window.confirm.hide = function(){
		$('#confirmOverlay').fadeOut(function(){
			$(this).remove();
		});
	}

})(jQuery);*/



// tour
$('.start-tour').live('click', function() {
	var origin = elgg.normalize_url(decodeURIComponent(window.location.href)),
		EndTour = function() {
			$("#GgouvTour").joyride('destroy');
			$(document).off('click.joyride', '.joyride-next-tip, .joyride-modal-bg');
			$('.elgg-page-topbar .hover').click().add('#TourMenu').removeClass('hover'); // click close wire form
		},
		startTour = function(tipID) {
			$('#endTour').die().live('click', function() {
				EndTour();
				$('#TourMenu').fadeOut();
			});
			$('#endTourAndReturn').die().live('click', function() {
				History.pushState({origin: null}, null, origin.split("#")[0]);
				EndTour();
				$('#TourMenu').fadeOut();
			});

			if (tipID != 0) $('#TourMenu').removeClass('hover');
			$('#TourMenu').fadeIn();
			$("#GgouvTour").joyride({
				autoStart : true,
				startOffset: tipID,
				prevButton: true,
				template: { // HTML segments for tip layout
					'link'    : '<a href="#close" class="joyride-close-tip gwf">x</a>',
					'timer'   : '<div class="joyride-timer-indicator-wrap"><span class="joyride-timer-indicator"></span></div>',
					'button'  : '<a href="#" class="joyride-next-tip"></a>',
				},
				preStepCallback : function (index, tip) { // called before tip displayed
					eval(tip.find('.preStep').text());
				},
				inStepCallback: function (index, tip) { // called after tip displayed
					eval(tip.find('.inStep').text());
				},
				postStepCallback : function (index, tip) { // called after tip removed, and before next tip
					$('#TourMenu').removeClass('hover');
					eval(tip.find('.postStep').text());
				},
				postRideCallback: function() { // called when tour finished or stopped
					EndTour();
					$('#TourMenu').fadeOut();
				}
			});

		};

	// check if joyride js is already loaded
	if (typeof $.fn.joyride != 'function') {
		$('#TourMenu, #GgouvTour').remove();
		elgg.post('ajax/view/ggouv_template/ajax/tour/', {
			success: function(response) {
				$('body').append(response);
				$('#TourMenu li').live('click', function() {
					EndTour();
					startTour($(this).data('tip'));
				});
				$.getScript(elgg.get_site_url()+'mod/elgg-ggouv_template/vendors/joyride/jquery.joyride-2.1.js', function() {
					startTour(0);
				});

			}
		});
	} else {
		$('#TourMenu').addClass('hover');
		startTour(0);
	}

	return false; // we want to show url for start tour, but not going to this url
});




/* French initialisation for the jQuery UI date picker plugin. */
/* Written by Keith Wood (kbwood{at}iinet.com.au) and Stéphane Nahmani (sholby@sholby.net). */
jQuery(function($){
	$.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: '&#x3c;Préc',
		nextText: 'Suiv&#x3e;',
		currentText: 'Courant',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
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

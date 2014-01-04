/*
 * Sample to understand how js is loaded.
 * You can uncomment to log time and perform benchmark.
 */
/*

benchmarkTimeInit = new Date().getTime();
benchmarkTimeHistory = 0;
console.log(benchmarkTimeInit, 'init'); // Executed when the js loads and the user arrives for the first time on ggouv. elgg core could be not loaded.

elgg.provide('elgg.ggouv_benchmark');
elgg.ggouv_benchmark.init = function() {
	console.log(new Date().getTime()-benchmarkTimeInit, 'provide'); // Executed after elgg core js is loaded, only on the first time on ggouv
	$(document).ready(function() {
		console.log(new Date().getTime()-benchmarkTimeInit, 'ready'); // Executed when DOM is ready, only on the first time on ggouv
	});
	$(window).load(function(){ //Executed after everythings (css,js,images) are loaded, only on the first time on ggouv
		console.log(new Date().getTime()-benchmarkTimeInit, 'load');
	});

};
elgg.register_hook_handler('init', 'system', elgg.ggouv_benchmark.init);

elgg.ggouv_benchmark.click = function() { // Executed when user click on a link
	benchmarkTimeHistory = new Date().getTime();
	console.log(benchmarkTimeHistory, 'click');
};
elgg.register_hook_handler('ggouv_history', 'click', elgg.ggouv_benchmark.click);

elgg.ggouv_benchmark.statechange = function() { // Executed when url change
	console.log(new Date().getTime()-benchmarkTimeHistory, 'statechange');
};
elgg.register_hook_handler('ggouv_history', 'statechange', elgg.ggouv_benchmark.statechange);

elgg.ggouv_benchmark.success = function() { // Executed when page are loaded after a click or url change
	console.log(new Date().getTime()-benchmarkTimeHistory, 'success');
};
elgg.register_hook_handler('ggouv_history', 'success', elgg.ggouv_benchmark.success);

elgg.ggouv_benchmark.done = function() { // Executed when page are loaded and all stuff are done (reload template and js...)
	console.log(new Date().getTime()-benchmarkTimeHistory, 'done');
};
elgg.register_hook_handler('ggouv_history', 'done', elgg.ggouv_benchmark.done);

*/



/**
 * Function to initiate full ajax.
 * @return {[type]} [description]
 */
elgg.ggouv_template.history = function() {
	var History = window.History;

	if (History.enabled) {
		// Internal Helper
		$.expr[':'].internal = function(obj) {
			var url = $(obj).attr('href') || '';
			// Check link
			return url.indexOf(elgg.get_site_url()) === 0 || url.indexOf(':') === -1 || site_shorturl && url.indexOf(site_shorturl) === 0;
		};

		// prevent scroll with link finished by #
		$("a:internal[href$='#']").live('click', function(e){
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
								"[href*='notifications/personal'],"+
								"[href^='"+elgg.get_site_url()+"split'],"+
								"[href^='"+elgg.get_site_url()+"tour'],"+
								"[class*='noajaxified'],"+
								"[class='ui-corner-all'])" // autocomplete popup
		).live('click', function(e) {

			elgg.trigger_hook('ggouv_history', 'click');

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
					} else if (path_origin == path_url && (
								/workflow\/board/.test(path_url) ||
								/members\/random/.test(path_url)
							)) {
						elgg.ggouv_template.loadPage(url);
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
						"[id='workflow-edit-card-submit'],"+
						"[class*='workflow-card-submit'],"+
						"[id='workflow-list-submit'],"+
						"[class*='noajaxified'])"
		).die().live('click', function(e) {

			elgg.trigger_hook('ggouv_history', 'submit');

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

			if (!elgg.isUndefined(form.data('validator'))) { // check if form has jquery.validate handler and if it's a valid form
				if (!form.valid()){
					elgg.register_error(elgg.echo('forms:not_valid'));
					return false;
				}
			}

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
			if (State && elgg.trigger_hook('ggouv_history', 'statechange')) {
				elgg.ggouv_template.loadPage(State.url, State.data);
			}
		});

	}
};
elgg.register_hook_handler('init', 'system', elgg.ggouv_template.history);



/**
* Ajaxified website. Get page called by link or submit form.
* @param  {[type]} url
* @param  {[type]} data
* @return {[type]}
*/
elgg.ggouv_template.loadPage = function(url, data) {
	var data = data || false,
		fragment = data.fragment || false,
		urlActivity = elgg.get_site_url() +'activity(.*)',
		activityTab = url.match(urlActivity),
		urlToStashID = function(match) {
			if (!match) return false;
			return match[1].replace(/^\//, '').replace(/\s/, '');
		},
		stashDeck = function() { // stash deck river before change elgg-page-body
			if ($('body').hasClass('fixed-deck')) {
				var deckOrigin = data.origin.replace(/#$/, '');

				$('.elgg-menu-item-logo a').attr('href', deckOrigin);
				$('.elgg-river-layout:not(.hidden)').addClass('hidden').attr('id', 'stash_'+urlToStashID(deckOrigin.match(urlActivity)));
			}
		};

	// if user go back to the deck-river and river is stashed, we show it and skip elgg.post
	if (activityTab && $('#stash_'+urlToStashID(activityTab)).length) {
		var $stash = $('#stash_'+urlToStashID(activityTab));

		stashDeck();
		$('.elgg-layout:not(.hidden)').remove();
		$stash.removeClass('hidden');
		$('body').attr('class', 't25 fixed-deck'); // we replace class remove all other class
		$('.deck-popup').not('.pinned').remove(); // remove non-pinned popup
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

			elgg.trigger_hook('ggouv_history', 'success');

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
						var $epb = $('.elgg-page-body > .elgg-inner');
						stashDeck();
						$epb.children().not('.elgg-layout.hidden').remove();
						$epb.append(respBody);
						$('.deck-popup').not('.pinned').remove(); // remove non-pinned popup

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
};



/**
 * Unregister a hook handler
 * @param {String}   name     Name of the plugin hook
 * @param {String}   type     Type of the event
 * @param {Function} handler  Handle to remove
 * @return {bool}
 */
elgg.unregister_hook_handler = function(name, type, handler) {
	var priorities =  elgg.config.hooks;

	if (!(priorities[name][type] instanceof elgg.ElggPriorityList)) {
		priorities[name][type] = new elgg.ElggPriorityList();
	}

	return priorities[name][type].remove(handler);
};



/**
 * Change url in browser without load the page. Only url is changed.
 * To do that, we need to register a hook on ggouv_history statechane to return false, and remove it just after.
 *
 * @param {Obj}      data     data of History State
 * @param {String}   url      Url to put in browser url (optional). If no url is provided, data.origin is the url.
 */
elgg.ggouv_template.changeUrl = function(data, url) {
	var url = url || data.origin;
	elgg.register_hook_handler('ggouv_history', 'statechange', elgg.ggouv_template.interceptHistory);
	History.replaceState(data, null, url);
};
// the hook that return false and remove himself
elgg.ggouv_template.interceptHistory = function() {
	elgg.unregister_hook_handler('ggouv_history', 'statechange', elgg.ggouv_template.interceptHistory);
	return false;
};



/**
 * Reload js of plugins
 * @return {[type]} [description]
 */
elgg.ggouv_template.reloadJsFunctions = function() {
	$('.tipsy').remove(); // in case of because sometimes tooltip stick

	// Send to Piwik tracker
	if (typeof piwikTracker != 'undefined' && typeof piwikTracker.trackPageView == 'function') {
		piwikTracker.setDocumentTitle(document.title);
		piwikTracker.setCustomUrl(window.location.href);
		piwikTracker.trackPageView();
	}

	// Reload elgg core js
	elgg.trigger_hook('ready', 'system');
	elgg.ui.widgets.init();
	elgg.userpicker.init();
	elgg.autocomplete.init();

	// Reload plugins
	elgg.deck_river.reload();
	elgg.markdown_wiki.reload();
	elgg.brainstorm.init();
	//elgg.bookmarks.reload();
	elgg.tags.init();
	elgg.workflow.reload();
	elgg.answers.init();
	elgg.ggouv_pad.reload();
	elgg.ggouv_template.reload();

	// Reload autocomplete elgg.userpicker.userList @todo remove it for next version. Elgg 1.8.9 don't fix it
	elgg.userpicker.userList = {};
	$('.elgg-user-picker-list li input').each(function(i, elem) {
		$(elgg.userpicker.userList).prop($(elem).val(), true);
	});

	elgg.trigger_hook('ggouv_history', 'done');
}



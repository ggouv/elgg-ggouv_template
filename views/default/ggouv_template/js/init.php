
// js for ggouv template


/*
 * Elgg-ggouv_template initialisation
 *
 */
elgg.provide('elgg.ggouv_template');



// Loaded for the first time only
elgg.ggouv_template.init = function() {

	// we wait everything is loaded
	$(document).ready(function() {
		elgg.ggouv_template.reload();

		// ggouv logo
		$('.elgg-menu-item-logo').click(function() {
			History.pushState({origin: elgg.normalize_url(decodeURIComponent(window.location.href))}, null, $(this).children('a').attr('href').split("#")[0]);
			return false;
		});

		// site-info-popup from info button in vertical menu
		$('.elgg-menu-item-info').click(function() {
			if (!$('#site-info-popup').length) {
				$('.elgg-page-body').after($('<div>', {id: 'site-info-popup', 'class': 'row-fluid hidden'}));
			}
			elgg.get('ajax/view/ggouv_template/ajax/site_info_popup', {
				success: function(response) {
					$('#site-info-popup').html(response).toggle('slide', {direction:'down'});
					$('#site-info-popup .elgg-icon-delete').click(function() {
						$('#site-info-popup').fadeOut(500, function() {
							$(this).remove();
						});
					});
				},
				error: function() {
					$('#site-info-popup').remove();
				}

			});
		});

		// 3D rotate header
		$('.rotator .arrows div').click(function() {
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

		// sidebar
		var lastScrollTop = 0; // global var to reset it when page change by ajax
		$(window).bind('scroll.sidebar', function() {
			var st = this.scrollY,
				sb = $('.elgg-sidebar'),
				sbd = sb.data('bpx'),
				i;

			if (parseFloat(sb.css('bottom')) <= 0 && !elgg.isUndefined(sbd)) {
				i = parseFloat(sb.css('bottom')) - parseFloat((lastScrollTop-st)/2);
				if (i > 0) i = 0;
				if (i < sbd) i = sbd;
				sb.css({'bottom': i +'px'});
			}
			lastScrollTop = st;
		});

		// goTop button
		var gT = $('#goTop');
		$(window).bind('scroll.goTop', function() {
			(this.scrollY > 300) ? gT.css('bottom', 0) : gT.css('bottom', -50);
		});
		gT.click(function() {
			$(window).scrollTo(0, 500);
		});

		// tour
		$('.start-tour').click(function() {
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

	});



	$(window).bind('resize.ggouvTemplate', function() {
		if (!$('.elgg-page-admin').length) elgg.ggouv_template.resizeSidebar();

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



	// Inintialize tooltips
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



	//Custom jquery validation message. Need to be called after plugin jquery validation loaded
	$.extend($.validator.messages, {
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
		maxlength: $.validator.format(elgg.echo('forms:maxlength')),
		minlength: $.validator.format(elgg.echo('forms:minlength')),
		rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
		range: $.validator.format("Please enter a value between {0} and {1}."),
		max: $.validator.format("Please enter a value less than or equal to {0}."),
		min: $.validator.format("Please enter a value greater than or equal to {0}.")
	});

	// add methods for jquery validation forms
	$.validator.addMethod("namecheckcar", function(value, element) {
		return this.optional(element) || /^[a-zA-Z][a-zA-Z0-9_]{3,30}$/.test(value);
	}, elgg.echo('registration:namecheckcar'));
	$.validator.addMethod("registerCP", function(value, element) {
		if (value.length != 5) return true;
		if ($(element).hasClass('notfound')) return false;
		return true;
	}, $.validator.format(elgg.echo('ggouv:search:localgroups:notfound')));

	/* French initialisation for the jQuery UI date picker plugin. */
	/* Written by Keith Wood (kbwood{at}iinet.com.au) and Stéphane Nahmani (sholby@sholby.net). */
	$(function($){
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

}
elgg.register_hook_handler('init', 'system', elgg.ggouv_template.init);


/**
 * Reload template of ggouv
 */
elgg.ggouv_template.reload = function() {

	// hide developers-log when empty
	if ($('.developers-log').html() == '') $('.developers-log').hide();

	// body of homepage need got a class to override .elgg-page-body and other class
	if (!$('#section1').data('homepage')) $('body').removeClass('homepage');

	if (!$('.elgg-page-admin').length) {
		var TheColumn = $('#group_activity_module');

		if (TheColumn.is(':visible')) {
			elgg.deck_river.LoadRiver(TheColumn, elgg.get_page_owner_guid());
		}
		$('.elgg-sidebar, .elgg-sidebar-2').fitElement('width', 5, { minSize: '252.8px', maxSize: '360px' }, $(window), function() {
			$('.elgg-sidebar-2, .elgg-layout-one-sidebar, .elgg-sidebar-2 > *').css('margin-right', $('.elgg-sidebar').width() + 30);
		});
		elgg.ggouv_template.resizeSidebar();
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
	$('.validate-form, .elgg-form-profile-edit').validate({
		invalidHandler: ggouv.shakeButton
	});

	/* share menu
	 * @todo I don't remember why I didn't put this code in elgg.ggouv_template.init // This code should move
	 */
	$('.ggouv-share').click(function(e) {
		var $this = $(this),
			thisPos = $this.offset(),
			sMenu = Mustache.compile($('#share-menu').html());

		if ($('.share-menu').length) $('.share-menu').remove();
		$this.addClass('elgg-state-active');
		$('.elgg-page-body').append(
			$(sMenu({
				sl: $this.attr('href'),
				text: $this.data('title')
			})).css({top: thisPos.top+22, left: thisPos.left-218})
		);

		$(document).unbind('click.sharemenu').bind('click.sharemenu', function() {
			$this.removeClass('elgg-state-active');
			$('.share-menu').remove();
			$(document).unbind('click.sharemenu');
		});
		return false;
	});

};

/*
 * Resize, scroll and sidebar
 */
elgg.ggouv_template.resizeSidebar = function() {
	if (!$('.elgg-page-admin').length) {
		if ($('.sidebar-2-fixed').length) {
			var sf = $('.sidebar-2-fixed .elgg-sidebar-2 .elgg-river');
			sf.outerHeight($(window).height() - sf.offset().top);
		}

		if ($('.elgg-sidebar').length) {
			var sb = $('.elgg-sidebar'),
				maxHeight = 0,
				getSidebarHeight = function() {
					var mH = 0;
					sb.children('*:not(script)').each(function() {
						mH += $(this).outerHeight(true);
					});
					return mH;
				};


			// special code for elgg-markdown_wiki page history
			if ($('#slider').length && ($('.history-module .elgg-body').height() < $('#ownerContainer').height())) {
				var oc = $('#ownerContainer'),
					slider = $('#slider');

				slider.height(0);
				maxHeight = getSidebarHeight();
				slider.height($(window).height() - maxHeight - 48 - 21); // 48 = $('.elgg-page-header').height()

				if (oc.find('.owner:not(.hidden)').length) {
					var uiValue = oc.find('.owner:not(.hidden)');
				} else {
					var uiValue = oc.find('.owner:first');
				}
				var nbrDiff = $('.diff-output .diff').length -1,
					OwnerOffset = uiValue.position(),
					valString = uiValue.attr('id'),
					value = valString.substr(valString.indexOf('owner-') + "owner-".length);

				oc.stop().css({top: (nbrDiff-value)*(slider.height()/nbrDiff) - OwnerOffset.top});
			}

			var exPos = $(window).height() - sb.find('.elgg-menu-extras-default').height();
			maxHeight = getSidebarHeight();
			if (exPos > maxHeight) {
				sb.height($(window).height() - 48 - 10); // 48 = $('.elgg-page-header').height()   // 10 = sidebar padding
			} else {
				sb.css({'bottom': -(maxHeight-($(window).height()-48-10))}).data('bpx', -(maxHeight-($(window).height()-48-10)));
				sb.find('.elgg-menu-extras-default').css('position', 'relative');
			}
		}
	}
};


// End of js for ggouv_template plugin

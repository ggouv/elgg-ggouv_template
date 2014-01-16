elgg.provide('ggouv');


/*
 * Tools for jquery validation forms
 */

// Shake button if form or input is not valid.
ggouv.shakeButton = function() {
	$('.elgg-form .elgg-button-submit').animate({'margin-left': 10}, 100, function() {
		$(this).effect("shake", {times:2, distance:10}, 100, function() {
			$(this).animate({'margin-left': 0}, 100);
		});
	});
};



/*
 * Tools for comment
 */

/**
 * Return selected text
 * @return {text} The text selected
 */
ggouv.getSelectionText = function() {
	var text = '';
	if (window.getSelection) {
		text = window.getSelection().toString();
	} else if (document.selection && document.selection.type != 'Control') {
		text = document.selection.createRange().text;
	}
	return text;
};



/**
 * Quote author of a comment and add text as a citation if text is selected
 * @param  [Object] e the button
 * @return nothing
 */
ggouv.quoteComment = function(e) {
	var text = ggouv.getSelectionText(),
		mention = $(e).closest('.elgg-item').find('a[href*="profile"]').attr('href').match('/profile/(.*)')[1],
		inputMD = $(e).closest('.elgg-comments').find('.elgg-form-comments-add .input-markdown'),
		pre = post = '';

	if (inputMD.val() != '') pre = inputMD.val() + '\n\n';
	if (text != '') post = ' \n> ' + text.replace(/[\n\r]/g, '  \n> ') + '\n\n';
	inputMD.focus().val(pre + '@'+mention + ' : ' + post).keyup();
};




elgg.provide('ggouv.super_popup');
/**
 * Display a modal popup with overlay
 * @param  [array] See in code for definition
 */
ggouv.super_popup.create = function(options) {
	var superPopupTemplate = Mustache.compile($('#super-popup-template').html()),
		options = $.extend({
					size: null,                         // [string]           'tiny' for a smaller popup
					title: null,                        // [string]            Title of the popup
					close: true,                        // [bool]              Show close button
					body: null,                         // [string]            Body of the popup
					createdCallback: $.noop,            // [function|string]   function will be executed just after popup is created
					activeCallback: $.noop,             // [function|string]   function will be executed just after popup is actived
					destroyCallback: $.noop,            // [function|string]   function will be executed just after popup is destroy
					ok: 'OK',                           // [string]            text of OK button
					okCallback: function(){             // [function|string]   function will be executed when ok button clicked
						ggouv.super_popup.deactivate()
					},
					cancel: false,                      // [string]            text of cancel button
					cancelCallback: function(){         // [function|string]   function will be executed when cancel button clicked
						ggouv.super_popup.deactivate()
					},
				}, options),
		execFunction = function(func) {
			if (typeof(func) === 'string') {
				eval(func);
			} else if (!elgg.isUndefined(func)) {
				func();
			}
		};

	if (options.cancel === true) options.cancel = elgg.echo('cancel');

	$('.elgg-page').prepend(superPopupTemplate(options));
	$('.tipsy').remove();
	execFunction(options.createdCallback);
	var sP = $('#super-popup');

	sP.find('.elgg-icon-delete-alt, .elgg-button-cancel').click(function() {
		execFunction(options.cancelCallback);
	});
	sP.find('.elgg-button-submit').click(function() {
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
	$('#super-popup').remove(); // @todo if many super popup was created, only one is deleted. Should remove all.
	setTimeout(function() {
		if ($('body').hasClass('fixed-deck')) elgg.deck_river.SetColumnsHeight();
	},500);
};



/**
 * Counter for input/text140
 */
elgg.provide('ggouv.counter140');

ggouv.counter140.init = function() {
	$(".elgg-input-text140").live('keyup', function() {
		ggouv.counter140.count($(this), $(this).parent().find("span"), 140);
	});
};
elgg.register_hook_handler('init', 'system', ggouv.counter140.init);

/**
 * Update the number of characters left with every keystroke
 *
 * @param {Object}  input   The textarea to count chars
 * @param {Object}  status  The counter
 * @param {integer} limit   The limit of chars
 * @return void
 */
ggouv.counter140.count = function(textarea, status, limit) {
	var remaining_chars = limit - $.trim(textarea.val()).length,
		formParent = textarea.closest('form'),
		formSubmitButton = formParent.find('input[type=submit]');

	status.html(remaining_chars);

	if (remaining_chars < 0) {
		status.css("color", "#D40D12");
		formSubmitButton.attr('disabled', 'disabled').addClass('elgg-state-disabled');
	} else {
		var otherText140 = formParent.find('.elgg-input-text140'),
			rem = false;

		status.css("color", "");
		if (!otherText140) rem = true;
		otherText140.each(function() {
			if ($.trim($(this).val()).length < limit) rem = true;
		});
		if (rem) formSubmitButton.removeAttr('disabled', 'disabled').removeClass('elgg-state-disabled');
	}
};



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



/**
 * Autocomplete. Merge from js/lib/ui.autocomplete.js. And modified.
 */
elgg.provide('elgg.autocomplete');

elgg.autocomplete.init = function() {
	$('.elgg-input-autocomplete').each(function() {
		var source = $(this).attr('aria-source');
		$(this).autocomplete({
			source: source, //gets set by input/autocomplete view
			minLength: 2,
			html: "html",
			select: function( event, ui ) {
				$(this).val(ui.item.name);
				$(this).next().val(ui.item.value);
				return false;
			}
		}).removeAttr('name');
	});
};
elgg.register_hook_handler('init', 'system', elgg.autocomplete.init);


/*
 * jQuery UI Autocomplete HTML Extension
 *
 * Copyright 2010, Scott González (http://scottgonzalez.com)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * http://github.com/scottgonzalez/jquery-ui-extensions
 *
 * GGOUV : Merged from vendors/jquery/jquery.ui.autocomplete.html.js < Minimize requests
 */
(function( $ ) {

var proto = $.ui.autocomplete.prototype,
	initSource = proto._initSource;

function filter( array, term ) {
	var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
	return $.grep( array, function(value) {
		return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
	});
}

$.extend( proto, {
	_initSource: function() {
		if ( this.options.html && $.isArray(this.options.source) ) {
			this.source = function( request, response ) {
				response( filter( this.options.source, request.term ) );
			};
		} else {
			initSource.call( this );
		}
	},

	_renderItem: function( ul, item) {
		return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( $( "<a></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
			.appendTo( ul );
	}
});

})( jQuery );



/*
 * Constants for map
 */
FranceGeoCenter = L.latLng(46.763056, 2.424722);
defaultMapZoom = 6;
cloudmadeUrl = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png';

/**
 * Params for a map
 * @param  {[int]} maxZoom  Maximum zoom of the map
 * @return {[array]}        An array used for leaflet.js // map = L.map('map', ggouv.getParamsMap());
 */
ggouv.getParamsMap = function(maxZoom) {
	var maxZoom = maxZoom || 12;
	return {
		center: FranceGeoCenter,
		zoom: defaultMapZoom,
		layers: [
		L.tileLayer(cloudmadeUrl, {
				maxZoom: maxZoom,
				attribution: ''
			})
		]
	}
};



/**
 * Slide elgg-page-default right or left to provide a panel under the page
 * @param  {string} action      Possible value :
 *                                              'open' (slide the page),
 *                                              'fix' (fix css on some element when page change. Called on History chang.),
 *                                              no value close the panel
 * @param  {int}    dist        Distance of the slide. Default : 250px
 */
ggouv.slidr = function(action, dist) {
	var $epd = $('.elgg-page-default'),
		$es = $('.elgg-sidebar, .elgg-sidebar-2'),
		$el = $('.elgg-page .elgg-layout:not(.hidden)'),
		distData = $('body').data('slidr'),
		s = 250,
		a  = 'animate';

	if (action == 'open' && !distData) {

		$('body').data('slidr', dist);
		if (elgg.isUndefined($el.data('right_origin'))) $el.data('right_origin', parseInt($el.css('margin-right')));
		$epd[a]({marginLeft: '+='+dist+'px'}, s);
		$es[a]({right: '-='+dist+'px'}, s);
		$el[a]({marginRight: '-='+dist+'px'}, s);

	} else if (action == 'fix' && distData) {

		$es.css({right: '-='+distData+'px'});
		$el.css({marginRight: '-='+distData+'px'});

	} else if (distData) {

		$('body').removeData('slidr');
		$epd.stop('marginLeft', true, true)[a]({marginLeft: 40}, s);
		$es.stop('right', true, true).each(function(i, e) {
			$(e)[a]({right: $(e).data('right_origin')+'px'}, s);
		});
		$el.stop('marginRight', true, true)[a]({marginRight: $el.data('right_origin')+'px'}, s);

	}
};



/**
 * helper to know if user is on the page or another tab/application.
 * Use HTML5 PageVisibilityAPI.
 * @return {[boolean]} false, window is hidden. Else, true : user is on ggouv !
 */
elgg.provide('ggouv.visibility');

// helper to get visibility property
ggouv.visibility.getHiddenProp = function() {
	var prefixes = ['webkit','moz','ms','o'];

	// if 'hidden' is natively supported just return it
	if ('hidden' in document) return 'hidden';

	// otherwise loop over all the known prefixes until we find one
	for (var i = 0; i < prefixes.length; i++){
		if ((prefixes[i] + 'Hidden') in document) return prefixes[i] + 'Hidden';
	}

	// otherwise it's not supported
	return null;
};

// check if window is hidden.
ggouv.visibility.isWindowHidden = function() {
	var prop = ggouv.visibility.getHiddenProp();

	if (!prop) return false;
	return document[prop];
};

// trigger event when visibility change
ggouv.visibility.change = function() {
	var prop = ggouv.visibility.getHiddenProp();

	if (!prop) return false;
	$(document).bind(prop.replace(/[H|h]idden/,'') + 'visibilitychange', function(evt) {
		if (ggouv.visibility.isWindowHidden()) {
			elgg.trigger_hook('ggouv_visibility_change', 'hidden');
		} else {
			elgg.trigger_hook('ggouv_visibility_change', 'visible');
		}
	});
};
elgg.register_hook_handler('init', 'system', ggouv.visibility.change);
/*
$([window, document]).focus(function(){
	console.log('focus');
}).blur(function(){
	console.log('hidden');
});*/



/**
 * Notification system in browser. Add count in favicon and play sound if window is hidden.
 */
ggouv.notify = function() {
	var beep = $('#beep-audio')[0];

	if (ggouv.visibility.isWindowHidden()) {
		beep.play();
		ggouv.favicon.increase(true);
	} else if (window.console) {
		console.log('ggouv.notify triggered ! Favicon and beep only work if window is hidden.');
	}
};



/**
 * Favicon notification
 */
elgg.provide('ggouv.favicon');

ggouv.favicon.notify = function(num, blink) {
	var blink = blink || false;
	if (num > 99) num = 99;

	var canvas = $('<canvas>')[0],
		ctx,
		img = new Image(),
		$fav = $('#favicon').data('num', num),
		favLink = $fav.data('original_favicon') ? $fav.data('original_favicon') : $fav.data('original_favicon', $fav.attr('href')).attr('href');

	if (canvas.getContext && num > 0) {
		canvas.height = canvas.width = 48;
		ctx = canvas.getContext('2d');
		img.src = favLink;

		img.onload = function () {
			// write image
			ctx.drawImage(this, 0, 0);

			// write circle //rounded rectangle
			ctx.fillStyle = '#F90';
			ctx.arc(24, 22, 19, 0, 2 * Math.PI, false);
			ctx.fill();
			//ctx.fillRect(num>9?0:8, 24, num>9?48:32, 24);

			// write num
			ctx.font = 'bold 26px "helvetica", sans-serif';
			ctx.textAlign = 'center';
			ctx.fillStyle = '#fff';
			ctx.fillText(num, 24, 31); // circle
			//ctx.fillText(num, 24, 45); // rect

			$fav.attr('href', canvas.toDataURL('image/png'));

			if (blink) ggouv.favicon.blink();
		};
	}
};

// clear favicon to restore original.
ggouv.favicon.clear = function() {
	var $fav = $('#favicon'),
		favLink = $fav.data('original_favicon');

	$fav.removeData().attr('href', favLink); // remove all data !
	clearInterval(ggouv.favicon.interval);
};

// Increase count in favicon
ggouv.favicon.increase = function(blink) {
	var num = $('#favicon').data('num') || 0;
	ggouv.favicon.notify(num+1, blink);
};

// Blink favicon
ggouv.favicon.blink = function(stop) {
	var stop = stop || false,
		$fav = $('#favicon');

	if (!stop && !$fav.data('blinked') && $fav.data('original_favicon')) {
		ggouv.favicon.interval = setInterval(function() {
			var href = $fav.data('blinked', true).attr('href');

			if (/^d/.test(href)) {
				$fav.data('notify_favicon', href);
				$fav.attr('href', $fav.data('original_favicon'));
			} else {
				$fav.attr('href', $fav.data('notify_favicon'));
			}
		}, 600);
	} else if (stop) {
		$fav.removeData('blinked').attr('href', $fav.data('notify_favicon'));
		clearInterval(ggouv.favicon.interval);
	}
};

// register hook that clear favicon when window return visible
elgg.register_hook_handler('ggouv_visibility_change', 'visible', ggouv.favicon.clear);


/**
 * Live search on map ! Used with input to provide keyup search
 * @param  {array} options [description]
 * @return {Array}             An array containing group corresponding
 */
$.fn.searchlocalgroup = function(options) {
	var $this = $(this),
		queryTimer,
		options = $.extend({
			nbrChar: 2, // Minimum chars to start searching
			keyupCallback: $.noop, // function to executed during keyup. e is passed as var
			beforeSendCallback: $.noop, // function to execute before send request
			successCallback: $.noop, // function to execute after send request. response is passed as var
		}, options),
		execFunction = function(func) {
			if (typeof(func) === 'string') {
				eval(func);
			} else if (!elgg.isUndefined(func)) {
				func();
			}
		};

	// create map
	map = L.map('map', ggouv.getParamsMap());

	$this.keyup(function(e) {

		execFunction(options.keyupCallback(e));

		if ( e.which == 13) e.preventDefault(); // prevent validate form

		var search_input = $this.val();
		if (search_input.length > options.nbrChar-1) { // @todo when is numeric, trigger only with 5 chars
			clearTimeout(queryTimer);
			queryTimer = setTimeout(function() {
				search_input = $this.val();
				/*elgg.post('ajax/view/ggouv_template/ajax/get_city', {
					dataType: 'json',
					data: {
						city: search_input
					},
					beforeSend: function() {
						$('#searching').removeClass().html('').addClass('loading');
						execFunction(options.beforeSendCallback);
					},
					success: function(response) {
						clearTimeout(queryTimer);
						$('#searching').removeClass().html('');
						execFunction(options.successCallback(response));
					}
				});*/
				$('#searching').removeClass().html('').addClass('loading');
				execFunction(options.beforeSendCallback);
				var response = geoCities[search_input];
				clearTimeout(queryTimer);
				$('#searching').removeClass().html('');
				console.log(response);
				execFunction(options.successCallback(response));
			}, 500);
		}
	});
	return this;
};



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
		var GUID,
			compressor = kompressor || 1,
			settings = $.extend({
				'minSize' : Number.NEGATIVE_INFINITY,
				'maxSize' : Number.POSITIVE_INFINITY,
				'modificator' : 0
			}, options);

		return this.each(function() {
			var $this = $(this),
				container = based || $this,
				resizer = function() { // Resizer() resizes items based on the object width divided by the compressor
					$this.css(element, Math.max(
						Math.min(
							container.width()/(compressor),
							parseFloat(settings.maxSize)
						),
						parseFloat(settings.minSize)
					) + settings.modificator);
					if (callback) callback(); // Execute callback if any
				},
			nodeBind = 'resize.fitElement.'+this.nodeName+this.id+this.className.replace(/\s+/g, '-'); // identify bind handler

			resizer(); // Call once to set

			// Call on resize. Opera debounces their resize by default
			$(window).unbind(nodeBind).bind(nodeBind, resizer);
		});
	};
})( jQuery );










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

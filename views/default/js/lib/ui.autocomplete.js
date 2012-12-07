/**
 * 
 */
elgg.provide('elgg.autocomplete');

elgg.autocomplete.init = function() {
	$('.elgg-input-autocomplete').each(function() {
		var source = $(this).attr('aria-source');
		$(this).autocomplete({
			source: source, //gets set by input/autocomplete view
			minLength: 2,
			html: "html"
		});
	});
};

elgg.register_hook_handler('init', 'system', elgg.autocomplete.init);

// js for ggouv template
elgg.provide('elgg.ggouv_template');

elgg.ggouv_template.init = function() {

	// sub-menu
	$('.elgg-parent-menu').hover(function(){
		$(this).addClass('hover');
		$('.elgg-child-menu').fadeOut(100);
		var TheMenu = $(this).children('a').attr('href').substr(1);
		$('.elgg-submenu-'+TheMenu).fadeIn(100);
	},function(){
		$(this).removeClass('hover');
	});
	$('.elgg-child-menu').hover(function(){
		var TheMenu = $(this).attr('href');
		console.log(TheMenu);
		$('.elgg-menu-item-'+TheMenu).addClass('hover');
	},function(){
		var TheMenu = $(this).attr('href');
		$('.elgg-child-menu').fadeOut(100);
		$('.elgg-menu-item-'+TheMenu).removeClass('hover');
	});

	// thewire and search input
	$('#elgg-search-inactive').click(function(){
		if ($('#thewire-textarea').height() > 20 ) {
			$('#thewire-textarea').height('20');
		}
		$('.thewire-button').animate({left: '+=-46'}, 400);
		$('.search-submit-button').animate({left: '+=-40'}, 400);
		$('.elgg-search').css('z-index','7001');
	});
	$('#thewire-header-inactive').click(function(){
		$('.thewire-button').animate({left: '+=46'}, 400);
		$('.search-submit-button').animate({left: '+=40'}, 400);
		$('.elgg-search').css('z-index','6999');
	});
	
	// textarea autoResize
	(function(a){a.fn.autoResize=function(j){var b=a.extend({onResize:function(){},animate:true,animateDuration:150,animateCallback:function(){},extraSpace:12,limit:1000},j);this.filter('textarea').each(function(){var c=a(this).css({resize:'none','overflow-y':'hidden'}),k=c.height(),f=(function(){var l=['height','width','lineHeight','textDecoration','letterSpacing'],h={};a.each(l,function(d,e){h[e]=c.css(e)});return c.clone().removeAttr('id').removeAttr('name').css({position:'absolute',top:0,left:-9999}).css(h).attr('tabIndex','-1').insertBefore(c)})(),i=null,g=function(){f.height(0).val(a(this).val()).scrollTop(10000);var d=Math.max(f.scrollTop(),k)+b.extraSpace,e=a(this).add(f);if(i===d){return}i=d;if(d>=b.limit){a(this).css('overflow-y','');return}b.onResize.call(this);b.animate&&c.css('display')==='block'?e.stop().animate({height:d},b.animateDuration,b.animateCallback):e.height(d)};c.unbind('.dynSiz').bind('keyup.dynSiz',g).bind('keydown.dynSiz',g).bind('change.dynSiz',g)});return this}})(jQuery);
	$('#thewire-textarea').autoResize({
		animateDuration : 300
	});
	
	// thewire live post
	$('.elgg-form-ggouv-template-header-input').submit(function() { return false; });
	$('#thewire-submit-button').click(function(){
		thisSubmit = this;
		if ($.data(this, 'clicked')) { // Prevent double-click
			return false;
		} else {
			$.data(this, 'clicked', true);
			dataString = $(this).parents('form').serialize();
			elgg.action('ggouv_template/header_input', {
				data: dataString,
				success: function(json) {
					$.data(thisSubmit, 'clicked', false);
					$('#thewire-textarea').val('');
					return false;
				},
				error: function(){
					$.data(thisSubmit, 'clicked', false);
				}
			});
		}
	});
	
}
elgg.register_hook_handler('init', 'system', elgg.ggouv_template.init);

/*
$(function() {
	
	// ggouv-menu-item-html-char
	$.fx.step.textShadowHTMLchar = function(fx) {
		$(fx.elem).css({textShadow: fx.now +'px 0px 2px #AAAAAA'});
	};

	// sub-menu
	$('.elgg-parent-menu').mouseenter(function(){
		$('.elgg-child-menu').fadeOut(100);
		$(this).children('a').animate({'font-size':'2.3em', textShadowHTMLchar:4}, 100);
		var TheMenu = $(this).children('a').attr('href').substr(1);
		$('.elgg-submenu-'+TheMenu).fadeIn(100);
	});
	$('.elgg-parent-menu').mouseleave(function(){
		$(this).children('a').animate({'font-size':'2em', textShadowHTMLchar:1}, 100);
	});
	$('.elgg-child-menu').mouseleave(function(){
		$('.elgg-child-menu').fadeOut(100);
	});
	$('.elgg-child-menu').mouseenter(function(){
		var TheMenu = $(this).attr('href');
		$('elgg-menu-item-'+TheMenu).children('a').css({'font-size':'2em', 'text-shadow':'1px 0px 2px #AAAAAA'});
	});

	// thewire and search input
	$('#elgg-search-inactive').click(function(){
		if ($('#thewire-textarea').height() > 20 ) {
			$('#thewire-textarea').height('20');
		}
		$('.thewire-button').animate({left: '+=-46'}, 400);
		$('.search-submit-button').animate({left: '+=-40'}, 400);
		$('.elgg-search').css('z-index','7001');
	});
	$('#thewire-header-inactive').click(function(){
		$('.thewire-button').animate({left: '+=46'}, 400);
		$('.search-submit-button').animate({left: '+=40'}, 400);
		$('.elgg-search').css('z-index','6999');
	});

//	// drag and drop name and avatar into thewire input
//	$('#thewire-textarea').droppable({
//		accept: ".elgg-avatar > a",
//		drop: function(ev, ui) {
//			$(this).insertAtCaret(ui.draggable.text());
//		}
//	});
//	$.fn.insertAtCaret = function (myValue) {
//		return this.each(function(){
//			//IE support
//			if (document.selection) {
//				this.focus();
//				sel = document.selection.createRange();
//				sel.text = myValue;
//				this.focus();
//			}
//			//MOZILLA / NETSCAPE support
//			else if (this.selectionStart || this.selectionStart == '0') {
//				var startPos = this.selectionStart;
//				var endPos = this.selectionEnd;
//				var scrollTop = this.scrollTop;
//				this.value = this.value.substring(0, startPos)+ myValue+ this.value.substring(endPos,this.value.length);
//				this.focus();
//				this.selectionStart = startPos + myValue.length;
//				this.selectionEnd = startPos + myValue.length;
//				this.scrollTop = scrollTop;
//			} else {
//				this.value += myValue;
//				this.focus();
//			}
//		});
//	}

	// list-item
	/*$('.elgg-layout-one-sidebar .elgg-item').click(function(){
		location.href=$(this).find('.elgg-body h3 a').attr('href');
	});*/
/*
	// textarea autoResize
(function(a){a.fn.autoResize=function(j){var b=a.extend({onResize:function(){},animate:true,animateDuration:150,animateCallback:function(){},extraSpace:12,limit:1000},j);this.filter('textarea').each(function(){var c=a(this).css({resize:'none','overflow-y':'hidden'}),k=c.height(),f=(function(){var l=['height','width','lineHeight','textDecoration','letterSpacing'],h={};a.each(l,function(d,e){h[e]=c.css(e)});return c.clone().removeAttr('id').removeAttr('name').css({position:'absolute',top:0,left:-9999}).css(h).attr('tabIndex','-1').insertBefore(c)})(),i=null,g=function(){f.height(0).val(a(this).val()).scrollTop(10000);var d=Math.max(f.scrollTop(),k)+b.extraSpace,e=a(this).add(f);if(i===d){return}i=d;if(d>=b.limit){a(this).css('overflow-y','');return}b.onResize.call(this);b.animate&&c.css('display')==='block'?e.stop().animate({height:d},b.animateDuration,b.animateCallback):e.height(d)};c.unbind('.dynSiz').bind('keyup.dynSiz',g).bind('keydown.dynSiz',g).bind('change.dynSiz',g)});return this}})(jQuery);
	$('#thewire-textarea').autoResize({
		animateDuration : 300
	});

});

$(document).ready(function() {

	//$(".elgg-avatar-small a").live("draggable({helper: 'clone'}).css({'font-size':'2em'})");
//	$(".elgg-avatar-small > a").live('mouseover',function(){
//		$(this).draggable({revert: 'invalid', appendTo: 'body', containment: 'window', scroll: 'false', helper: 'clone'});
//	});

	if ( $('.elgg-layout-one-sidebar').length ) {
		//SetListItemsWidth();
	}
});

$(window).bind("resize", function() {
	if ( $('.elgg-layout-one-sidebar').length ) {
		//$('.elgg-list-item').css('margin','10px');
		//SetListItemsWidth();
	}
});

function SetListItemsWidth() {
	var ListWidth = WindowWidth = $('.elgg-layout-one-sidebar').width() - $('.elgg-sidebar').width() - 50;
	var i = 0;
	while ( ListWidth > 375 ) {
		i++;
		ListWidth = (WindowWidth) / ( i );
	}
	i--;
	$('.elgg-layout-one-sidebar > .elgg-body > .elgg-list-entity > .elgg-item').width( ((WindowWidth - (i-1)*20) / i) );
	$('.elgg-layout-one-sidebar > .elgg-body > .elgg-list-entity > .elgg-item:nth-child('+i+'n+1)').css('margin-left',0);
	$('.elgg-layout-one-sidebar > .elgg-body > .elgg-list-entity > .elgg-item:nth-child('+i+'n+'+i+')').css('margin-right',0);
}
*/
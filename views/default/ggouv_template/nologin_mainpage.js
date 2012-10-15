
// nologin.mainpage js

$(document).ready(function() {
	$('.slidewrap3').carousel({
		slider: '.slider',
		slide: '.slide',
		slideHed: '.slidehed',
		addNav: false,
		addPagination: true,
		addNav : false,
		speed: 600 // ms.
	});

	MiddleWindow();

	$(".elgg-inner-nolog.main h1").fitElement('font-size', 10, { minSize: '18px', maxSize: '95px' });
	$(".title").fitElement('font-size', 10, { minSize: '9px', maxSize: '75px' });
	$(".content").fitElement('font-size', 45, { minSize: '9px', maxSize: '18px' });
	//$(".ribbon").fitElement('right', 45, { minSize: '-50px', maxSize: '-30px' });
	$(".ribbon").fitElement('font-size', 2, { minSize: '10px', maxSize: '15px' });
	//$("img").fitElement('width', 2, { minSize: '100px'});

	MiddleWindow();
	CalculateArticlePos();

	$('.title > li').click(function() {
		$.scrollTo('.content > li:nth-child('+ (parseInt($(this).index())+1) +')', 500);
	});
	
/*	$('.title li').hover(
	function() {
		var LastPosTop = $('#cursor').position().top;
		var LastPosWidth = $('#cursor').width();
		$('#cursor').css({'top' : $(this).position().top+'px', 'width' : $(this).width()+40});
	},function() {
		CalculateArticlePos();
	});*/

	$('.title, .content').css('opacity', 1);

});

$(window).bind("resize", function() {
	MiddleWindow(CalculateArticlePos);
	
	//$.scrollTo('.content li:nth-child('+ (parseInt($(this).index())+1) +')', 500);
});

$(window).scroll(function() {
	CalculateArticlePos();
});

function CalculateArticlePos() {
	var posts_pos = [];
	$('.content > li').each(function() {
		var posts_offset = $(this).offset();
		posts_pos.push([ posts_offset.top + $(this).height()/2 ]);
	});
	var TheScroll = $(window).scrollTop()
	for(var i in posts_pos) {
		if (TheScroll < Math.round(posts_pos[i])) {
			var ii = $('.title > li:nth-child('+ (parseInt(i)+1) +')'),
			TitleTop = ii.position().top,
			TitleWidth = ii.outerWidth(),
			TitleHeight = ii.outerHeight();
			break;
		}
	}
	$('#cursor').css({'top' : TitleTop+'px', 'width' : TitleWidth, 'height' : TitleHeight});
}

function MiddleWindow(callback) {
	// width
	var windowWidth = $(window).width();
	
	$('.content').css({'width' : windowWidth * 60/100, 'margin-left' : windowWidth* 20/100});
	// height
	var windowHeight = $(window).height();
	$('.title').css('padding-top', (windowHeight - $('.title').height())/2);
	$('.background-nolog-main').height(windowHeight-48);
	$('.content > li').each(function() {
		var articleHeaderPadding = ( (windowHeight) - $(this).height() ) / 2;
		var minPaddingTop = $(".elgg-inner-nolog.main h1").position().top + $(".elgg-inner-nolog.main h1").innerHeight() + 40;
		if ( articleHeaderPadding <= minPaddingTop ) {
			$(this).css({'padding-top' : minPaddingTop, 'padding-bottom' : 20});
		} else {
			$(this).css({'padding-top' : articleHeaderPadding, 'padding-bottom' : articleHeaderPadding});
		}
	});
	//var lastPadding = parseInt($('.content > li:last-child').css('padding-bottom').replace("px", ""));
	//$('.content > li:last-child').css({'padding-bottom' : lastPadding})
	//var maxPtop = $(".elgg-inner-nolog.main h1").position().top + $(".elgg-inner-nolog.main h1").innerHeight() + 10;
	//if ($('.content > li:first-child').css('padding-top').replace("px", "") <= maxPtop) $('.content > li:first-child').css({'padding-top' : maxPtop});
	if (callback) callback();
}
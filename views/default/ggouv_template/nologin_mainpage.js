
// nologin.mainpage js

$(document).ready(function() {

	MiddleWindow();
	CalculateArticlePos();

	$('.title li').click(function() {
		$.scrollTo('.content li:nth-child('+ (parseInt($(this).index())+1) +')', 500);
	});
	
/*	$('.title li').hover(
	function() {
		var LastPosTop = $('#cursor').position().top;
		var LastPosWidth = $('#cursor').width();
		$('#cursor').css({'top' : $(this).position().top+'px', 'width' : $(this).width()+40});
	},function() {
		CalculateArticlePos();
	});*/

});

$(window).bind("resize", function() {
	MiddleWindow();
	CalculateArticlePos();
	$.scrollTo('.content li:nth-child('+ (parseInt($(this).index())+1) +')', 500);
});

$(window).scroll(function() {
	CalculateArticlePos();
});

function CalculateArticlePos() {
	var posts_pos = [];
	$('.content li').each(function() {
		posts_offset = $(this).offset();
		posts_pos.push([ posts_offset.top + $(this).width()/2 ]);
	});
	var TheScroll = $(window).scrollTop()
	for(var i in posts_pos) {
		if (TheScroll < Math.round(posts_pos[i])) {
			ii = $('.title li:nth-child('+ (parseInt(i)+1) +')');	
			TitleTop = ii.position().top;
			TitleWidth = ii.width()+40;
			TitleHeight = ii.height()+40;
			break;
		}
	}
	$('#cursor').css({'top' : TitleTop+'px', 'width' : TitleWidth, 'height' : TitleHeight});
}

function MiddleWindow() {
	var windowHeight = $(window).height();
	$('.title').css('padding-top', (windowHeight - $('.title').height())/2);
	$('.background-nolog-main').height(windowHeight-48);
	$('.content li').each(function() {
		var articleHeaderTop = ( (windowHeight) - $(this).height() ) / 2;
		if (articleHeaderTop <= 160) articleHeaderTop = 160;
		$(this).css({'padding-top' : articleHeaderTop, 'padding-bottom' : articleHeaderTop});
	});
}
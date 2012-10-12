/*******************************************************************
 * Slider
 *******************************************************************/
function slideImages(ele){
	$(ele).each(function(){
		var active = $(this).find('.active');
		var next = ($(this).find('.active').next().length > 0) ? $(this).find('.active').next() : $(this).find('figure:first');

		//next.css({'z-index':2, 'display':'block'}); //move the next image up the pile
		// next.fadeIn(1500,function(){
		// 	next.css({'z-index':2});
		// })
		active.fadeOut(1500,function(){ //fade out the top image
			active.css({'z-index':1}).show().removeClass('active').css({'display':'none'}); //reset the z-index and unhide the image
			next.css({'z-index':4}).fadeIn(1500).addClass('active'); //make the next image the top one
			return false ;
		});
			return false ;
		
	});
}

$(function(){
	setInterval('slideImages(".cycler")', 7000);
})
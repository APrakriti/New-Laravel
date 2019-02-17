
$(document).ready(function(){

	$("#top-search").click(function(){
		$("#top-search-wrap").fadeIn(250);		
	});
	$("#top-search-close").click(function(){

		$("#top-search-wrap").fadeOut(250);	
		
	});
	
	//project pop up
		$('.frame').hover(
		function(){
			$(this).find('.content_pop').fadeIn(250);
		},
		function(){
			$(this).find('.content_pop').fadeOut(250);
		}
	);
//project pop up end

// wow
new WOW().init();
// wow end


// select

    $('select').material_select();
	
	
});

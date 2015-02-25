jQuery(function($){


//Link to facebook -- opens in external page	
	$("a[href^='http://facebook.com'], a[href^='https://facebook.com']").before('<span class="icon_facebook"></span> ').attr('target', '_blank');

//Link to google+ -- opens in external page	
	$("a[href^='http://plus.google.com'], a[href^='https://plus.google.com']").before('<span class="icon_google"></span> ').attr('target', '_blank');


//Link to linkedin -- opens in external page	
	$("a[href^='http://linkedin.com'], a[href^='https://linkedin.com']").before('<span class="icon_linkedin"></span> ').attr('target', '_blank');

	
//Link to twitter -- opens in external page	
	$("a[href^='http://twitter.com'], a[href^='https://twitter.com']").before('<span class="icon_twitter"></span> ').attr('target', '_blank');
	
	


	//REMOVE THIS LINE -- DISABLES ALL LINKS!
	$('a').click(function(){ return false; });
});
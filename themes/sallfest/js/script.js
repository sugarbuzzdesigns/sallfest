/*  Table of Contents 
01. MENU ACTIVATION
02. GALLERY JAVASCRIPT
03. FITVIDES RESPONSIVE VIDEOS
04. FIXED NAVIGATION BAR
05. JQUERY FILTER SCHEDULE
06. MOBILE SELECT MENU
07. prettyPhoto Activation
08. Form Validation
09. Light Shortcodes
10. Backstretch
*/


jQuery(document).ready(function($) {


/*
=============================================== 01. MENU ACTIVATION  ===============================================
*/
	jQuery("ul.sf-menu").supersubs({ 
	        minWidth:    2,   // minimum width of sub-menus in em units 
	        maxWidth:    20,   // maximum width of sub-menus in em units 
		extraWidth:  0     // extra width can ensure lines don't sometimes turn over 
	                           // due to slight rounding differences and font-family 
	    }).superfish({ 
			animation:  {opacity:'show'},
			animationOut:  {opacity:'hide'},
			speed:         200,           // speed of the opening animation. Equivalent to second parameter of jQuery’s .animate() method
			speedOut:      'normal',
			autoArrows:    true,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
			dropShadows:   false,               // completely disable drop shadows by setting this to false 
			delay:     400               // 1.2 second delay on mouseout 
		});

/*
=============================================== 02. GALLERY JAVASCRIPT  ===============================================
*/
    $('.gallery-progression').flexslider({
		animation: "fade",      
		slideDirection: "horizontal", 
		slideshow: false,         
		slideshowSpeed: 7000,  
		animationDuration: 200,        
		directionNav: true,             
		controlNav: true
    });


/*
=============================================== 03. FITVIDES RESPONSIVE VIDEOS  ===============================================
*/
	 $(".width-container").fitVids();
		 
/*
=============================================== 04. FIXED NAVIGATION BAR  ===============================================
*/
	 $('#fixed-nav-pro nav').scrollToFixed();


/*
=============================================== 05. JQUERY FILTER SCHEDULE  ===============================================
*/	 
	
	$("#schedule-content-progression").hide(0).delay(250).fadeIn(250)
	$('#schedule-content-progression').children('li:not(.day-1)').hide();

 	$('#filterOptions-pro li a').click(function() {
 		// fetch the class of the clicked item
		
		var ourClass = $(this).attr('class');
		
 		// reset the active class on all the buttons
 		$('#filterOptions-pro li').removeClass('current-cat');
 		// update the active state on our clicked button
 		$(this).parent().addClass('current-cat');
		
		
		// hide all elements that don't share ourClass
		$('#schedule-content-progression').children('li:not(.' + ourClass + ')').fadeOut(250);
		// show all elements that do share ourClass
		$('#schedule-content-progression').children('li.' + ourClass).delay(250).fadeIn(250);
		
 		return false;
 	});
	
/*
=============================================== 06. MOBILE SELECT MENU  ===============================================
*/

	$('.sf-menu').mobileMenu({
	    defaultText: 'Navigate to...',
	    className: 'select-menu',
	    subMenuDash: '&ndash;&ndash;'
	});


/*
=============================================== 07. prettyPhoto Activation  ===============================================
*/

	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: 5000, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: false, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: false, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
		overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		ie6_fallback: true,
		social_tools: '' /* html or false to disable  <div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div> */
	});


/*
=============================================== 08. Form Validation  ===============================================
*/


	$("#CommentForm").validate();
		
	
/*
=============================================== 09. Light Shortcodes  ===============================================
*/
	
	
	// Accordion
	$(".ls-sc-accordion").accordion({heightStyle: "content"});
	
	// Toggle
	$(".ls-sc-toggle-trigger").click(function(){$(this).toggleClass("active").next().slideToggle("fast");return false; });
	
	// Tabs
	$( ".ls-sc-tabs" ).tabs();



/*
=============================================== 10. Backstretch ===============================================
*/	

	$("footer").backstretch([ "images/footer-bg.jpg" ],{ fade: 750, });
	$("body.page header").backstretch(["images/page-title.jpg"],{fade:750,});

	
	
// END
});
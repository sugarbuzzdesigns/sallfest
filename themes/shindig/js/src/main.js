/*  Table of Contents
01. MENU ACTIVATION
02. GALLERY JAVASCRIPT
03. FITVIDES RESPONSIVE VIDEOS
04. FIXED NAVIGATION BAR
05. JQUERY FILTER SCHEDULE
*/

jQuery(document).ready(function($) {
	 'use strict';

	if($('body.single-product').length){
		var $variationsForm = $('.variations_form');
		var quantityInput = $('.quantity input[type="number"]');
		var firstNameInput = $('.addon-options-wrap .form-row[class*="-name"]');
		var nameInputs = [
			firstNameInput
		];

		quantityInput.on('change keyup', function() {
			var $this = $(this);
			var ticketNumber = $this.val();
			var arr = [1, 2, 3];

			firstNameInput.removeClass('required').hide();

			for(var index = 0; index < ticketNumber; index++) {
				firstNameInput.eq(index).show().addClass('required');
			}
		});

		$variationsForm.on('submit', function(evt) {
			var validInputs = validateInputs($('.addon-options-wrap .form-row.required'));

			if(validInputs){
				return true;
			} else {
				alert('Enter a full name for each ticket');
				return false;
			}
		});

		function validateInputs(inputs){
			var valid = false;
			var invalidInputs = [];

			inputs.each(function(i, input) {
				if(!$(input).find('input').val()){
					invalidInputs.push(input);
				}
			});

			if(invalidInputs.length){
				valid = false;
			} else {
				valid = true;
			}

			return valid;
		}
	};
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
=============================================== audiojs  ===============================================
*/

	// Setup the player to autoplay the next track
	var a = audiojs.createAll({
		trackEnded: function() {
			var next = $('ol li.playing').next();
			if (!next.length) next = $('ol li').first();
			next.addClass('playing').siblings().removeClass('playing');
			audio.load($('a', next).attr('data-src'));
			audio.play();
		}
	});

	// Load in the first track
	var audio = a[0],
		first = $('ol a').data('src');

	$('ol li').first().addClass('playing');

	if(typeof audio === 'undefined'){
		// console.log('no audio');
	} else {
		audio.load(first);

		var trackTitle = $('ol a').first().text();
		var buySongLink = $('ol a').first().data('buy-link');
		var trackPoster = $('ol a').first().data('poster');

		$('.buy-song').attr('href', buySongLink);
		$('.poster').attr('src', trackPoster);

		$('.audiojs h2').text(trackTitle);

		// Load in a track on click
		$('ol li').click(function(e) {
			e.preventDefault();
			if($(this).is('.coming-soon')){
				return;
			}
			var id = $(this).find('a').data('song-id');
			var trackTitle = $(this).text();

			$('#' + id).addClass('active').siblings().removeClass('active');

			$(this).addClass('playing').siblings().removeClass('playing');
			audio.load($('a', this).attr('data-src'));
			$('.audiojs h2').text(trackTitle);
			audio.play();
		});
		// Keyboard shortcuts
		$(document).keydown(function(e) {
			var unicode = e.charCode ? e.charCode : e.keyCode;
			// right arrow
			if (unicode == 39) {
				var next = $('li.playing').next();
			if (!next.length) next = $('ol li').first();
				next.click();
			// back arrow
			} else if (unicode == 37) {
				var prev = $('li.playing').prev();
			if (!prev.length) prev = $('ol li').last();
				prev.click();
			// spacebar
			} else if (unicode == 32) {
				audio.playPause();
			}
		});

		$('.info ul li').click(function(){
			if ($(this).is('.active')) {return;};
			$(this).toggleClass('active').siblings().toggleClass('active');


			var cat = $(this).data('info-toggle');
			if (cat === 'lyrics') {
				$('.song-extras .active .lyrics').addClass('selected');
				$('.song-extras .active .about').removeClass('selected');
			} else {
				$('.song-extras .active .about').addClass('selected');
				$('.song-extras .active .lyrics').removeClass('selected');
			}
		});
	}

	// Homepage read more link
	$('.readmore').click(function(){
		$(this).slideUp();

		$('.hide').slideDown();
	});

	$('.sf-menu').mobileMenu({ defaultText: '"Navigate to...", "progression"', className: 'select-menu', subMenuDash: '&ndash;&ndash;' });

	// $('#taxonomy_navigation_pro .saturday').click();

	$('#friday-sallfest-kickoff-free-show').on('click', function(e){
		e.preventDefault();
	});
});

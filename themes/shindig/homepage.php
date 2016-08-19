<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
		<div class="width-container">
			<img id="home-logo" class="logo" src="http://www.sallfest.com/wp-content/uploads/2015/09/Shine_Logo.png" alt="">
		</div>
	</header>
<style>
	#coming-soon-banner {
		display: block;
		height: 100%;
		width: 100%;
		background-image: url(http://www.sallfest.com/wp-content/uploads/2016/04/SALLFEST_2016_HERO_web.jpg);
		background-size: cover;
	}
</style>

<a href="#" id="coming-soon-banner"></a>

<div class="clearfix"></div>

<div id="pyre_homepage_text-widget" class="light-fonts-pro homepage-widget-blog">
	<div class="width-container">
		<h1 class="home-widget">ABOUT SALLFEST</h1>
		<p>Get ready for the First Annual Shine a Little Love Fest October 23-24! Join in on the music, fun and festivities! Bring your friends and meet many new ones as we Shine the Love on 30A with some amazing music with a lineup that includes hit songwriters Wynn Varble (Brad Paisley, Daryl Worley, Easton Corbin), Travis Meadows (Dierks Bentley, Jake Owen, Eric Church) and John Driskell Hopkins of Zac Brown Band. Also performing during the weekend are The Best Brothers Band, MAGNO, Casey Twist and Paige Logan of country music duo, North 40. Serving as host and co-creator of the festival, Brian Collins will also treat the ticket holders to performances both nights.
		It will be a weekend to remember!</p>
		<div class="readmore"><span>Read More</span></div>
		<div class="hide">
			<p>Through the Shine a Little Love Fest, we will Shine Love on the Wounded Warrior Project (WWP) and Wesley Burnham Foundation. Both projects work tirelessly to continue to Shine Love on others.</p>
			<p>The WWP mission statement is "to honor and empower Wounded Warriors". The core values they are working on building for the most adjusted generation of wounded service members in our nation's history are fun, integrity, loyalty, innovation, and service. WWP serves to assist military veterans or families that were wounded on or after September 11, 2001. Wounds are not always seen and WWP works to address all the needs for men and woman who paid their dues wearing a uniform. Shine A Little Love Fest is proud to help raise funds for a great organization.</p>
			<p>The Wesley Burnham Foundation is a perfect opportunity for us to Shine Love! Wesley was a vibrant little boy who loved music, God and his blue guitar! He shined love through his passion for music as he led his congregation at Woodlawn Methodist Church in a Christmas concert the day he was in a tragic accident. His parents wanted to create a special memory, so they created a foundation in Wesley's name to enable other children to experience the educational start he had that was grounded in faith, music and love. The goal is to raise enough money to start a music program in Wesley's name. Let's shine the love!</p>
		</div>
	</div>
</div>

<script>
	(function($){
		$('.readmore').click(function(){
			$(this).slideUp();

			$('.hide').slideDown();
		});
	})(jQuery);
</script>

<script>
(function($){
	$(function() {
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
		var audio = a[0];
		first = $('ol a').data('src');
		$('ol li').first().addClass('playing');
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
	});
})(jQuery);
</script>

	<?php while(have_posts()): the_post(); ?>
	<?php if($post->post_content=="") : ?><?php else : ?>
	<div id="main">
		<div id="homepage-content-container">
		<div class="width-container">
			<?php the_content(); ?>
			<div class='clearfix'></div>
		</div><!-- close  .width-container -->
		</div>
	</div><!-- close  #main -->
	<?php endif; ?>
	<?php endwhile; ?>

<?php get_footer(); ?>
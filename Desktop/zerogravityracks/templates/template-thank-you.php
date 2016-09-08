<?php 
/*
Template Name: Thank You Page
*/
?>

<?php get_header(); ?>

<div class="thank-you-wrap">

	<?php $img = get_field('thank_you_background_image'); ?>

	<style>
		.thank-you-section-inner {
			background-image: url('<?php echo $img['sizes']['mobile-bg']; ?>');
		}
		@media screen and (min-width: 700px){
			.thank-you-section-inner {
				background-image: url('<?php echo $img['url']; ?>');
			}
		}
	</style>

	<div class="cf thank-you-section-inner">
		<div class="thank-you-header-wrap matcher">
		  <div class="thank-you-inner">
			<h2 class="thank-you-header white medium-title default-animate not-animated"><?php the_field('thank_you_header'); ?></h2>
			<div class="thank-you-text white small-title default-animate not-animated"><?php the_field('thank_you_text'); ?></div>
			<div class="sharrre-buttons">
			    <div class="cf facebook white default-animate not-animated">Share</div>
			    <div class="cf twitter white default-animate not-animated">Tweet</div>
			</div>
		  </div>
		</div>

		<div class="thank-you-image-wrap matcher">
			<div class="thank-you-image"><?php acf_image('thank_you_image'); ?></div>
		</div>

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>


		<script>
		    jQuery(document).ready(function($) {
		        $(function() {
		            var clicks = 0;
		            $('button').on('click', function() {
		                clicks++;
		                var percent = Math.min(Math.round(clicks / 3 * 100), 100);
		                $('.percent').width(percent + '%');
		                $('.number').text(percent + '%');
		            });
		            
		            
		            $('.facebook').on('click', function() {
		                var w = 580, h = 300,
		                        left = (screen.width/2)-(w/2),
		                        top = (screen.height/2)-(h/2);
		                    
		                    
		                    if ((screen.width < 480) || (screen.height < 480)) {
		                        window.open ('http://www.facebook.com/share.php?u=<?php the_field('fb_share_link'); ?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		                    } else {
		                        window.open ('http://www.facebook.com/share.php?u=<?php the_field('fb_share_link'); ?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);   
		                    }
		            });
		            
		            $('.twitter').on('click', function() {
		                var loc = encodeURIComponent('<?php the_field('twitter_share_link'); ?>'),
		                        title = "<?php the_field('twitter_share_text'); ?>",
		                        w = 580, h = 300,
		                        left = (screen.width/2)-(w/2),
		                        top = (screen.height/2)-(h/2);
		                        
		                    window.open('http://twitter.com/share?text=' + title + '&url=' + loc, '', 'height=' + h + ', width=' + w + ', top='+top +', left='+ left +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
		            });
		            
		            $('.play').on('click', function() {
		                window.location.href = "<?php the_field('play_url'); ?>";
		            });
		            
		        });
		    });
		</script>

	</div>
</div>

<?php get_footer(); ?>
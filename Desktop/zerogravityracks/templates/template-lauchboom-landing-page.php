<?php 
/*
Template Name: Launchboom Landing Page
*/

	if (isset($_GET["modal"])){
		$modal = $_GET["modal"];
	}

	get_template_part('inc/dynamic-content');

	get_header(); 
?>

<div class="top-section-wrap">
	<div class="top-section-content-inner">
	  <div class="cf">
		<div class="video-holder">
			<div class="home-hero">
				<div class="video-cover"></div>
				<?php $video = get_field('background_video'); ?>
				<?php if (!empty($video)): ?>
					<?php if(!isset($_GET["image"])): ?>
					<video id="video-hero" class="video-hero" muted="muted" preload="auto" autoplay loop> 
			            <source src="<?php tf('background_video'); ?>" type="video/mp4">
			        </video>
			        <?php endif; ?>
			    <?php endif; ?>
			<div class="top-content-inner">
				<div class="top-logo-wrap">
					<div class="top-logo default-animate not-animated"><?php acf_image('logo'); ?></div>
				</div>
				<div class="top-header-wrap default-animate not-animated">
					<div class="top-header-wrap-inner">
						<h2 class="top-header bigger-title"><?php the_field('headline'); ?></h2>
						<h3 class="top-sub-header h3"><?php the_field('subheadline'); ?></h3>
						<div class="top-hidden-image"><?php acf_image('background'); ?></div>
					</div>
				</div>
			
				<div class="top-cta-left-wrap">
				</div>
			
	    		<div class="top-cta-right-wrap">
					<div class="top-cta-right-inner default-animate not-animated">
						<h3 class="top-cta-header smaller-medium-title white"><?php tf('top_cta_header'); ?></h3>
						<div class="top-cta-sub-header h4 white"><?php tf('top_cta_sub_header'); ?></div>
						<div class="cta-email-wrap">
							<?php echo do_shortcode(get_field('modal_shortcode')); ?>
						</div>
						<div class="top-cta-bottom-text smallest-title white"><?php tf('top_cta_bottom_text'); ?></div>
					</div>
	    		</div>
			</div>
			</div>
		</div>
	</div>
  </div>
</div>

<div id="main-content">
	
		<?php if( have_rows('flexible_content') ):

		    while ( have_rows('flexible_content') ) : the_row();

		    if( get_row_layout() == 'flexible_content' ): ?>

			<?php elseif( get_row_layout() == 'sub_section' ): ?>
				<div class="sub-section-wrap">
					<div class="cf sub-section-content-inner">
						<h2 class="sub-section-header big-title default-animate not-animated"><?php tsf('sub_section_header'); ?></h2>
						<?php while(have_rows('sub_section_repeater')): the_row(); ?>
						
							<div class="sub-section-inner">
								<div class="sub-section-arrow-image default-animate not-animated"><?php acf_sub_image('sub_section_arrow_image'); ?></div>
								<div class="sub-section-text white h4 default-animate not-animated"><?php tsf('sub_section_text'); ?></div>
							</div>
						
						<?php endwhile; ?>
					</div>
				</div>

			<?php elseif( get_row_layout() == 'half_image_section_one' ): ?>

				<div class="half-image-section-one-wrap">

					<?php backgroundsub('half_image_one_background', '.half-image-section-one-content-inner'); ?>

					<div class="cf half-image-section-one-content-inner">
						<div class="half-image-one-left-wrap">
							<div class="half-image-one-hidden"><?php acf_sub_image('half_image_one_hidden'); ?></div>
						</div>
						<div class="half-image-one-right-wrap">
							<div class="right-content">
								<h3 class="half-image-one-header medium-title default-animate not-animated"><?php tsf('half_image_one_header'); ?></h3>

								<div class="half-image-one-logo-wrap">
									<?php while(have_rows('half_image_one_repeater')): the_row(); ?>
										<div class="half-image-one-logo default-animate not-animated"><?php acf_sub_image('half_image_one_logo'); ?></div>
										<div class="half-image-one-text small-title default-animate not-animated"><?php tsf('half_image_one_text'); ?></div>
									
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php elseif( get_row_layout() == 'half_image_section_two' ): ?>

				<div class="half-image-section-two-wrap">
				  <div class="test">
					<?php backgroundsub('half_image_two_background_one', '.half-image-section-one-content-inner'); ?>

					<div class="cf half-image-section-two-content-inner background-image-one">

						<?php backgroundsub('half_image_two_background_two', '.background-image-two'); ?>

						<div class="background-image-two">

							<?php backgroundsub('half_image_two_background_three', '.background-image-three'); ?>

							<div class="background-image-three">
								<div class="half-image-two-left-wrap">
									<div class="left-content">
										<h3 class="half-image-two-header medium-title default-animate not-animated"><?php tsf('half_image_two_header'); ?></h3>
										<div class="half-image-two-text smallest-title default-animate not-animated"><?php tsf('half_image_two_text'); ?></div>
									</div>
								</div>
								<div class="half-image-two-right-wrap">
									<div class="test">
										<div class="half-image-two"><?php acf_sub_image('half_image_two_background_one'); ?></div>
										<div class="half-image-two"><?php acf_sub_image('half_image_two_background_two'); ?></div>
										<div class="half-image-two"><?php acf_sub_image('half_image_two_background_three'); ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				  </div>	
				</div>

		    <?php elseif( get_row_layout() == 'down_arrow_section' ): ?>

		    	<div class="down-arrow-section-wrap">

					<?php backgroundsub('down_arrow_background_image', '.down-arrow-content-inner'); ?>

		    		<div class="cf down-arrow-content-inner">
		    			<div class="down-header-wrap">
		    				<h2 class="down-arrow-header bigger-title default-animate not-animated"><?php tsf('down_arrow_header'); ?></h2>
		    			</div>
		    			<div class="down-text-wrap">
		    				<div class="down-arrow-text white small-title default-animate not-animated"><?php tsf('down_arrow_text'); ?></div>
		    			</div>
		    		</div>
		    	</div>

			<?php elseif( get_row_layout() == 'info_section' ): ?>

				<div class="info-section-wrap">
					<div class="cf info-section-content-inner">

						<?php $i = 1; ?>

						<?php while(have_rows('info_repeater')): the_row(); ?>
						
							<div class="cf info-content-inner">
								<div class="info-left-wrap info-left-wrap-<?php echo $i; ?>">
									<div class="info-image"><?php acf_sub_image('info_image'); ?></div>
								</div>
								<div class="info-right-wrap info-right-wrap-<?php echo $i; ?>">
									<div class="info-right">
										<h4 class="info-header h3 default-animate not-animated"><?php tsf('info_header'); ?></h4>
										<div class="info-text default-animate not-animated"><?php tsf('info_text'); ?></div>
									</div>
								</div>
							</div>

							<?php $i++; ?>

						<?php endwhile; ?>
					</div>
				</div>

			<?php elseif( get_row_layout() == 'circle_video_section' ): ?>
			
			<div class="circle-video-wrap">
				<div class="cf circle-video-content-inner">
					<h4 class="circle-video-header medium-title default-animate not-animated"><?php tsf('circle_video_header'); ?></h4>
					<div class="circle-inner-wrap">
						<div class="video-outer-wrap">
							<video id="video-wrap-circle" class="video-wrap-circle" muted="mute" preload="auto" loop autoplay> 
					            <source src="<?php tf('background_video'); ?>" type="video/mp4">
					        </video>
						</div>

						<div class="circle-video-text default-animate not-animated white small-title"><?php tsf('circle_video_text'); ?></div>
						<div class="circle-video-bottom-text default-animate not-animated smaller-title"><?php tsf('circle_video_bottom_text'); ?></div>
					</div>
				</div>
			</div>	

			<?php elseif( get_row_layout() == 'products_section' ): ?>

				<div class="products-section-wrap">
					<div class="cf products-section-content-inner">

						<div class="cf products-top-wrap">
							<div class="products-header-wrap">
								<h3 class="products-header medium-title default-animate not-animated"><?php tsf('products_header'); ?></h3>
								<h3 class="products-sub-text smaller-title default-animate not-animated"><?php tsf('products_sub_text'); ?></h3>
							</div>
							<div class="products-image-wrap">
								<div class="test-two">
								  <div id="products-top-image" class="products-top-image"><?php acf_sub_image('products_top_image'); ?></div>
								  <div id="products-top-image" class="products-top-image"><?php acf_sub_image('products_top_image_two'); ?></div>
								  <div id="products-top-image" class="products-top-image"><?php acf_sub_image('products_top_image_three'); ?></div>
								</div>
							</div>
						</div>

						<div class="cf products-outer-wrap">
							<?php while(have_rows('products_repeater')): the_row(); ?>
							
								<div class="products-inner-wrap">
									<div class="products-image default-animate not-animated"><?php acf_sub_image('products_image'); ?></div>
									<div class="products-arrow default-animate not-animated"><?php acf_sub_image('products_arrow'); ?></div>
									<div class="products-image-text smallest-title default-animate not-animated"><?php tsf('products_image_text'); ?></div>
								</div>

							<?php endwhile; ?>
						</div>
					</div>
				</div>

			<?php elseif( get_row_layout() == 'cta_section' ): ?>
			
				    <div class="cta-section-wrap">

						<?php backgroundsub('cta_background_image', '.cta-section-content-inner'); ?>

				    	<div class="cf cta-section-content-inner">
				    		<div class="cta-inner-inner">
				    			<div class="cta-left-wrap">
									<div class="cta-left-inner default-animate not-animated">
										<h3 class="cta-header smaller-medium-title white"><?php tsf('cta_header'); ?></h3>
										<div class="cta-sub-header h4 white"><?php tsf('cta_sub_header'); ?></div>
										<div class="cta-email-wrap">
											<?php echo do_shortcode(get_field('modal_shortcode')); ?>
										</div>
										<div class="cta-bottom-text white"><?php tsf('cta_bottom_text'); ?></div>
									</div>
				    			</div>
				    			<div class="cta-hidden-wrap">
				    				<div class="cta-hidden-image"><?php acf_sub_image('cta_hidden_image'); ?></div>
				    			</div>
				    		</div>
				    	</div>
				    </div>	

	    <?php else : ?>

	    <?php endif; ?>

	   <?php endwhile; ?>

	<?php else : ?>

	<?php endif; ?>

</div>

<?php get_template_part('inc/exit-intent-modal'); ?>

<?php get_footer(); ?>
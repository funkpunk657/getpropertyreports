<?php 
/*
Template Name: Woo
*/
?>
<?php get_header(); ?>

	<div id="content" class="mw-1100 default-page woo-page-template-content mb2">

		<div id="inner-content" class="cf clearfix">

				<div class="p1 cf woo-steps <?php if (is_page('Checkout')): ?> woo-steps--checkout <?php endif; ?>">
					<div class="woo-svg-step-wrap not-animated">
						<svg version="1.1" class="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="640px" height="35.974px" viewBox="0 0 640 35.974" enable-background="new 0 0 640 35.974" xml:space="preserve">
							<rect x="14" y="16.487" fill="#EBEBEB" width="612" height="3"/>			
								<rect class="woo-animate-bar" x="14" y="16.487" fill="#6B1242" width="<?php 
									// if (is_cart()):
									// 	echo "154";
									if (is_wc_endpoint_url( 'order-received' )):
										echo "612";
									elseif (is_checkout()):
										echo "471";
									else: 
										echo "154";
									endif;
								?>" height="3"/>
							<circle fill="#6B1242" stroke="#6B1242" stroke-width="2" stroke-miterlimit="10" cx="16" cy="17.987" r="6"/>
							<circle fill="<?php if (is_page('Checkout')): ?>#6B1242<?php else: ?>#EBEBEB<?php endif; ?>" stroke="#6B1242" stroke-width="2" stroke-miterlimit="10" cx="320" cy="17.987" r="6"/>
							<circle fill="<?php if (is_wc_endpoint_url( 'order-received' )): ?>#6B1242<?php else: ?>#EBEBEB<?php endif; ?>" stroke="#6B1242" stroke-width="2" stroke-miterlimit="10" cx="624" cy="17.987" r="6"/>
						</svg>
					</div>
					<div class="cf woo-step-inner">
						<div class="woo-step woo-step--done"><p>Cart</p></div>
						<div class="woo-step <?php if (is_page('Checkout')): echo 'woo-step--done'; endif; ?>"><p>Checkout</p></div>
						<div class="woo-step <?php if (is_wc_endpoint_url( 'order-received' )): echo 'woo-step--done'; endif; ?>"><p>Reciept</p></div>
					</div>
				</div>

				<div class="cf">
					<div id="main" class="eightcol first clearfix normal-page" role="main">
					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
							<section class="entry-content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
							</section>					
					
						</article> <?php // end article ?>
					
						<?php endwhile; else : include 'inc/404.php'; endif; ?>
					
					</div> <?php // end #main ?>
					<div class="fourcol last sticky" id="sticky">
						<div class="woo-sidebar ">
							<div class="woo-sidebar-inner">
								<p class="woo-top-contact"><?php tf('top_text'); ?></p>
								<?php $phone = get_field('phone'); ?>
								<?php if (!empty($phone)): ?>
									<?php
									    $phone = preg_replace('/\D+/', '', $phone);
									?>
									<p class="phone"><span class="bold">Phone:</span> <a href="tel:<?php echo $phone; ?>"><?php tf('phone') ?></a></p>
								<?php endif; ?>
								<?php $email = get_field('email'); ?>
								<?php if (!empty($email)): ?>
									<p class="email"><span class="bold">Email:</span> <a href="mailto:<?php echo $email; ?>"><?php tf('email') ?></a></p>
								<?php endif; ?>
								<p class="woo-payment-info"><a href="#pay-info" class="open-popup-link white tdu"><?php tf('payment_info_link'); ?></a></p>
								<?php svg_embed('ssl_image', 'woo-ssl-svg'); ?>
								<div class="woo-ssl-text"><?php tf('ssl_text'); ?></div>
								<?php svg_embed('credit_cards', 'woo-cc-svg'); ?>
							</div>
						</div>
					</div>
				</div>
		</div> <?php // end #inner-content ?>

	</div> <?php // end #content ?>
	<div id="pay-info" class="white-popup mfp-hide">
		<div class="p1">
			<div class="mw-710 normal-page"><?php tf('payment_info'); ?></div>
		</div>
	</div>

<?php get_footer(); ?>

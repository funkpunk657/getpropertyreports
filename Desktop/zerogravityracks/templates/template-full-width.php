<?php 
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

	<div id="content" class="mw-710">

		<div id="inner-content" class="wrap clearfix">

				<div id="main" class="clearfix normal-page" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header">
							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						</header> <?php // end article header ?>

						<section class="entry-content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
						</section> <?php // end article section ?>

						<footer class="article-footer">

						</footer> <?php // end article footer ?>


					</article> <?php // end article ?>

					<?php endwhile; else : include 'inc/404.php'; endif; ?>

				</div> <?php // end #main ?>

		</div> <?php // end #inner-content ?>

	</div> <?php // end #content ?>

<?php get_footer(); ?>

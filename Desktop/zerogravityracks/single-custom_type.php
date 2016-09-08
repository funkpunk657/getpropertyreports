<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="clearfix">

	

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" class="cf mw-710 normal-page single-article-content"  role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<?php get_template_part('inc/article-header'); ?>
				
				<section class="entry-content clearfix" itemprop="articleBody">
					<?php the_content(); ?>
				</section> <?php // end article section ?>
				
				<?php get_template_part('inc/article-footer'); ?>
						
				<?php comments_template(); ?>
				
				<?php get_sidebar(); ?>
			</article> <?php // end article ?>

		<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part('inc/404'); ?>

		<?php endif; ?>

	
	</div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>

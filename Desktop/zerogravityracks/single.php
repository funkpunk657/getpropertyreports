<?php get_header(); ?>

<div id="content" class="">

	<div id="inner-content" class="cf single-article">

	

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" class="cf mw-710 single-article-content" role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<?php get_template_part('inc/blog/article-header'); ?>
				
				<section class="entry-content clearfix normal-page 
				" itemprop="articleBody">
					<?php the_content(); ?>
				</section> <?php // end article section ?>
			
				<?php get_template_part('inc/blog/article-footer'); ?>
				
			</article> <?php // end article ?>
			
			<?php get_template_part('inc/blog/article-more-posts'); ?>

			<div class="single-article-comments" id="single-article-comments"><?php comments_template(); ?></div>
			
		<?php 
		endwhile; 
		else :
			get_template_part('inc/404');
		endif; ?>

	</div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>

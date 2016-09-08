<?php get_header(); ?>

	<div id="content">
		<div class="from-m-down p1"><?php get_search_form(); ?></div>
		<div id="inner-content" class="wrap clearfix p1">

			<div id="main" class="eightcol first clearfix" role="main">
				<h1 class="pt05 m0"><span><?php _e( 'Search Results for:', 'launchtheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

				<?php if (have_posts()) : while (have_posts()) : the_post();

					get_template_part('inc/blog/blog-article-layout');

				endwhile; else : get_template_part('inc/404'); endif; ?>


				</div> <?php // end #main ?>

					<?php get_sidebar(); ?>

			</div> <?php // end #inner-content ?>

	</div> <?php // end #content ?>

<?php get_footer(); ?>

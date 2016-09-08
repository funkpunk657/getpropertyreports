<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<h1 class="archive-title h2"><span><?php _e( 'Posts Categorized:', 'launchtheme' ); ?></span> <?php single_cat_title(); ?></h1>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'launchtheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'launchtheme' )), launch_get_the_author_posts_link(), get_the_term_list( get_the_ID(), 'custom_cat', "" ) );
									?></p>

								</header> <?php // end article header ?>

								<section class="entry-content">
									<?php the_excerpt( '<span class="read-more">' . __( 'Read More &raquo;', 'launchtheme' ) . '</span>' ); ?>

								</section> <?php // end article section ?>

								<footer class="article-footer">

								</footer> <?php // end article footer ?>

							</article> <?php // end article ?>

							<?php endwhile; ?>

									<?php if ( function_exists( 'launch_page_navi' ) ) { ?>
											<?php launch_page_navi(); ?>
									<?php } else { ?>
											<nav class="wp-prev-next">
													<ul class="clearfix">
														<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'launchtheme' )) ?></li>
														<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'launchtheme' )) ?></li>
													</ul>
											</nav>
									<?php } ?>

							<?php else : ?>

									<?php get_template_part('inc/404'); ?>

							<?php endif; ?>

						</div> <?php // end #main ?>

						<?php get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>

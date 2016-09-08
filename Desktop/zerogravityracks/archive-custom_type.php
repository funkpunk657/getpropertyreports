<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

						<h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'launchtheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'launchtheme' ) ), launch_get_the_author_posts_link());
									?></p>

								</header> <?php // end article header ?>

								<section class="entry-content clearfix">

									<?php the_excerpt(); ?>

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

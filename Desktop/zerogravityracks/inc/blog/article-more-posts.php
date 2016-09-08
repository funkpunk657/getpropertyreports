<div class="single-article-more-posts">
	<h1 class="custom_cat-title text-center not-animated default-animate">Trending Articles</h1>
	<?php 
		$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => array($post->ID), 'orderby' => 'rand' );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
	?>

		<?php global $post; ?>
		<?php $terms = get_the_terms($post->ID, 'custom_cat' ); ?>
		
		<?php get_template_part('inc/blog/blog-article-layout'); ?>

	<?php endwhile; ?>
</div>
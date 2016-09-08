<?php if (is_category()): ?>
	<h1 class="archive-title mt0">
		<span><?php _e( 'Category:', 'launchtheme' ); ?></span> <?php single_cat_title(); ?>
	</h1>
<?php elseif (is_tag()): ?>
	<h1 class="archive-title mt0">
		<span><?php _e( 'Tag:', 'launchtheme' ); ?></span> <?php single_tag_title(); ?>
	</h1>
<?php elseif (is_author()):
	global $post;
	$author_id = $post->post_author;
?>
	<h1 class="archive-title mt0">
		<span><?php _e( 'Author:', 'launchtheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>
	</h1>
<?php elseif (is_day()): ?>
	<h1 class="archive-title mt0">
		<span><?php _e( 'Archives:', 'launchtheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
	</h1>
<?php elseif (is_month()): ?>
		<h1 class="archive-title mt0">
			<span><?php _e( 'Archives:', 'launchtheme' ); ?></span> <?php the_time('F Y'); ?>
		</h1>
<?php elseif (is_year()): ?>
		<h1 class="archive-title mt0">
			<span><?php _e( 'Archives:', 'launchtheme' ); ?></span> <?php the_time('Y'); ?>
		</h1>
<?php elseif (!empty($search)): ?>
		<h1 class="archive-title lh text-center">
			<span><?php _e( 'Search Results for:', 'launchtheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?>
		</h1>
<?php endif; ?>


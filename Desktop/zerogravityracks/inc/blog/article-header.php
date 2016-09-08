<header class="article-header">
	<div class="article-category <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
		<?php printf( __( '<span class="vact">%1$s</span>', 'launchtheme' ), get_the_category_list(', ')); ?> 
	</div>
	<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
	<div class="cf byline vcard">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
		<?php printf( __( '<div class="cf article-info-wrapper"><div class="vact-t-a"><span class="single-by">by</span> <span class="author">%3$s</span> | <time class="updated" datetime="%1$s" pubdate>%2$s</time> </div> </div> ', 'launchtheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), launch_get_the_author_posts_link()); ?> 
	</div> 
</header> <?php // end article header ?>
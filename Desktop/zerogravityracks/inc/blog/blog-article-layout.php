<article id="post-<?php the_ID(); ?>" class="cf article normal-article" role="article">
				
	<div class="article-image-wrap fourcol first">
		<?php
		if ( has_post_thumbnail() ):
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'launch-thumb', true);
		?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url[0]; ?>" alt="<?php the_title(); ?>"></a>
		<?php else: ?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/library/images/default-thumb.jpg" alt="<?php the_title(); ?>"></a>
		<?php endif; ?>
	</div>
	

	<div class="article-content-wrap eightcol last">
		<header class="article-header cf">
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		</header> <?php // end article header ?>
		
		
		<section class="article-excerpt">
			<?php custom_excerpt(170); ?>
		</section>
		
		
		<footer class="cf article-footer">
			<div class="post-info">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 86 ); ?>
				<div class="vact-t-a">
					<span class="author">
						<span class="single-by">by</span>
						<?php the_author_posts_link(); ?>
					</span> 
					<?php $date = the_time(get_option('date_format')); ?>
					<time class="updated" datetime="<?php echo $date; ?>" pubdate><?php echo $date; ?></time> 
				</div>
			</div>
			
				<a href="<?php the_permalink(); ?>" class="button button-smaller mt05">Read More</a>
			
		</footer> <?php // end article footer ?>
	</div>
</article> <?php // end article ?>
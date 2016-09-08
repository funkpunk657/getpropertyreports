<?php get_header(); ?>
<?php $search = get_search_query(); ?>
<?php

	if (is_category()):
		$cat = get_category( get_query_var( 'cat' ) );
		$cat_id = $cat->cat_ID;
		$cat_name = $cat->name;
		$cat_slug = $cat->slug;
	elseif (is_search()):
		$search = get_search_query();

	elseif (is_author()):
		$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
		$author = $curauth->ID;

	elseif(is_date()):
		$year = get_the_date('Y');
		$month = get_the_date('m');
		$day = get_the_date('d');
	endif; 
?>

<header class="article-header">
	<?php $img = get_field('blog_top_image', 'options'); ?>
	<div class="static-hero" style="background-image: url('<?php echo $img['url']; ?>');">
		<h1 class="bigger-title static-center-headline load-not-animated default-animate"><?php the_field('blog_title', 'options'); ?></h1>
	</div>
</header> <?php // end blog header ?>
<div id="content" class="blog-wrapper cf p1 wrap-1140">
	<div class="from-m-down p1"><?php get_search_form(); ?></div>
	<div id="main" class="clearfix article-side eightcol first" role="main">
		<?php get_template_part('inc/blog/conditional-titles'); ?>

		<?php if (have_posts()) : ?>
		<?php 
			if (is_date()){
				$args = array(
					'posts_per_page' => 3, 
					'year' => $year,
					'monthnum' => $month, 
				);
			} elseif (is_archive() && !is_author()){
				$args = array(
					'posts_per_page' => 3, 
					'category_name' => $cat_slug 
				);
			} elseif (is_search()){
				$args = array(
					'posts_per_page' => 3, 
					's' => $search 
				);
			} elseif (is_author()){
				$args = array(
					'posts_per_page' => 3, 
					'author' => $author 
				);
			} else {
				$args = array(
					'posts_per_page' => 3 
				);
			}
				
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			
				include 'inc/blog/blog-article-layout.php';

			endwhile; ?>
		
		<?php if (is_search()) {
			$search = get_search_query();
		} ?>

		<?php echo do_shortcode('[ajax_load_more 
		post_type="post" 
		scroll="false" 
		button_launch="Load More" 
		posts_per_page="3" 
		offset="3" 
		year="'. (is_date() ? $year : "") .'" 
		month="'. (is_date() ? $month : "") .'" 
		category="'. (is_category() ? $cat_slug : "") .'" 
		author="'. (is_author() ? $author : "") .'" 
		search="'. (is_search() ? $search : "") .'"]'); ?>


		<?php else : get_template_part('inc/404'); endif; ?>

	</div> <?php // end #main ?>

	<?php get_sidebar(); ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>

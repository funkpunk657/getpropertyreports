<?php $img = get_field('404_background_image', 'options'); ?>
<article id="post-not-found" class="post-not-found hentry text-center" style="background-image: url('<?php echo $img['url']; ?>');">
	<div class="post-not-found-inner">
		<header class="article-header smaller-title">
				<h1><?php the_field('404_headline', 'options'); ?></h1>
		</header>
			<section class="entry-content">
				<p><?php the_field('404_content', 'options'); ?></p>
		</section>
		<footer class="article-footer">
				<a href="<?php bloginfo('url'); ?>" class="button bigger error-button">Home</a>
		</footer>
	</div>
</article>

<script>
jQuery(document).ready(function($) {
	function heighter () {
		var height = $(window).height();
		$('#post-not-found').css('min-height', height + 'px');
	}
	heighter();
	$( window ).resize(function() {
	    heighter();
	});

});
</script>
<?php
/*
Template Name: Share Form
*/
?>
<?php get_header(); ?>

<a href="<?php echo bloginfo('url'); ?>" class="">
	<?php $img = get_field('logo_color', 'options'); ?>
	<img src="<?php echo $img['url']; ?>" class="ma p1">
</a>

<?php $img = get_field('image') ?>
<div id="page-bg" class="bgi form-content-wrap" style="background-image: url('<?php // echo $img['url']; ?>');">
	<div class="cf mw-1040">
		<div class="sixcol last side-image matcher from-m-up">
			<img src="<?php echo $img['url']; ?>">
		</div>
		<div class="sixcol first form-content-inner matcher">
			<div class="normal-page"><?php the_content(); ?></div>
			<div class="from-m-down"><img src="<?php echo $img['url']; ?>"></div>
			<?php $shorcode = get_field('form_shortcode') ?>
			<div class=""><?php echo do_shortcode($shorcode); ?></div>
		</div>

	</div>
</div>


<script>
jQuery(document).ready(function($) {
	function heighter () {
		var height = $(window).height();
		var footer = 0;
		var height2 = height - footer;
		$('.form-content-wrap').css('min-height', height2 + 'px');
	}
	heighter();

	$( window ).resize(function() {
	    heighter();
	});

});
</script>

<!-- Facebook Conversion Code for Post Pledge Email Click -->
<?php the_field('conversion_pixel'); ?>
<?php get_footer(); ?>

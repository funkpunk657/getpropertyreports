<head>
	<meta charset="utf-8">

	<?php // Google Chrome Frame for IE ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title(''); ?></title>
	
	<?php tfo('opening_header_code'); ?>

	<?php // mobile meta (hooray!) ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script>
	 var kit = 'tii5aec';
	 if( window.innerWidth < 800 ) {
	   document.write('\x3Cscript src="//use.typekit.net/'+ kit +'.js" onload="try{Typekit.load();}catch(e){}" async>\x3C/script>');
	 } else {
	   document.write('\x3Cscript src="//use.typekit.net/'+ kit +'.js">\x3C/script>');
	   document.write('\x3Cscript>try{Typekit.load();}catch(e){}\x3C/script>');
	 };

	</script>

	<?php get_template_part('inc/favicon'); ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/ouibounce/0.0.11/ouibounce.min.js"></script>

	<script type='text/javascript'>
	(function (d, t) {
	  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
	  bh.type = 'text/javascript';
	  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=hcem1sckmornauowphbfmg';
	  s.parentNode.insertBefore(bh, s);
	  })(document, 'script');
	</script>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>
	<?php tfo('closing_header_code'); ?>
</head>
<footer class="article-footer">
	
	<div class="cf share-article">
		<a class="share-button share-button-tw" href="#" target="_blank">Tweet</a>
		<a class="share-button share-button-fb" href="#" target="_blank">Share</a>
		<a href="#single-article-comments" class="roller comment-count">Comments</a>
	</div>

	<div id="author-area" class="cf author-area">
		<div class="threecol first"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 200 ); ?></div>
		
		<?php $user_id = get_the_author_meta('ID'); ?>
		<?php $author = get_the_author(); ?>
		
		<div class="ninecol last author-description">
			<h3><a class="author-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>" rel="author"><?php echo $author; ?></a></h3>
			<p><?php the_author_meta( 'description' ); ?></p>
		</div>
	</div>
<script>
	jQuery(document).ready(function($) {
		$(function() {
		    $('.share-button-fb').on('click', function() {
		        var w = 580, h = 300,
		                left = (screen.width/2)-(w/2),
		                top = (screen.height/2)-(h/2);
		            
		            if ((screen.width < 480) || (screen.height < 480)) {
		                window.open ('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		            } else {
		                window.open ('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);   
		            }
		    });
		    $('.share-button-tw').on('click', function() {
		        var loc = encodeURIComponent('<?php the_permalink(); ?>'),
		                title = "<?php the_title(); ?>",
		                w = 580, h = 300,
		                left = (screen.width/2)-(w/2),
		                top = (screen.height/2)-(h/2);
		                
		            window.open('http://twitter.com/share?text=' + title + '&url=' + loc, '', 'height=' + h + ', width=' + w + ', top='+top +', left='+ left +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
		    });
		});
	});

</script>
</footer><?php // end article footer ?>
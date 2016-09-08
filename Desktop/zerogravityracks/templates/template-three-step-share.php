<?php 
/*
Template Name: Three Step Share
*/
?>
<?php get_header(); ?>

<h1><?php the_field('headline') ?></h1>
<div id="container" class="pb1">
    <?php $img = get_field('image'); ?>
    <?php if (!empty($img)): ?>
        <div id="img-ya" style="background-image: url('<?php echo $img['url']; ?>');" class="bgi"></div>
    <?php endif; ?>
    <div id="welcome">
    <?php 
	    if (have_posts()) : while (have_posts()) : the_post(); 
	         the_content(); 
	    endwhile; else : endif; 
    ?>
    </div>
    <div id="progress">
        <div class="percent">
            <div class="number">0%</div>
        </div>
    </div>
    <ul id="actions">
        <?php while (have_rows('sections')): the_row(); ?>
            <li>
                <h2 class="bold"><?php the_sub_field('title'); ?></h2>
                <p><?php the_sub_field('text'); ?></p>
                <button class="<?php the_sub_field('button_text'); ?>"><?php the_sub_field('button_class'); ?></button>
            </li>
        <?php endwhile; ?>
    </ul>
</div>		
<script>
    jQuery(document).ready(function($) {
        $(function() {
            var clicks = 0;
            $('button').on('click', function() {
                clicks++;
                var percent = Math.min(Math.round(clicks / 3 * 100), 100);
                $('.percent').width(percent + '%');
                $('.number').text(percent + '%');
            });
            
            
            $('.facebook').on('click', function() {
                var w = 580, h = 300,
                        left = (screen.width/2)-(w/2),
                        top = (screen.height/2)-(h/2);
                    
                    
                    if ((screen.width < 480) || (screen.height < 480)) {
                        window.open ('http://www.facebook.com/share.php?u=<?php the_field('fb_share_link'); ?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
                    } else {
                        window.open ('http://www.facebook.com/share.php?u=<?php the_field('fb_share_link'); ?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);   
                    }
            });
            
            $('.twitter').on('click', function() {
                var loc = encodeURIComponent('<?php the_field('tw_share_link'); ?>'),
                        title = "<?php the_field('tw_share_text'); ?>",
                        w = 580, h = 300,
                        left = (screen.width/2)-(w/2),
                        top = (screen.height/2)-(h/2);
                        
                    window.open('http://twitter.com/share?text=' + title + '&url=' + loc, '', 'height=' + h + ', width=' + w + ', top='+top +', left='+ left +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
            });
            
            $('.play').on('click', function() {
                window.location.href = "<?php the_field('play_url'); ?>";
            });
            
        });
    });
</script>

<?php get_footer(); ?>

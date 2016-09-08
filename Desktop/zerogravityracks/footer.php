<footer class="footer" id="footer" role="contentinfo">

    <div class="cf inner-footer p1">
        <div class="fourcol first">
            <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a>.</p>
        </div>
        
        <div class="fourcol last">
            <ul class="sm-links">
                <?php while (have_rows('social_media', 'options')): the_row(); ?>
                    <li>
                        <a href="<?php tsf('link') ?>" target="_blank"><?php svg_sub_embed('image', 'sm-svg') ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>    

</footer>
            </div> <?php //end #container ?>
                <?php wp_footer(); ?>
        </div> <?php //end .page-wrap ?>
<?php tfo('closing_body_code'); ?>
    </body>
</html> <?php // end page. what a ride! ?>
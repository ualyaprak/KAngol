<footer id="footer" class="clearfix">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widget-area') ) : else : ?>
        <?php endif; ?>
  
</footer>
</div>
	<!-- analytics -->
	<?php wp_footer(); ?>
    <script src="<?php bloginfo('template_directory'); ?>/scripts/custom.js"></script>
</body>
</html>

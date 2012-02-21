<?php
/*

Template Name: Static  

*/
?>
<?php get_header(); ?>
	<section id="content" class="clearfix">
	<article class="post clearfix">
	  <section class="<?php if(is_page('friends')) {?>friends<?php } ?><?php if(is_page('distributors')) {?>distributors<?php } ?><?php if(is_page('terms-of-use')) {?>terms<?php } ?><?php if(is_page('privacy-policy')) {?>privacy-policy<?php } ?>">
    <?php if(have_posts()): while( have_posts() ) : the_post(); 

	?>
    <?php the_content(); ?>
	
	<?php endwhile; endif; ?>
      </section>
    </article>
</section>
<?php get_footer(); ?>

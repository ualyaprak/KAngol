<?php
/*

Template Name: Static  

*/
?>
<?php get_header(); ?>
	<section class="body index">
    <?php if(have_posts()): while( have_posts() ) : the_post(); 

	?>
	
    <div><?php the_title(); ?></div>
    
    <?php the_content(); ?>
	
	<?php endwhile; endif; ?>
    
</section>
<?php get_footer(); ?>

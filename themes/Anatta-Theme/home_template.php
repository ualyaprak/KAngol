<?php 
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
	<section class="body index">				
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
		$sliderval1 = get_post_meta($post->ID, 'slider1', true); //getting value for Slider 1
		$sliderval2 = get_post_meta($post->ID, 'slider2', true); //getting value for Slider 2
		?>
        <?php get_slider_option($sliderval1);//function for displaying slider 1 ?>
        
        <?php get_slider_option($sliderval2);//function for displaying slider 2 ?>
		<?php endwhile; endif; ?>
	   
	</section>
<?php get_footer(); ?>

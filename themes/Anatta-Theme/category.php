<?php get_header(); ?>
<section class="body archive">
<?php
$categories=get_the_category(); //get the categories
//print_r($categories);
?>
<?php query_posts('cat='.$categories[0]->term_id.'&showposts=1'); ?>
  <?php if (have_posts()) : ?>
  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>  
  <?php while (have_posts()) : the_post();
  	$image_gal =  get_post_meta($post->ID, 'postimage_gallery', true); //getting value for image gallery for slideshow
	$video_1 =  get_post_meta($post->ID, 'video_post1', true); //getting value for video url 1 for slideshow
	$video_2 =  get_post_meta($post->ID, 'video_post2', true); //getting value for video url 1 for slideshow
	$video_3 =  get_post_meta($post->ID, 'video_post3', true); //getting value for video url 1 for slideshow
	$sliderval1 = get_post_meta($post->ID, 'postslider1', true); //getting value for Slider 1 ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    
    <header>
      <h2><a href="<?php the_permalink() ?>">
        <?php the_title(); ?> 
        </a></h2> 
		<?php the_time('m.d.y'); ?>
    </header>
    <section>
      <?php the_content(); ?>
    </section>
    
  </article>
 <?php endwhile; endif; ?>
 <?php wp_reset_query(); ?>
 <section class="collection clearfix">
		      <section class="actions">
		        <section class="buttons clearfix"><a href="#" class="previous-btn">&nbsp;</a> <a href="#" class="next-btn">&nbsp;</a></section>
		        <h2><?php  echo $sliderval1;?></h2>
		      </section>
		      <br class="clear">
		       <div id="sliderbottom2" class="stepcarousel">
		      <ul class="belt list1 clearfix">
			    <?php  get_slider_option($sliderval1);//function for displaying slider 1 ?>
		      </ul>
		      </div>
		    </section>
             
</section>
<?php get_footer(); ?>

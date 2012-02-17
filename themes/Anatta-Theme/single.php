<?php get_header(); ?>
	<div id="content" class="clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
		$image_gal =  get_post_meta($post->ID, 'postimage_gallery', true); //getting value for image gallery for slideshow
	$video_1 =  get_post_meta($post->ID, 'video_post1', true); //getting value for video url 1 for slideshow
	$video_2 =  get_post_meta($post->ID, 'video_post2', true); //getting value for video url 1 for slideshow
	$video_3 =  get_post_meta($post->ID, 'video_post3', true); //getting value for video url 1 for slideshow
	$sliderval1 = get_post_meta($post->ID, 'postslider1', true); //getting value for Slider 1 
	
	$img_sql = mysql_query("select gid,path from aNaTTa_ngg_gallery where title = '".$image_gal."'");//query for getting gallery id
		$img_obj = mysql_fetch_array($img_sql);
		//echo  $img_obj->gid;
		
		$images_gal = mysql_query("select filename from aNaTTa_ngg_pictures where galleryid = '".$img_obj['gid']."'"); //query for getting gallery images
		while($images_row = mysql_fetch_array($images_gal))
		{
			$images_gallery[] = $images_row['filename'];
		}
		//print_r($images_gallery);
		?>
		<!-- AnythingSlider #1 -->
			<ul id="slider1">
           <?php
		   if(!empty($images_gallery))
		   {
           	foreach($images_gallery as $img_values) 
			{
				$i = 1;
				${'vslide'.$i} = "<img src='".get_bloginfo('home')."/".$img_obj['path']."/".$img_values."' id='fullsizeImage' height='490' width='920' />";
				echo "<li>".${'vslide'.$i}."</li>";
				$i++;
			}
			}	
			 //jwplayer code for the video links
			for($i=1;$i<=3;$i++)
			{
				if(!empty(${'video_'.$i}))
				{
					${'video_url'.$i} = explode('/',${'video_'.$i});
					if(${'video_url'.$i}[2] != '' ){ ${'video_urls'.$i} = ${'video_'.$i}; }	else { if(${'video_'.$i} != '' ) {  ${'video_urls'.$i} = "http://content.bitsontherun.com/videos/".${'video_'.$i}.".mp4";} }
				
					if(${'video_url'.$i}[2] != '' ){ ${'video_img'.$i} = ""; }	else { if(${'video_'.$i} != '' ) {  ${'video_img'.$i} = "http://content.bitsontherun.com/thumbs/".${'video_'.$i}.".jpg";} }
					
					 ${'vslide'.$i} = "<div id='mediaplayer".$i."'></div>
					 <script type='text/javascript'>
						jQuery(document).ready(function($) {  
								var w_height = 490;
								var w_width = 920;
								
								jwplayer('mediaplayer".$i."').setup({
								'id': 'playerID',
								'width': w_width,
								'height': w_height,
								'controlbar.idlehide': 'true',
								'autostart': false,
								'skin': '".get_option('home')."/wp-content/themes/Anatta-Theme/jwplayer/skins/glow.zip',
								 'file': '".${'video_urls'.$i}."',
								 'image': '".${'video_img'.$i}."',
								 'modes': [
									{type: 'flash', src: '".get_option('home')."/wp-content/themes/Anatta-Theme/jwplayer/player.swf'},
									{
									  type: 'html5',
									  config: {
									   'file': '".${'video_urls'.$i}."',
									   'provider': 'video'
									  }
									},
									{
									  type: 'download',
									  config: {
									   'file': '".${'video_urls'.$i}."',
									   'provider': 'video'
									  }
									}
								]
							  });
								
					 
							 });
							 //]]>
						
						</script>";
						echo "<li>".${'vslide'.$i}."</li>";
					}
				}
				?>
            

			</ul>  
		
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
    <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style share" addthis:url="<?php echo get_permalink(); ?>" addthis:title="<?php echo get_the_title($post->ID); ?>">
        <a class="addthis_counter addthis_pill_style count"></a>
        </div>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f2fd41b73a803c0"></script>
        <!-- AddThis Button END -->
  </article>
 

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
		<?php endwhile; endif; ?>
	</div>
<?php get_footer(); ?>

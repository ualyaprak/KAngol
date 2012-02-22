<?php 
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
	<div id="content" class="clearfix">				
		<?php if (have_posts()) : while (have_posts()) : the_post();
		$image_gal =  get_post_meta($post->ID, 'image_gallery', true); //getting value for image gallery for slideshow
		$video_1 =  get_post_meta($post->ID, 'video_slideshow1', true); //getting value for video url 1 for slideshow
		$video_2 =  get_post_meta($post->ID, 'video_slideshow2', true); //getting value for video url 1 for slideshow
		$video_3 =  get_post_meta($post->ID, 'video_slideshow3', true); //getting value for video url 1 for slideshow
		$sliderval1 = get_post_meta($post->ID, 'slider1', true); //getting value for Slider 1
		$sliderval2 = get_post_meta($post->ID, 'slider2', true); //getting value for Slider 2
		
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
           	foreach($images_gallery as $img_values) 
			{
				$i = 1;
				${'vslide'.$i} = "<img src='".get_bloginfo('home')."/".$img_obj['path']."/".$img_values."' id='fullsizeImage' height='490' width='920' />";
				echo "<li>".${'vslide'.$i}."</li>";
				$i++;
			}
				
			 //jwplayer code for the video links
			for($i=1;$i<=3;$i++)
			{
				if(!empty(${'video_'.$i}))
				{
					${'video_url'.$i} = explode('/',${'video_'.$i});
					if(${'video_url'.$i}[2] != '' ){ ${'video_urls'.$i} = ${'video_'.$i}; }	else { if(${'video_'.$i} != '' ) {  ${'video_urls'.$i} = "http://content.bitsontherun.com/videos/".${'video_'.$i}.".mp4";} }
				
					if(${'video_url'.$i}[2] != '' ){ ${'video_img'.$i} = ""; }	else { if(${'video_'.$i} != '' ) {  ${'video_img'.$i} = "http://content.bitsontherun.com/thumbs/".${'video_'.$i}.".jpg";} }
					$images_count[] = ${'video_'.$i};
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
	

			

		<section class="collection clearfix">
		      <section class="actions">
		        <section class="buttons-dynamic clearfix"><a href="#">&nbsp;</a> <a href="#">&nbsp;</a></section>
		        <h2><?php echo $sliderval1; ?></h2>
		      </section>
		      <br class="clear">
		       <div id="sliderbottom2" class="stepcarousel">
		      <ul class="belt list1 clearfix">
			    <?php get_slider_option($sliderval1);//function for displaying slider 1 ?>
		      </ul>
		      </div>
		    </section>
		    
		    <section class="blog clearfix">
		          <section class="actions">
		            <section class="buttons-dynamic clearfix"><a href="#">&nbsp;</a> <a href="#">&nbsp;</a></section>		            <h2><?php echo $sliderval2; ?></h2>
		          </section>
		          <br class="clear">
		          <div id="sliderbottom" class="stepcarousel">
		          <ul class="belt list1 clearfix">
		          <?php get_slider_option($sliderval2);//function for displaying slider 2 ?>

		          </ul>
		          </div>  		          
		        </section>
		        
		      
    
        
        
		<?php endwhile; endif; ?>
	   
	</div>
<?php get_footer(); ?>

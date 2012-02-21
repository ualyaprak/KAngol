<?php get_header(); ?>
<script>
stepcarousel.setup({
		galleryid: 'sliderbottom3', //id of carousel DIV
		beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
		panelclass: 'panel', //class of panel DIVs each holding content
		autostep: {enable:false, moveby:3, pause:3000},
		panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},
		defaultbuttons: {enable: true, moveby: 1, leftnav: ['http://i34.tinypic.com/317e0s5.gif', 842, -42], rightnav: ['http://i38.tinypic.com/33o7di8.gif', -45, -42]},
		statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
		contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
	})
</script>
	<div id="content" class="clearfix inner-pages">				
		<?php if (have_posts()) : while (have_posts()) : the_post();
		$cat = get_the_category();
		$category_id = $cat[0]->term_id;
		$image_gal =  get_post_meta($post->ID, 'postimage_gallery', true); //getting value for image gallery for slideshow
		$video_1 =  get_post_meta($post->ID, 'video_post1', true); //getting value for video url 1 for slideshow
		$video_2 =  get_post_meta($post->ID, 'video_post2', true); //getting value for video url 1 for slideshow
		$video_3 =  get_post_meta($post->ID, 'video_post3', true); //getting value for video url 1 for slideshow
		$sliderval1 = get_post_meta($post->ID, 'postslider1', true); //getting value for Slider 1
				
		$img_sql = mysql_query("select gid,path from aNaTTa_ngg_gallery where title = '".$image_gal."'");//query for getting gallery id
		$img_obj = mysql_fetch_array($img_sql);
		//echo  $img_obj->gid;
		
		$images_gal = mysql_query("select pid, filename , description from aNaTTa_ngg_pictures where galleryid = '".$img_obj['gid']."'"); //query for getting gallery images
		while($images_row = mysql_fetch_array($images_gal))
		{
			$images_gallery[] = $images_row;
			
		}
		//print_r($images_gallery);
		?>
        
        
   
<section class="slideshow">
  <section class="slides">
    <section class="slide">
      
			<!-- AnythingSlider #1 -->
			<ul id="slider2">
           <?php
           	foreach($images_gallery as $img_values) 
			{
				$i = 1;
				//echo $img_values['pid'];
				$img_link = nggcf_get_field($img_values['pid'], 'Image Link');
				if(empty($img_link))
				{
					${'vslide'.$i} = "<img src='".get_bloginfo('home')."/".$img_obj['path']."/".$img_values['filename']."' id='fullsizeImage' height='490' width='920' />";
				}
				else
				{
					${'vslide'.$i} = "<a href='".$img_link."' target='_blank'><img src='".get_bloginfo('home')."/".$img_obj['path']."/".$img_values['filename']."' id='fullsizeImage' height='490' width='920' /></a>";
				}
				
				echo "<li><section class='description'><h2>BUY NOW</h2><p>".stripslashes($img_values['description'])."</p></section>".${'vslide'.$i}."</li>";
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
					 ${'vslide'.$i} = "<div id='mediaplayers".$i."'></div>
					 <script type='text/javascript'>
						jQuery(document).ready(function($) {  
								var w_height = 490;
								var w_width = 920;
								
								jwplayer('mediaplayers".$i."').setup({
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
	
		    </section>
		  </section>
		</section>	
			
			
              
              <section class="collection clearfix">
		      <section class="actions">
		        <section class="buttons clearfix"><a href="#" class="previous-btn">&nbsp;</a> <a href="#" class="next-btn">&nbsp;</a></section>
		        <h2><?php echo $cat[0]->name; ?></h2>
		      </section>
		      <br class="clear">
		       <div id="sliderbottom3" class="stepcarousel">
		      <ul class="belt list1 clearfix">
			    <?php get_cat_option($category_id);//function for displaying slider 1 ?>
		      </ul>
		      </div>
		    </section>
		   

  </article> 	

		<section class="collection clearfix">
		      <section class="actions">
		        <section class="buttons clearfix"><a href="#" class="previous-btn">&nbsp;</a> <a href="#" class="next-btn">&nbsp;</a></section>
		        <h2><?php echo $sliderval1; ?></h2>
		      </section>
		      <br class="clear">
		       <div id="sliderbottom" class="stepcarousel">
		      <ul class="belt list1 clearfix">
			    <?php get_slider_option($sliderval1);//function for displaying slider 1 ?>
		      </ul>
		      </div>
		    </section>
		   
        
		<?php endwhile; endif; ?>
	   
	</div>
<?php get_footer(); ?>

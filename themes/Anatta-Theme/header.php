<!DOCTYPE html>
<!--[if lte IE 7]><html class="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 7)|!(IE)]><! --><html <?php language_attributes(); ?>><!-- <![endif]-->
<head>
	<meta charset="utf-8" />
    <title><?php wp_title(''); ?></title>
    <?php wp_head(); ?>

	<!-- http://google.com/webmasters -->
    <meta name="google-site-verification" content="" />

    <!-- don't allow IE9 to render the site in compatibility mode. Dude. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
	<?php //if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
    <link rel="shortcut icon" href="<?php bloginfo('url'); ?>/anatta.jpg" type="image/x-icon" />
    <!--[if lt IE 9]>
    	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta name="viewport" content="width=device-width" />
    <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
    
    
    	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>: Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type='text/javascript' src='<?php bloginfo('template_url');?>/jwplayer/jwplayer.js'></script><!--jwplayer file-->
    <!--Anything Slider-->
	<!-- Demo stuff -->
	<script src="<?php bloginfo('template_directory'); ?>/anythingslider/demos/js/jquery.jatt.min.js"></script>
	<!-- AnythingSlider -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/anythingslider/css/anythingslider.css">
	<script src="<?php bloginfo('template_directory'); ?>/anythingslider/js/jquery.anythingslider.min.js"></script>
	<!-- Ideally, add the stylesheet(s) you are going to use here,
	 otherwise they are loaded and appended to the <head> automatically and will over-ride the IE stylesheet below -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/anythingslider/css/theme-metallic.css">
	<?php if(!is_page('stockists')) { ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/slider.js"></script>
	<?php } ?>
	<script type="text/javascript">
	
	<?php if(!is_home() && !is_front_page()) { ?>
	stepcarousel.setup({
		galleryid: 'sliderbottom', //id of carousel DIV
		beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
		panelclass: 'panel', //class of panel DIVs each holding content
		autostep: {enable:false, moveby:3, pause:3000},
		panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},
		defaultbuttons: {enable: true, moveby: 3, leftnav: ['http://i34.tinypic.com/317e0s5.gif', 842, -42], rightnav: ['http://i38.tinypic.com/33o7di8.gif', -45, -42]},
		statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
		contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
	})
	
	<?php } ?>
<?php if(is_home() || is_front_page()) { ?>
stepcarousel.setup({
	galleryid: 'sliderbottom3', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:false, moveby:3, pause:3000},
	panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},
	defaultbuttons: {enable: true, moveby: 3, leftnav: ['http://i34.tinypic.com/317e0s5.gif', 842, -42], rightnav: ['http://i38.tinypic.com/33o7di8.gif', -45, -42]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
})
	stepcarousel.setup({
		galleryid: 'sliderbottom2', //id of carousel DIV
		beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
		panelclass: 'panel', //class of panel DIVs each holding content
		autostep: {enable:false, moveby:3, pause:3000},
		panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},
		defaultbuttons: {enable: true, moveby: 3, leftnav: ['http://i34.tinypic.com/317e0s5.gif', 842, -42], rightnav: ['http://i38.tinypic.com/33o7di8.gif', -45, -42]},
		statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
		contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
	})

		<?php } ?>		// Set up Sliders
			// **************
			 var $j = jQuery.noConflict();
			$j(function(){
				$j('#slider1').anythingSlider({
					autoPlay            : true, 
					easing          : 'easeInOutBack',
					pauseOnHover        : true,
					startText           : "",
					stopText            : ""
					
				});
				
				
				$j('#slider2').anythingSlider({
					autoPlay            : true, 
					easing          : 'easeInOutBack',
				});
				
				$j('#slider3').anythingSlider({
					autoPlay            : true, 
					easing          : 'easeInOutBack',
				});
				// tooltips for first demo
				$j.jatt();
			});
			
			$(document).ready(function() {
				var Height = $(window).height();
				$("#container").css("min-height" , Height );
			});
			
			
	</script>

  <!--/Anything Slider-->
  <!--contact form-->
  <script type="text/javascript">
		function clearText(field)
		{
			if (field.defaultValue == field.value) field.value = '';
		}
		
		function restoreText(field) 
		{
			if (field.value == '') field.value = field.defaultValue;
		}
	</script>
  
</head>
<body>
<div id="container"> 
  <!-- Header-->
  <header id="header" class="clearfix">
    <section class="logo">
      <h1><a href="<?php bloginfo('url');?>" title="Kangol"><img src="<?php header_image(); ?>"   alt="" /></a></h1>
    </section>
    <section class="title">
    <?php if(is_single())  { ?>
    <h1>  <?php $cat = get_the_category(); echo $cat[0]->name;?></h1>
    <?php } else { ?>
    <h1>  <?php wp_title(''); ?></h1>
    <?php } ?>
      
    </section>
  </header>
  <!-- /Header-->
   <!--menu-->  
<menu id="menu" class="clearfix">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('header-widget-area') ) : else : ?>
<?php endif; ?>
<ul id="header_nav" class="clearfix">
 <?php wp_nav_menu( array('menu' => 'Header Navigation Menu', 'container' => '','container_class' => '', 'container_id' => '','menu_class'      => '', 'items_wrap'      => '%3$s' )); //displaying header navigation menu?>
</ul>
</menu>
 <!--/menu-->  
	</header>
	
	
	
	

	

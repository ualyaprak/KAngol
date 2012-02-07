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

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
    <link rel="shortcut icon" href="<?php bloginfo('url'); ?>/anatta.jpg" type="image/x-icon" />
	<!--[if lt IE 9]>
		<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie.css"/>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>: Feed" href="<?php bloginfo('rss2_url'); ?>" />
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type='text/javascript' src='<?php bloginfo('template_url');?>/jwplayer/jwplayer.js'></script><!--jwplayer file-->
    
    <!--Anything Slider-->

	<!-- Demo stuff -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/anythingslider/demos/css/page.css" media="screen">
	<script src="<?php bloginfo('template_directory'); ?>/anythingslider/demos/js/jquery.jatt.min.js"></script>

	<!-- AnythingSlider -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/anythingslider/css/anythingslider.css">
	<script src="<?php bloginfo('template_directory'); ?>/anythingslider/js/jquery.anythingslider.min.js"></script>

	<!-- Ideally, add the stylesheet(s) you are going to use here,
	 otherwise they are loaded and appended to the <head> automatically and will over-ride the IE stylesheet below -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/anythingslider/css/theme-metallic.css">

	<script>
		// Set up Sliders
		// **************
		$(function(){

			$('#slider1').anythingSlider({
				theme           : 'metallic',
				easing          : 'easeInOutBack',
				
			});

			// tooltips for first demo
			$.jatt();

		});
	</script>
    
     <!--/Anything Slider-->
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
	<?php //if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>

<body <?php body_class(); ?> id="main">
	<header class="body">
   <h1 id="logo"><a href="<?php bloginfo('url');?>" title="Generra"><img src="<?php header_image(); ?>"   alt="" /></a></h1><!--logo-->
    <!--Site Navigation-->
	<nav>
	 <?php wp_nav_menu( array('menu' => 'Header Navigation Menu', 'container' => '','container_class' => '', 'container_id' => '','menu_class'      => '', 'items_wrap'      => '<ul id="header_nav">%3$s</ul>' )); //displaying header navigation menu?>
	</nav>
	<!--/Site Navigation-->
	</header>
	<nav class="body">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('header-widget-area') ) : else : ?>
        <?php endif; ?>
	</nav>

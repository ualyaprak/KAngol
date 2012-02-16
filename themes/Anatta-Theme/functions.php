<?php
    // Load jQuery
    if ( !is_admin() ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
        wp_enqueue_script('jquery');
    }

    // Clean up the <head>
    function removeHeadLinks() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    }
    add_action('init', 'removeHeadLinks');
	wp_deregister_script('l10n');
	
    // remove version info from head and feeds
    function complete_version_removal() {
        return '';
    }
    add_filter('the_generator', 'complete_version_removal');

    // custom excerpt.
    function improved_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
            $text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			if (stristr($text,"<style")) { //get rid of CSS.
				$text1 = explode("<style", $text);
				$text2 = explode("</style>", $text);
				$text = $text1[0] . $text2[1]; //this might work
			}
            $text = strip_tags($text, '<strong>');
            //ALLOWED tags (will be rendered) - could add more
            //They count against the word count below, though
			$excerpt_length = 55; //default excerpt is 55 words
			$words = explode(' ', $text, $excerpt_length + 1);
			
			if (count($words)> $excerpt_length) {
				array_pop($words);
				array_push($words, '...'); //indicates "read more..."
				$text = implode(' ', $words);
			}
		}
		return $text;
	}
    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter('get_the_excerpt', 'improved_trim_excerpt');

    //Support for Featured Images for posts or pages
    add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(360, 200, true);
	
    //Support for WP3 menus - create menus in the admin interface, then add them to widget areas in
    //the theme (like, say, the Nav widget area). Menus are not baked into this theme.
    add_theme_support( 'menus');

    // add custom content after each post
    function add_post_content($content) {
        if(!is_feed() && !is_home()) {
            //$content .= '<p>This article is copyright &copy; '.date('Y').'&nbsp;'.bloginfo('name').'</p>';
            $content .= '';
        }
        return $content;
    }
    add_filter('the_content', 'add_post_content');

    //enable shortcodes in widgets
    if (!is_admin()) {
        add_filter('widget_text', 'do_shortcode', 11);
    }

	// sidebars / widget areas: I have one in the header, nav, sidebar, and footer
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id'   => 'sidebar-widgets',
        'description'   => 'These are widgets for the sidebar.',
        //'before_widget' => '<div id="%1$s" class="widget %2$s">',
        //'after_widget'  => '</div>',
        'before_widget' => '',
        'after_widget' => '',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));

    register_sidebar(array(
        'name' => 'Nav Widget Area',
        'id'   => 'nav-widget-area',
        'description'   => 'These are widgets for the Navigation area (use a menu!).',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));

    register_sidebar(array(
        'name' => 'Header Widget Area',
        'id'   => 'header-widget-area',
        'description'   => 'These are widgets for the header.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '', // use h3's here?
        'after_title'   => ''
    ));

    register_sidebar(array(
        'name' => 'Footer Widget Area',
        'id'   => 'footer-widget-area',
        'description'   => 'These are widgets for the footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
	
	
	//function for getting limited excerpt
	function excerpt($num) {
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt)."...";
	return $excerpt;
	}

	//function for getting limited content
	function content($limit) {
	  $content = explode(' ', get_the_content(), $limit);
	  if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	  } else {
		$content = implode(" ",$content);
	  }	
	  $content = preg_replace('/\[.+\]/','', $content);
	  $content = apply_filters('the_content', $content); 
	  $content = str_replace(']]>', ']]&gt;', $content);
	  return $content;
	}
	
	/** Tell WordPress to run yourtheme_setup() when the 'after_setup_theme' hook is run. */
    add_action( 'after_setup_theme', 'yourtheme_setup' );

    if ( ! function_exists('yourtheme_setup') ):
    /**
    * @uses add_custom_image_header() To add support for a custom header.
    * @uses register_default_headers() To register the default custom header images provided with the theme.
    *
    * @since 3.0.0
    */
    function yourtheme_setup() {

    // This theme uses post thumbnails
    //add_theme_support( 'post-thumbnails' );

    // Your changeable header business starts here
    define( 'HEADER_TEXTCOLOR', '' );
    // No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
    define( 'HEADER_IMAGE', '%s/images/headers/kangol_logo.jpg' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to yourtheme_header_image_width and yourtheme_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yourtheme_header_image_width', 72 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yourtheme_header_image_height', 82 ) );

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall (larger images will be auto-cropped to fit).
    set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

    // Don't support text inside the header image.
    define( 'NO_HEADER_TEXT', true );

    // Add a way for the custom header to be styled in the admin panel that controls
    // custom headers. See yourtheme_admin_header_style(), below.
    add_custom_image_header( '', 'yourtheme_admin_header_style' );

    // … and thus ends the changeable header business.

    
    }
    endif;

    if ( ! function_exists( 'yourtheme_admin_header_style' ) ) :
    /**
    * Styles the header image displayed on the Appearance > Header admin panel.
    *
    * Referenced via add_custom_image_header() in yourtheme_setup().
    *
    * @since 3.0.0
    */
    function yourtheme_admin_header_style() {
    ?>
    <style type="text/css">
    #headimg {
    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
    }
    #headimg h1, #headimg #desc {
    display: none;
    }
    </style>
    <?php
    }
    endif;
	
	//////////////////////////////////////////////////	
/*Code for Adding Theme Options in Admin Panel*/
/////////////////////////////////////////////////
$themename = "Anatta Theme";
$shortname = "ant";

$options = array (

	array(	"name" => "Footer Options",
			"type" => "title"),
			
	array(	"type" => "open"),
			
	array(	"name" => "Mail Link",
			"desc" => "Enter the EMAIL ADDRESS YOU WOULD LIKE TO BE CONTACTED AT.",
			"id" => $shortname."_mail",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Twitter Link",
			"desc" => "Enter the URL FOR THE TWITTER PAGE YOU WOULD LIKE TO LINK TO.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Facebook Link",
			"desc" => "Enter the URL FOR THE FACEBOOK PAGE YOU WOULD LIKE TO LINK TO.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "RSS Link",
			"desc" => "Enter the URL FOR THE RSS PAGE YOU WOULD LIKE TO LINK TO.",
			"id" => $shortname."_rss",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Email Capture",
			"desc" => "Enter the Form Code for EMAIL REGISTRATION.",
            "id" => $shortname."_email_capture",
            "type" => "textarea"),
			
	array(	"type" => "close")
	
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="background-color:#F9F9F9; padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#DFDFDF; padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo stripslashes($value['desc']); ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin');



///////////////////////////////////////////////////////////	
/*Code for Adding Theme Options in Admin Panel Ends here*/
//////////////////////////////////////////////////////////


/////////////////////////////////////////////////////
/* Code for adding page options in wp-page backend*/
////////////////////////////////////////////////////


/**

/* Add a new meta box to the admin menu. */
	add_action( 'admin_menu', 'hybrid_create_meta_box' );

/* Saves the meta box data. */
	add_action( 'save_post', 'hybrid_save_meta_data' );

/**
 * Function for adding meta boxes to the admin.
 * Separate the post and page meta boxes.*/

function hybrid_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Post Options'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'slideshow-meta-boxes', __('Slideshow Options'), 'slideshow_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Page Options'), 'page_meta_boxes', 'page', 'normal', 'high' );
}

function hybrid_post_meta_boxes() {

	/* Array of the meta box post options. */
	$meta_boxes = array(
		'postimage_gallery' => array( 'name' => 'postimage_gallery', 'title' => __('IMAGE GALLERY:', 'hybrid'),'options' => array('Gallery 1','Gallery 2', 'Gallery 3'), 'type' => 'select' ),
		'video_post1' => array( 'name' => 'video_post1', 'title' => __('VIDEO: <br/><small>Enter the URLs to the videos you would like featured on the page</small>', 'hybrid'), 'type' => 'text' ),
		'video_post2' => array( 'name' => 'video_post2', 'title' => __('', 'hybrid'), 'type' => 'text' ),
		'video_post3' => array( 'name' => 'video_post3', 'title' => __('', 'hybrid'), 'type' => 'text' ),
		'postslider1' => array( 'name' => 'postslider1', 'title' => __('SLIDER:', 'hybrid'),'options' => array('Collection','Blog', 'Retrospective'), 'type' => 'select' ),

	);

	return apply_filters( 'hybrid_post_meta_boxes', $meta_boxes );
}

function hybrid_portfolio_meta_boxes() {
		
	/* Array of the meta box slideshow options. */
		
		$portfolio_meta_boxes = array(
			'slider1' => array( 'name' => 'slider1', 'title' => __('SLIDER_01:', 'hybrid'),'options' => array('Collection','Blog', 'Retrospective'), 'type' => 'select' ),
			'slider2' => array( 'name' => 'slider2', 'title' => __('SLIDER_02:', 'hybrid'),'options' => array('Collection','Blog', 'Retrospective'), 'type' => 'select' ),
			
		);
	
	return apply_filters( 'hybrid_portfolio_meta_boxes', $portfolio_meta_boxes );
	
}

function hybrid_slideshow_meta_boxes() {
		
	/* Array of the meta box page options. */
		
		$slides_meta_boxes = array(
			'image_gallery' => array( 'name' => 'image_gallery', 'title' => __('IMAGE GALLERY:', 'hybrid'),'options' => array('Gallery 1','Gallery 2', 'Gallery 3'), 'type' => 'select' ),
			'video_slideshow1' => array( 'name' => 'video_slideshow1', 'title' => __('VIDEO: <br/><small>Enter the URLs to the videos you would like featured on the page</small>', 'hybrid'), 'type' => 'text' ),
			'video_slideshow2' => array( 'name' => 'video_slideshow2', 'title' => __('', 'hybrid'), 'type' => 'text' ),
			'video_slideshow3' => array( 'name' => 'video_slideshow3', 'title' => __('', 'hybrid'), 'type' => 'text' ),
			
		);
	
	return apply_filters( 'hybrid_slideshow_meta_boxes', $slides_meta_boxes );
	
}


/**
 * Displays meta boxes on the Write Page panel.  Loops
 * through each meta box in the $meta_boxes variable.
 * Gets array from hybrid_page_meta_boxes()
 *
 * @since 0.3
 */
 
function post_meta_boxes() {
	global $post;
	$meta_boxes = hybrid_post_meta_boxes(); ?>
	<div class="posts_home">
	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
    </div>
<?php
}

function slideshow_meta_boxes() {
	global $post;
	$smeta_boxes = hybrid_slideshow_meta_boxes(); 
	$template = get_post_meta($post->ID, '_wp_page_template', true);
	?>
	<div class="slides"<?php if(!empty($template) && $template == 'home_template.php') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>
	<table class="form-table">
	<?php foreach ( $smeta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
    </div>
<?php
} 
  
 
function page_meta_boxes() {
	global $post;
	$p_meta_boxes =  hybrid_portfolio_meta_boxes();
	$template = get_post_meta($post->ID, '_wp_page_template', true);
	
	?>
    
    <div class="home"<?php if(!empty($template) && $template == 'home_template.php') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>
	<table class="form-table">
	<?php foreach ( $p_meta_boxes as $metap ) :

		$value = stripslashes( get_post_meta( $post->ID, $metap['name'], true ) );

		if ( $metap['type'] == 'text' )
			get_meta_text_input( $metap, $value );
		elseif ( $metap['type'] == 'textarea' )
			get_meta_textarea( $metap, $value );
		elseif ( $metap['type'] == 'select' )
			get_meta_select( $metap, $value );

	endforeach; ?>
	</table>
    </div>
    
    
<?php
} 

/**
 * Outputs a text input box with arguments from the
 * parameters.  Used for both the post/page meta boxes.
 *
 * @since 0.3
 * @param array $args
 * @param array string|bool $value
 */
function get_meta_text_input( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:25%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo wp_specialchars( $value, 1 ); ?>" size="30" tabindex="30" style="width: 95%;" />
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

/**
 * Outputs a select box with arguments from the
 * parameters.  Used for both the post/page meta boxes.
 *
 * @since 0.3
 * @param array $args
 * @param array string|bool $value
 */
function get_meta_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:25%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

/**
 * Outputs a textarea with arguments from the
 * parameters.  Used for both the post/page meta boxes.
 *
 * @since 0.3
 * @param array $args
 * @param array string|bool $value
 */
function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:25%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 95%;"><?php echo wp_specialchars( $value, 1 ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

/**
 * Loops through each meta box's set of variables.
 * Saves them to the database as custom fields.
 *
 * @since 0.3
 * @param int $post_id
 */
function hybrid_save_meta_data( $post_id ) {
	global $post;

	if ( 'page' == $_POST['post_type'] ) {
		$s_meta_boxes = array_merge(hybrid_slideshow_meta_boxes(), hybrid_portfolio_meta_boxes()); 
		}
	else {
		$s_meta_boxes = array_merge(hybrid_post_meta_boxes());
		}

	foreach ( $s_meta_boxes as $meta_box ) :

		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		$data = stripslashes( $_POST[$meta_box['name']] );

		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
	
	
}

add_action('admin_head', 'theme_page_head');
	
function theme_page_head() {
?>
<!--code for getting selected page template -->
    <script type="text/javascript">
	jQuery(document).ready(function($) {

	  jQuery("#page_template").change( 
		function (){ 
		var select_value = jQuery(this).val();
		
		//alert(select_value); 
		if(select_value == "home_template.php"){
		
		  $(".slides").show();
		  $(".home").show();		 
		}
		else 
		{
			 $(".home").hide();
			 $(".slides").hide();
		}
		
		});
	});

	
	</script>

<?php
}

/////////////////////////////////////////////////////
/* Code for adding page options ends here*/
////////////////////////////////////////////////////

//function for showing Slider selected for page/post options

function get_slider_option($slider_val)
{
	if($slider_val == 'Collection')
	{
		$query_string = 'category_name=shop&showposts=6';
	}
	else
	{
		$query_string = 'category_name='.$slider_val.'&showposts=-1';
	}
	
	query_posts($query_string);
	// the Loop
	while (have_posts()) : the_post();
	{ ?>
	<li class="panel">
	<div class="image">
	<?php
		the_post_thumbnail('thumbnail');
	?>
	</div>
       <h2> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
     
        <p>
			<?php echo excerpt(20); ?><a href="<?php the_permalink() ?>">MORE</a>
        </p>
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style share" addthis:url="<?php echo get_permalink(); ?>" addthis:title="<?php echo get_the_title($postid); ?>">
        <a class="addthis_counter addthis_pill_style count"></a>
        </div>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f2fd41b73a803c0"></script>
        <!-- AddThis Button END -->
        </li>    
	<?php }	
	endwhile;
	wp_reset_query();

}


?>

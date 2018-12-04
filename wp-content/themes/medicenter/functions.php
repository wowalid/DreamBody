<?php
$themename = "medicenter";
//visual composer
/*$dir = dirname(__FILE__) . '/wpbakery';
 
$composer_settings = Array(
    'APP_ROOT'      => $dir . '/js_composer',
    'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
    'APP_DIR'       => basename( $dir ) . '/js_composer/',
    'CONFIG'        => $dir . '/js_composer/config/',
    'ASSETS_DIR'    => 'assets/',
    'COMPOSER'      => $dir . '/js_composer/composer/',
    'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
    'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
 
    /* for which content types Visual Composer should be enabled by default */
  /*  'default_post_types' => Array('page', 'doctors', 'medicenter_gallery', 'features')
);
 
require_once locate_template('/wpbakery/js_composer/js_composer.php');
 
$wpVC_setup->init($composer_settings);

if (!class_exists('WPBakeryVisualComposerAbstract')) {
  $dir = dirname(__FILE__) . '/wpbakery/';
  $composer_settings = Array(
      'APP_ROOT'      => $dir . '/js_composer',
      'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
      'APP_DIR'       => basename( $dir ) . '/js_composer/',
      'CONFIG'        => $dir . '/js_composer/config/',
      'ASSETS_DIR'    => 'assets/',
      'COMPOSER'      => $dir . '/js_composer/composer/',
      'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
      'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
      'USER_DIR_NAME'  => 'vc_templates', /* Path relative to your current theme, where VC should look for new shortcode templates */
 
      //for which content types Visual Composer should be enabled by default
     /*'default_post_types' => Array('page', 'doctors', 'medicenter_gallery', 'features')
  );
  require_once locate_template('/wpbakery/js_composer/js_composer.php');
  $wpVC_setup->init($composer_settings);
}*/

/*function your_prefix_vcSetAsTheme() 
{
	vc_set_as_theme();
}
add_action('init', 'your_prefix_vcSetAsTheme');*/
//add new mimes for upload dummy content files (code can be removed after dummy content import)
function custom_upload_files($mimes) 
{
    $mimes = array_merge($mimes, array('xml' => 'application/xml'), array('json' => 'application/json'));
    return $mimes;
}
add_filter('upload_mimes', 'custom_upload_files');

//plugins activator
require_once("plugins_activator.php");

//wpb_remove("vc_row_inner");
if(function_exists("wpb_remove"))
{
	wpb_remove("vc_gmaps");
	wpb_remove("vc_tour");
}

//theme options
require_once(locate_template("theme-options.php"));

//custom meta box
require_once(locate_template("meta-box.php"));

//dropdown menu
require_once(locate_template("nav-menu-dropdown-walker.php"));

//gallery functions
require_once(locate_template("gallery-functions.php"));
//weekdays
require_once(locate_template("post-type-weekdays.php"));
//departments
require_once(locate_template("post-type-departments.php"));
if(function_exists("wpb_map"))
{
	//doctors
	require_once(locate_template("post-type-doctors.php"));
	//gallery
	require_once(locate_template("post-type-gallery.php"));
	//features
	require_once(locate_template("post-type-features.php"));
	//contact_form
	require_once(locate_template("contact_form.php"));
}

//comments
require_once(locate_template("comments-functions.php"));

//sidebars
require_once(locate_template("sidebars.php"));

//widgets
require_once(locate_template("widgets/widget-home-box.php"));
require_once(locate_template("widgets/widget-departments.php"));
require_once(locate_template("widgets/widget-appointment.php"));
require_once(locate_template("widgets/widget-twitter.php"));
require_once(locate_template("widgets/widget-footer-box.php"));
require_once(locate_template("widgets/widget-contact-details.php"));
require_once(locate_template("widgets/widget-scrolling-recent-posts.php"));
require_once(locate_template("widgets/widget-scrolling-most-commented.php"));
require_once(locate_template("widgets/widget-scrolling-most-viewed.php"));

//shortcodes
if(function_exists("wpb_map"))
	require_once(locate_template("shortcodes/shortcodes.php"));

//register menu
add_theme_support("menus");
if(function_exists("register_nav_menu"))
{
	register_nav_menu("main-menu", "Main Menu");
}

//register sidebars
if(function_exists("register_sidebar"))
{
	//register custom sidebars
	query_posts(array( 
		'post_type' => $themename . '_sidebars',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));
	if(have_posts()) : while (have_posts()) : the_post();
		global $post;
		$before_widget = get_post_meta($post->ID, "before_widget", true);
		$after_widget = get_post_meta($post->ID, "after_widget", true);
		$before_title = get_post_meta($post->ID, "before_title", true);
		$after_title = get_post_meta($post->ID, "after_title", true);
		register_sidebar(array(
			"id" => $post->post_name,
			"name" => get_the_title(),
			'before_widget' => ($before_widget!='' && $before_widget!='empty' ? $before_widget : ''),
			'after_widget' => ($after_widget!='' && $after_widget!='empty' ? $after_widget : ''),
			'before_title' => ($before_title!='' && $before_title!='empty' ? $before_title : ''),
			'after_title' => ($after_title!='' && $after_title!='empty' ? $after_title : '')
		));
	endwhile; endif;
	//Reset Query
	wp_reset_query();
}

//admin functions
require_once(locate_template("admin/functions.php"));

//using shortcodes in sidebar
add_filter("widget_text", "do_shortcode");

//register blog post thumbnail & portfolio thumbnail
add_theme_support("post-thumbnails");
add_image_size("blog-post-thumb", 540, 280, true);
add_image_size($themename . "-gallery-image", 480, 300, true);
add_image_size($themename . "-gallery-thumb-type-1", 310, 200, true);
add_image_size($themename . "-gallery-thumb-type-2", 225, 150, true);
add_image_size($themename . "-small-thumb", 96, 96, true);
function theme_image_sizes($sizes)
{
	global $themename;
	$addsizes = array(
		"blog-post-thumb" => __("Blog post thumbnail", 'medicenter'),
		$themename . "-gallery-image" => __("Gallery image", 'medicenter'),
		$themename . "-gallery-thumb" => __("Gallery thumbnail", 'medicenter'),
		$themename . "-small-thumb" => __("Small thumbnail", 'medicenter')
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
add_filter("image_size_names_choose", "theme_image_sizes");

//excerpt
function theme_excerpt_more($more) 
{
	return '';
}
add_filter('excerpt_more', 'theme_excerpt_more', 99);

function theme_after_setup_theme()
{
	global $themename;
	if(!get_option($themename . "_installed"))
	{		
		$theme_options = array(
			"logo_url" => get_template_directory_uri() . "/images/logo/blue/header_logo.png",
			"logo_text" => "medicenter",
			"footer_text_left" => "© Copyright - <a href='http://themeforest.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs' target='_blank'>MediCenter Theme</a> by <a href='http://quanticalabs.com' title='QuanticaLabs' target='_blank'>QuanticaLabs</a>",
			"footer_text_right" => "[scroll_top]",
			//"home_page_top_hint" => "Give us a call: +123 356 123 124",
			"responsive" => 1,
			"direction" => "default",
			"animations" => 1,
			"layout" => "wide",
			"layout_picker" => 0,
			"cf_admin_name" => get_settings("admin_email"),
			"cf_admin_email" => get_settings("admin_email"),
			"cf_smtp_host" => "",
			"cf_smtp_username" => "",
			"cf_smtp_password" => "",
			"cf_smtp_port" => "",
			"cf_smtp_secure" => "",
			"cf_email_subject" => "MediCenter WP: Contact from WWW",
			"cf_template" => "<html>
	<head>
	</head>
	<body>
		<div><b>First and last name</b>: [first_name] [last_name]</div>
		<div><b>E-mail</b>: [email]</div>
		<div><b>Department</b>: [department]</div>
		<div><b>Date of Birth (mm/dd/yyyy)</b>: [date]</div>
		<div><b>Social Security Number</b>: [social_security_number]</div>
		<div><b>Reason of Appointment</b>: [message]</div>
	</body>
</html>"
		);
		add_option($themename . "_options", $theme_options);
		
		update_option($themename . "_slider_settings_home-slider", array('slider_image_url' => array (0 => get_template_directory_uri() . "/images/slider/img1.jpg", 1 => get_template_directory_uri() . "/images/slider/img2.jpg", 2 => get_template_directory_uri() . "/images/slider/img3.jpg"), 'slider_image_title' => array(0 => 'Top notch<br>experience', 1 => 'Show your<br>schedule', 2 => 'Build it<br>your way'), 'slider_image_subtitle' => array (0 => 'Medicenter is a responsive template<br>perfect for all screen sizes', 1 => 'Organize and visualize your week<br>with build-in timetable', 2 => 'Limitless possibilities with multiple<br>page layouts and different shortcodes'), 'slider_image_link' => array (), 'slider_autoplay' => '1', 'slider_navigation' => '1', 'slider_pause_on_hover' => NULL, 'slider_height' => 670, 'slide_interval' => 5000, 'slider_effect' => 'scroll', 'slider_transition' => 'easeInOutQuint', 'slider_transition_speed' => 750));
		update_option("blogdescription", "Responsive Medical Health WordPress Theme");
		
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		add_option($themename . "_installed", 1);
	}
	//Make theme available for translation
	//Translations can be filed in the /languages/ directory
	load_theme_textdomain('medicenter', get_template_directory() . '/languages');
}
add_action("after_setup_theme", "theme_after_setup_theme");
function theme_switch_theme($theme_template)
{
	global $themename;
	delete_option($themename . "_installed");
}
add_action("switch_theme", "theme_switch_theme");

//enable custom background
add_theme_support("custom-background"); //3.4
//add_custom_background(); //deprecated

//theme options
global $theme_options;
$theme_options = theme_stripslashes_deep(get_option($themename . "_options"));

function theme_enqueue_scripts()
{
	global $themename;
	global $theme_options;
	//style
	if($theme_options["header_font"]!="")
		wp_enqueue_style("google-font-header", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["header_font"]));
	else
		wp_enqueue_style("google-font-droid-sans", "//fonts.googleapis.com/css?family=PT+Sans");
	if($theme_options["subheader_font"]!="")
		wp_enqueue_style("google-font-subheader", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["subheader_font"]));
	else
		wp_enqueue_style("google-font-droid-serif", "//fonts.googleapis.com/css?family=Volkhov:400italic");
	wp_enqueue_style("reset", get_template_directory_uri() . "/style/reset.css");
	wp_enqueue_style("superfish", get_template_directory_uri() ."/style/superfish.css");
	wp_enqueue_style("jquery-fancybox", get_template_directory_uri() ."/style/fancybox/jquery.fancybox.css");
	wp_enqueue_style("jquery-qtip", get_template_directory_uri() ."/style/jquery.qtip.css");
	wp_enqueue_style("jquery-ui-custom", get_template_directory_uri() ."/style/jquery-ui-1.9.2.custom.css");
	if(((int)$theme_options["animations"] || !isset($theme_options["animations"])) && (isset($_COOKIE["mc_animations"]) && $_COOKIE["mc_animations"]==1 || !isset($_COOKIE["mc_animations"])))
		wp_enqueue_style("animations", get_template_directory_uri() ."/style/animations.css");
	wp_enqueue_style("main-style", get_stylesheet_uri());
	if((int)$theme_options["responsive"])
		wp_enqueue_style("responsive", get_template_directory_uri() ."/style/responsive.css");
	else
		wp_enqueue_style("no-responsive", get_template_directory_uri() ."/style/no_responsive.css");
	if(($theme_options["direction"]=='rtl' && !is_rtl() && !$_COOKIE["mc_direction"]=="LTR") || $_COOKIE["mc_direction"]=="RTL")
		wp_enqueue_style("rtl", get_template_directory_uri() ."/rtl.css");
	wp_enqueue_style("custom", get_template_directory_uri() ."/custom.css");
	//js
	wp_enqueue_script("jquery", false, array(), false, true);
	wp_enqueue_script("jquery-ui-core", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-accordion", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-tabs", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-datepicker", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ba-bqq", get_template_directory_uri() ."/js/jquery.ba-bbq.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-history", get_template_directory_uri() ."/js/jquery.history.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-easing", get_template_directory_uri() ."/js/jquery.easing.1.3.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-carouFredSel", get_template_directory_uri() ."/js/jquery.carouFredSel-6.2.1-packed.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-sliderControl", get_template_directory_uri() ."/js/jquery.sliderControl.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-timeago", get_template_directory_uri() ."/js/jquery.timeago.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-hint", get_template_directory_uri() ."/js/jquery.hint.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-isotope", get_template_directory_uri() ."/js/jquery.isotope.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-isotope-masonry", get_template_directory_uri() ."/js/jquery.isotope.masonry.js", array("jquery", "jquery-isotope"), false, true);
	if(((is_rtl() || $theme_options["direction"]=='rtl') && $_COOKIE["mc_direction"]!="LTR") || $_COOKIE["mc_direction"]=="RTL")
		wp_enqueue_script("rtl-js", get_template_directory_uri() ."/js/rtl.js", array("jquery", "jquery-isotope"), "jquery-isotope-masonry", false, true);
	wp_enqueue_script("jquery-fancybox", get_template_directory_uri() ."/js/jquery.fancybox-1.3.4.pack.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-qtip", get_template_directory_uri() ."/js/jquery.qtip.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-block-ui", get_template_directory_uri() ."/js/jquery.blockUI.js", array("jquery"), false, true);
	wp_enqueue_script("google-maps-v3", "//maps.google.com/maps/api/js?sensor=false", false, array(), false, true);

	wp_enqueue_script("theme-main", get_template_directory_uri() ."/js/main.js", array("jquery", "jquery-ui-core", "jquery-ui-accordion", "jquery-ui-tabs"), false, true);
	
	//ajaxurl
	$data["ajaxurl"] = admin_url("admin-ajax.php");
	//themename
	$data["themename"] = $themename;
	//home url
	$data["home_url"] = get_home_url();
	//is_rtl
	$data["is_rtl"] = ((is_rtl() || $theme_options["direction"]=='rtl') && $_COOKIE["mc_direction"]!="LTR") || $_COOKIE["mc_direction"]=="RTL" ? 1 : 0;
	
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-main", "config", $params);
}
add_action("wp_enqueue_scripts", "theme_enqueue_scripts");

//function to display number of posts
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    return (int)$count;
}

//function to count views
function setPostViews($postID) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 1);
    }
	else
	{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function get_time_iso8601() 
{
	$offset = get_option('gmt_offset');
	$timezone = ($offset < 0 ? '-' : '+') . (abs($offset)<10 ? '0'.abs($offset) : abs($offset)) . '00' ;
	return get_the_time('Y-m-d\TH:i:s') . $timezone;					
}

function theme_direction() 
{
	global $wp_locale, $theme_options;
	if(isset($theme_options['direction']) || ($_COOKIE["mc_direction"]=="LTR" || $_COOKIE["mc_direction"]=="RTL")) 
	{
		if($theme_options['direction']=='default')
			return;
		$wp_locale->text_direction = ($theme_options['direction']=='rtl' && $_COOKIE["mc_direction"]!="LTR") || $_COOKIE["mc_direction"]=="RTL" ? 'rtl' : 'ltr';
	}
}
add_action("init", "theme_direction");

// default locate_template() method returns file PATH, we need file URL for javascript and css
//function locate_template_uri($file)
//{
//    $website_path = str_replace("\\", "/", realpath(dirname($_SERVER["SCRIPT_FILENAME"])));
//    $site_url = site_url();
//    $file_path = str_replace("\\", "/", locate_template(ltrim($file, "/")));
//    $file_url = str_replace($website_path, $site_url, $file_path);
//    return $file_url;
//}
?>
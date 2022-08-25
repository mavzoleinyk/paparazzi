<?php

/**
 * Hutchpress functions and definitions
 * 
 * This theme aims to aid designers in Theme Development, a starting point that allows you
 * to concentrate on HTML/CSS and not worry about hooks, functions or arrays!
 * 
 */
 
$frontpage_id = get_option('page_on_front');

// Activate Featured Images
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 136, 136, true );
add_image_size( 'sidebar_news', 208, 30000 );
add_image_size( 'admin-image-thumb', 30000, 60);
add_image_size( 'person', 155, 30000);
add_image_size( 'hero', 1160, 398, true);
add_image_size( 'site-logo', 100, 100, true);
add_image_size( 'xs-max', 768, 30000);
add_image_size( 'xs-max-wide', 768, 432, true);
add_image_size( 'xxs-max-square', 480, 480, true);
add_image_size( 'viewport', 1600, 1600);
add_image_size( 'gallery-thumb', 105, 72, true);
add_image_size( 'carousel-menu-item', 60, 30000);

/* Set the level a user has to be to have access to the top admin bar. */
if (!current_user_can('update_core')):
	//show_admin_bar(false);
endif;

// Activate Custom Menus
add_theme_support('menus');

// Activate default posts and comments RSS feed links in head
add_theme_support('automatic-feed-links');

// Tidy the <head>
remove_action('wp_head', 'feed_links_extra');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'wp_generator');

// Add excerpt support for pages
add_post_type_support('page', 'excerpt');

// Load HH Admin Modules
if(class_exists('HH_Module')):
	load_moduals_from_theme();
endif;

function load_moduals_from_theme(){
	HH_Module::load_modules(array(
		//'copy-site',
		//'cookie-warning',
		//'color-options',
		//'hh-staff-options',
		//'hh-security'
	));
}

// Create 2 navigation menu
register_nav_menu('sites_nav', 'Sites Navigation');
register_nav_menu('main_nav', 'Main Navigation');
register_nav_menu('logged_in_nav', 'Logged In Navigation');
register_nav_menu('logged_out_nav', 'Logged Out Navigation');
register_nav_menu('useful_links_nav', 'Useful Links Navigation');
register_nav_menu('social_nav', 'Social Navigation');
register_nav_menu('footer_nav', 'Footer Navigation');

if (version_compare(PHP_VERSION, '5.3.0', '>='))
{
	if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'init.php'))
	{
		require_once(__DIR__ . DIRECTORY_SEPARATOR . 'init.php');
	}	
}

/**
 * Third party scripts
 */


include_once('functions/imagick/dpi-converter.php');

require_once('functions/wp-bootstrap-nav-walker.php');

require_once ('functions/post-taxonomy-registration.php');

require_once ('functions/meta/components.php');

require_once ('functions/meta/content-structure.php');

require_once ('functions/helpers.php');

require_once ('functions/meta/helpers.php');

require_once ('functions/tinymce/init.php');

require_once ('functions/hooks.php');

require_once ('functions/formidable/hooks.php');

require_once ('functions/import/helpers.php');

require_once ('functions/import/hooks.php');

require_once ('functions/woocommerce/helpers.php');

require_once ('functions/woocommerce/hooks.php');

require_once('functions/themattharris/tmhoauth/tmhOAuth.php');

require_once('functions/themattharris/tmhoauth/tmhUtilities.php');
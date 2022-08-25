<?php
/**
 * hooks.php
 *
 * In this file you can declare hooks for wordpress that hook in to core & plugins functionality.
 *
 * @version 0.0.1       10-01-2013
 * @author David Barker
 * @internal Versioning authors
 *         - Simon Holloway
 *         - John Stiles
 * @copyright Hutchhouse ltd. 10/01/2013
 */

/**
 * Register theme assets
 *
 * @author Simon Holloway, Anthony Fisher
 * @return void
 */
add_action('wp_enqueue_scripts', 'theme_assets');
function theme_assets()
{
	//List in order to be echoed. Styles will ALWAYS be echoed before scripts.
	$sHeader_version = WP_DEBUG ? time() / 1000000000 : '1.2';

	// Enqueue theme CSS

    wp_enqueue_style('google_fonts', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic', array() );

    wp_enqueue_style('main_theme_css', get_template_directory_uri() . '/assets/css/theme.min.css', array(), $sHeader_version);

    wp_enqueue_style('bootstrap_datepicker', get_template_directory_uri() . '/assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', array(), $sHeader_version);

    wp_enqueue_style('blueimp_gallery', get_template_directory_uri() . '/assets/vendor/blueimp-gallery/blueimp-gallery.min.css', array(), $sHeader_version);

	// Enqueue standard Header Javascript

	wp_enqueue_script('jquery');

    //wp_enqueue_script('packery_js', get_template_directory_uri() . '/assets/vendor/packery/js/packery.pkgd.min.js', array('jquery'), $sHeader_version, true);

    wp_enqueue_script('bootstrap_datepicker', get_template_directory_uri() . '/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', array('jquery'), $sHeader_version, true);

    //wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array() , $sHeader_version);

	wp_enqueue_script('google_maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyC-yC34TFPgpKzb1cRHeZAZzwvl4yR1IDY', array(), $sHeader_version, true);

    /*if(HH_ENV !== 'live')
    {
        wp_enqueue_script('bugherd', get_template_directory_uri() . '/assets/js/bugherd.js', array());
    }*/

	// Enqueue standard Footer Javascript
	wp_enqueue_script('bootstrap-bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js', array('jquery'), $sHeader_version, true);

    //wp_enqueue_script('enquire_js', get_template_directory_uri() . '/assets/js/enquire.js', array('jquery'), $sHeader_version, true);

    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/vendor/slick/slick.min.js', array('jquery'), $sHeader_version, true);

    wp_enqueue_script('blueimp_gallery', get_template_directory_uri() . '/assets/vendor/blueimp-gallery/blueimp-gallery.min.js', array('jquery'), $sHeader_version, true);

    wp_enqueue_script('main_theme_js', get_template_directory_uri() . '/assets/js/common.js', array('jquery'), $sHeader_version, true);

}

/**
 * Register theme assets
 *
 * @author John Stiles
 * @return void
 */
add_action('admin_enqueue_scripts', 'admin_assets');
function admin_assets()
{
    //List in order to be echoed. Styles will ALWAYS be echoed before scripts.
    $sHeader_version = WP_DEBUG ? time() / 1000000000 : '1.0';

    // Enqueue theme CSS
    wp_enqueue_style('alchemy_css', get_template_directory_uri() . '/assets/css/admin/alchemy.css', array(), $sHeader_version);

}

/**
 * Print out the standard modals into the footer
 *
 * @author Simon Holloway <simon.holloway@hutchhouse.com>
 */
function print_theme_modals() {
    // get stuff
    global $oCallMeBackSettings;

    $meta = $oCallMeBackSettings->the_meta();

    $data = array(
        'title' => 'Call Me Back',
        'wysiwyg' => ''
    );

    if($meta['title']) {
        $data['title'] = $meta['title'];
    }

    if($meta['wysiwyg']) {
        $data['wysiwyg'] = $meta['wysiwyg'];
    }

    render_template('modals/call-me-back', $data);
}

add_action('wp_footer', 'print_theme_modals');


/**
 * Register a blog sidebar
 */
add_action( 'widgets_init', 'blog_sidebar' );

function blog_sidebar() {
    register_sidebar( array(
        'name' => __( 'Blog Sidebar', 'blog-sidebar' ),
        'id' => 'blog-sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all blog pages', 'blog-sidebar' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<header><h3>',
        'after_title'   => '</h3></header>',
    ) );
}

/**
 * We want blog and posts!
 */
remove_action( 'admin_menu', 'change_post_menu_label' );

add_action('save_post', 'save_location_as_meta', 200);

/**
 * Save the location term against post meta
 * @param $post_id
 */
function save_location_as_meta($post_id) {

    global $hhfeatured;

    $supported_types = array(
        'proposal',
        'product',
        'post'
    );

    if(!in_array(get_post_type($post_id), $supported_types))
    {
        return;
    }

    if($locations = get_the_terms( $post_id, 'location' ))
    {

        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'save_location_as_meta', 200);

        update_post_meta($post_id, '_pp_location', $locations[0]->term_id);

        // re-hook this function
        add_action('save_post', 'save_location_as_meta', 200);
    }
    else
    {
        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'save_location_as_meta', 200);

        update_post_meta($post_id, '_pp_location', 0);

        // re-hook this function
        add_action('save_post', 'save_location_as_meta', 200);
    }

    if(get_post_meta($post_id, '_pp_featured', true) != 1)
    {
        update_post_meta($post_id, '_pp_featured', 0);
    }

}

add_action('save_post', 'save_post_content_from_meta', 200);

/**
 * Save all story meta to post_content so it can be indexed for search
 * @param $post_id
 */
function save_post_content_from_meta($post_id) {

    global $story;

    $supported_types = array(
        'proposal'
    );

    if(!in_array(get_post_type($post_id), $supported_types))
    {
        return;
    }

    // Create the variables
    $separator = " \r\n";
    $content = '';
    $post_to_save = array(
        'ID' => $post_id
    );

    if($story->the_meta($post_id))
    {
        while($story->have_fields('slides'))
        {
            if($tempContent = $story->get_the_value('wysiwyg'))
            {
                $content .= $separator . $tempContent;
            }
        }

        $post_to_save['post_content'] = $content;

        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'save_post_content_from_meta', 200);

        // update the post, which calls save_post again
        wp_update_post($post_to_save);

        // re-hook this function
        add_action('save_post', 'save_post_content_from_meta', 200);
    }

}


/**
 * Registers the download rewrite rule, allows www.example.com/download/{attachment_id}
 *
 * @author Simon Holloway
 * @return void
 */
add_action( 'init', 'dlp_rewrites' );
function dlp_rewrites()
{
    add_rewrite_rule('proposer-archive/([0-9]+)', 'index.php?api_action=proposer-archive&media_id=$matches[1]', 'top');
    add_rewrite_rule('download/([0-9]+)', 'index.php?api_action=download&media_id=$matches[1]', 'top');

}

/**
 * Registers the media_id and api_action request vars so wp_query will accept them
 *
 * @author John Stiles
 * @return void
 */
add_filter( 'query_vars', 'protected_dlp_query_vars' );
function protected_dlp_query_vars( $query_vars )
{
    $query_vars[] = 'media_id';
    $query_vars[] = 'api_action';
    return $query_vars;
}

/**
 * Checks if the current request is for a download, if it is:
 * Send headers and die while outputting the file
 *
 * @author John Stiles
 * @param object the $wp_query
 * @return void
 */
add_action('pre_get_posts', 'protected_dlp_process');
function protected_dlp_process($wp)
{
    if(is_user_logged_in())
    {
        if( isset($wp->query_vars['media_id']) &&  isset($wp->query_vars['api_action']) && $wp->query_vars['api_action'] === 'proposer-archive' )
        {
            $file = get_attached_file($wp->query_vars['media_id']);

            $filedata = get_post($wp->query_vars['media_id']);
            $mimetype = isset($filedata->post_mime_type) ? $filedata->post_mime_type : 'application/octet-stream';
            /*
            if (current_user_can('hh_staff')) {
                var_dump($file);
                var_dump(is_readable($file));
                var_dump($filedata);
                var_dump('<br />');
                die();
            }
            */
            header('Content-Description: File Transfer');
            header('Content-Type: '. $mimetype);
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            die(file_get_contents($file));
        }

    }

}

/**
 * Registers the media_id and api_action request vars so wp_query will accept them
 *
 * @author Simon Holloway
 * @return void
 */
add_filter( 'query_vars', 'dlp_query_vars' );
function dlp_query_vars( $query_vars )
{
    $query_vars[] = 'media_id';
    $query_vars[] = 'api_action';
    return $query_vars;
}

/**
 * Checks if the current request is for a download, if it is:
 * Send headers and die while outputting the file
 *
 * @author Simon Holloway
 * @param object the $wp_query
 * @return void
 */
add_action('pre_get_posts', 'dlp_process');
function dlp_process($wp)
{
    if( isset($wp->query_vars['media_id']) &&  isset($wp->query_vars['api_action']) && $wp->query_vars['api_action'] === 'proposer-archive' )
    {
        $file = get_attached_file($wp->query_vars['media_id']);

        $filedata = get_post($wp->query_vars['media_id']);
        $mimetype = isset($filedata->post_mime_type) ? $filedata->post_mime_type : 'application/octet-stream';
        /*
        if (current_user_can('hh_staff')) {
            var_dump($file);
            var_dump(is_readable($file));
            var_dump($filedata);
            var_dump('<br />');
            die();
        }
        */
        header('Content-Description: File Transfer');
        header('Content-Type: '. $mimetype);
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        die(file_get_contents($file));
    }

}

/* === Custom editor functions === */
add_filter( 'tiny_mce_before_init', 'pp_change_mce_buttons' );
function pp_change_mce_buttons ($init)
{
	/* Handle new tinymce 4 api in 3.9+*/
	if ( version_compare(get_bloginfo('version'), 3.9, '>='))
	{
		$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';
		$init['toolbar1'] = 'bold,italic,strikethrough,blockquote,|,bullist,numlist,separator,link, unlink,separator,undo,redo,|,spellchecker, pasteword, pastetext,|,formatselect, removeformat, styleselect, wp_fullscreen';
		$init['toolbar2'] = '';
	}
	else
	{
		if ( $init['elements'] == 'simple' )
		{

			$init['theme_advanced_blockformats'] = 'p';
			$init['theme_advanced_buttons1'] = 'bold,italic,strikethrough,blockquote,|,bullist,numlist,separator,link, unlink';
			$init['theme_advanced_buttons2'] = '';
		}
		else
		{
			$init['theme_advanced_blockformats'] = 'p,h2,h3,h4';
			$init['theme_advanced_buttons1'] = 'bold,italic,strikethrough,blockquote,|,bullist,numlist,separator,link, unlink,separator,undo,redo,|,spellchecker, pasteword, pastetext,|,formatselect, styleselect, removeformat, wp_fullscreen';
			$init['theme_advanced_buttons2'] = '';
		}
	}

	return $init;
}

add_filter( 'tiny_mce_before_init', 'pp_mce_before_init' );

function pp_mce_before_init( $settings ) {

	//var_dump($settings);

	$style_formats = array(
		array(
			'title' => 'Lead Text',
			'inline' => 'span',
			'classes' => 'lead'
		),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}

function pp_add_editor_styles() {
	add_editor_style( 'assets/css/admin/pp-editor.css' );
}
add_action( 'admin_init', 'pp_add_editor_styles' );

/**
 * Add logout to the logged in menu
 */
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {

    if($args->theme_location == 'logged_in_nav') {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    }

    return $items;

}

add_filter('the_content', 'paparazzi_force_https');

function paparazzi_force_https($content)
{
    $content = str_replace('http://www.paparazzi-proposals', 'https://www.paparazzi-proposals', $content);

    return $content;
}


/**
 * Disable responsive image support
 */
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

}, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

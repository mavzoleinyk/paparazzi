<?php
/**
 * Remove Woocomerce styling entirely - scary
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false');

/**
 * Woocommerce hooks - make this baby bootsrap!
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


/**
 * Sort out the main container html
 */
add_action('woocommerce_before_main_content', 'b4_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'b4_theme_wrapper_end', 10);

function b4_theme_wrapper_start() {
    echo '<section class="container" role="main">' . "\r\n";
}

function b4_theme_wrapper_end() {
    echo '</section>' . "\r\n";
}


/**
 * Sort the product wrappers
 */
add_action('woocommerce_before_main_content', 'b4_product_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'b4_product_wrapper_end', 10);

function b4_product_wrapper_start() {
    echo '<div class="row">' . "\r\n";
    echo '    <div class="col-xs-12">' . "\r\n";
}

function b4_product_wrapper_end() {
    echo '    </div>' . "\r\n";
    echo '</div>' . "\r\n";
}

/**
 * Sort the product wrappers
 */
add_action('woocommerce_before_cart_table', 'b4_cart_table_wrapper_start', 10);
add_action('woocommerce_after_cart_table', 'b4_cart_table_wrapper_end', 10);

function b4_cart_table_wrapper_start() {
    echo '<div class="table-responsive">' . "\r\n";
}

function b4_cart_table_wrapper_end() {
    echo '</div>' . "\r\n";
}

/*Remove sidebar*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

add_theme_support( 'woocommerce' );

/**
 * Add product type to the body class
 */
add_filter('body_class','b4_woocommerce_body_classes');
function b4_woocommerce_body_classes($classes){
    global $post;
    $product = wc_get_product( $post->ID );
    if ( $product->product_type == 'simple' ) $classes[] = 'simple-product';
    return $classes;
}

/**
 * Show the merchandise on cart
 */
add_action('woocommerce_after_cart_table', 'merchandise');

/**
 * Change the add to cart text on single product pages and archives
 */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +

function woo_custom_cart_button_text() {

    return __( 'Add to proposal', 'woocommerce' );

}

add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +

function woo_archive_custom_cart_button_text() {

    return __( 'Add to proposal', 'woocommerce' );

}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6 );

// Remove Disqus from a product to allow reviews to operate
add_action( 'the_post' , 'stop_disqus_takeover');
remove_action('pre_comment_on_post', 'dsq_pre_comment_on_post');
function stop_disqus_takeover($file) {

    global $post, $wp_query;
    
    if ( 'product' == get_post_type() )
    {
        remove_filter('comments_template', 'dsq_comments_template');
    }
}

/*add_action('pre-comment_on_post', 'block_disqus', 1);

function block_disqus()
{
    echo 'Post type ' . get_post_type();
    if ( 'product' == get_post_type() ) {
        remove_action('pre_comment_on_post', 'dsq_pre_comment_on_post');
    }
}*/

/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'paparazzi_checkout_fields' );

function paparazzi_checkout_fields( $checkout ) {

    echo '<div class="paparazzi-checkout-fields"><h3>' . __('About your proposal') . '</h3>';

    if(is_other_location_product_in_cart())
    {
        woocommerce_form_field( 'other_location', array(
            'type'          => 'text',
            'class'         => array('paparazzi-location-field form-group form-row-wide'),
            'label'         => __("Location"),
            'placeholder'   => __("e.g. New York"),
            'required'      => true
        ), $checkout->get_value( 'other_location' ));
    }

    woocommerce_form_field( 'proposal_date', array(
        'type'          => 'text',
        'class'         => array('paparazzi-date-field form-group form-row-wide'),
        'label'         => __('Choose a date'),
        'placeholder'   => __('Dates'),
        'input_class'   => array('datepicker'),
        'required'      => true
    ), $checkout->get_value( 'paparazzi_date' ));

    woocommerce_form_field( 'partner_name', array(
        'type'          => 'text',
        'class'         => array('paparazzi-partner-field form-group form-row-wide'),
        'label'         => __("Your partner's name"),
        'placeholder'   => __("Partner's name")
    ), $checkout->get_value( 'partner_name' ));


    echo '</div>';

}

/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'paparazzi_checkout_field_process');

function paparazzi_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['proposal_date'] )
        wc_add_notice( __( 'Please enter a proposal date.' ), 'error' );

    if(is_other_location_product_in_cart())
    {
        if (!$_POST['other_location'])
            wc_add_notice(__('Please enter your proposal location'), 'error');
    }
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'paparazzi_checkout_field_update_order_meta' );

function paparazzi_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['proposal_date'] ) ) {
        update_post_meta( $order_id, 'proposal_date', sanitize_text_field( $_POST['proposal_date'] ) );
    }

    if ( ! empty( $_POST['partner_name'] ) ) {
        update_post_meta( $order_id, 'partner_name', sanitize_text_field( $_POST['partner_name'] ) );
    }

    if ( ! empty( $_POST['other_location'] ) ) {
        update_post_meta( $order_id, 'other_location', sanitize_text_field( $_POST['other_location'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'paparazzi_checkout_field_display_admin_order_meta', 10, 1 );

function paparazzi_checkout_field_display_admin_order_meta($order){

    if($proposalDate = get_post_meta( $order->id, 'proposal_date', true ))
    {
        echo '<p><strong>'.__('Proposal date').':</strong> ' . $proposalDate . '</p>';
    }

    if($partnerName = get_post_meta( $order->id, 'partner_name', true ))
    {
        echo '<p><strong>'.__('Partner name').':</strong> ' . $partnerName . '</p>';
    }

    if($otherLocation = get_post_meta( $order->id, 'other_location', true ))
    {
        echo '<p><strong>'.__('Location').':</strong> ' . $otherLocation . '</p>';
    }
}

function pp_add_to_cart_message() {
    if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :
        $message = sprintf( '%s<a href="%s" class="btn btn-default pull-right">%s</a>', __( 'Proposal updated.', 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Browsing', 'woocommerce' ) );
    else :
        $message = sprintf( '%s<a href="%s" class="btn btn-default pull-right">%s</a>', __( 'Proposal updated.' , 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Proposal', 'woocommerce' ) );
    endif;
    return $message;
}
add_filter( 'wc_add_to_cart_message', 'pp_add_to_cart_message' );

/**
 * @param $translation
 * @param $text
 * @param $domain
 * @return string
 */
function add_to_cart_ajax_message( $translation, $text, $domain ) {
    if ( $domain == 'woocommerce' ) { // your domain name
        if ( $text == 'View Cart' ) { // current text that shows
            $translation = 'Proposal updated.'; // The text that you would like to show
        }
    }

    return $translation;
}
add_filter( 'gettext', 'add_to_cart_ajax_message', 10, 3 );

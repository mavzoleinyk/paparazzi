<?php

/**
 * Add a button for request call back
 */

function pp_tinymce_buttons() {

    echo '<a href="#TB_inline?width=500&height=500&inlineId=pp_tinymce_buttons" class="thickbox button"><span class="dashicons-before dashicons-plus-alt"></span>&nbsp;Add Button</a>';

}
add_action('media_buttons', 'pp_tinymce_buttons', 15);

function pp_tinymce_buttons_media() {

    wp_enqueue_script('pp_tinymce_buttons', get_template_directory_uri() . '/assets/js/admin/pp-tinymce-buttons.js', array('jquery'), '1.0', true);

}

add_action('wp_enqueue_media', 'pp_tinymce_buttons_media');

function pp_tinymce_buttons_popup_content() {

    render_template('admin/tinymce/modals/pp-tinymce-buttons');

}

add_action( 'admin_footer',  'pp_tinymce_buttons_popup_content' );

/**
 * Shortcode for pp tinymce button
 * @param $atts
 * @return string
 */
function pp_tinymce_buttons_func( $atts )
{

    $defaults = array(
        'type' => 'call-back',
        'title' => 'Get in touch',
        'description' => 'Let one of our proposal experts plan your proposal',
        'buttontext' => 'Request call back'
    );

    $a = shortcode_atts($defaults, $atts, 'pp-tinymce-button');

    return compile_template('admin/tinymce/shortcodes/pp-tinymce-button', $a);
}

add_shortcode( 'pp-tinymce-button', 'pp_tinymce_buttons_func' );
<?php


/**
 * Add a button for iframe embed
 */

function iframe_embed_button() {

    echo '<a href="#TB_inline?width=500&height=500&inlineId=iframe_embed" class="thickbox button"><span class="dashicons-before dashicons-networking"></span>&nbsp;Add iFrame Modal</a>';

}
add_action('media_buttons', 'iframe_embed_button', 15);

function iframe_embed_button_media() {

    wp_enqueue_script('iframe_embed_button', get_template_directory_uri() . '/assets/js/admin/iframe-embed.js', array('jquery'), '1.0', true);

}

add_action('wp_enqueue_media', 'iframe_embed_button_media');

function iframe_embed_popup_content() {

    render_template('admin/tinymce/modals/iframe-embed');

}

add_action( 'admin_footer',  'iframe_embed_popup_content' );

/**
 * Shortcode for iframe embed
 * @param $atts
 * @return string
 */
function iframe_embed_func( $atts )
{

    $defaults = array(
        'url' => 'http://www.google.com',
        'title' => '',
        'description' => '',
        'id' => substr(md5(microtime()),rand(0,26),5)
    );

    $a = shortcode_atts($defaults, $atts, 'iframe-embed');

    return compile_template('admin/tinymce/shortcodes/iframe-embed', $a);
}

add_shortcode( 'iframe-embed', 'iframe_embed_func' );
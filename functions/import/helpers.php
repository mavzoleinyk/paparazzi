<?php

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

/**
 * Grab the remote file and whack it in the media library
 * @param $url
 * @return int|mixed|object
 */
function create_media_item($url){

    $tmp = download_url( $url );
    $file_array = array(
        'name' => basename( $url ),
        'tmp_name' => $tmp
    );

    // Check for download errors
    if ( is_wp_error( $tmp ) ) {
        @unlink( $file_array[ 'tmp_name' ] );
        return $tmp;
    }

    $id = media_handle_sideload( $file_array, 0 );

    // Check for handle sideload errors.
    if ( is_wp_error( $id ) ) {
        @unlink( $file_array['tmp_name'] );
        return $id;
    }

    return $id;

}

function curl_download($url){

    // is curl installed
    if (!function_exists('curl_init')){
        die('Sorry curl is not installed!');
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}

add_action('admin_init', 'get_legacy_thumbnails');

function get_legacy_thumbnails()
{
    if(current_user_can('manage_options') && isset($_GET['legacy_thumbnails']))
    {
        $args = array (
            'post_type ' => 'post',
            'posts_per_page' => -1
        );

        $posts = get_posts($args);

        foreach($posts as $post)
        {

            if($imageID = get_post_meta($post->ID, '_thumbnail_id', true))
            {
                $imageUrl = 'https://www.paparazzi-proposals.com/?p=' . $imageID;

                $imageOriginal = trim(curl_download($imageUrl));

                //html_printr($imageOriginal);

                $media_id = create_media_item($imageOriginal);

                $hh_thumb = array(
                    'image' => $media_id
                );

                update_post_meta($post->ID, '_hh_thumb', $hh_thumb);

            }
        }

    }
}
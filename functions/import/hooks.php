<?php

//var_dump(unserialize('a:1:{s:9:"galleries";a:17:{i:0;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_6941-120x120.jpg";s:13:"attachment_id";s:3:"221";}i:1;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7008-120x120.jpg";s:13:"attachment_id";s:3:"222";}i:2;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7063-120x120.jpg";s:13:"attachment_id";s:3:"223";}i:3;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7073-120x120.jpg";s:13:"attachment_id";s:3:"224";}i:4;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7088-120x120.jpg";s:13:"attachment_id";s:3:"225";}i:5;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7090-120x120.jpg";s:13:"attachment_id";s:3:"226";}i:6;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7091-120x120.jpg";s:13:"attachment_id";s:3:"227";}i:7;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7095-120x120.jpg";s:13:"attachment_id";s:3:"228";}i:8;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7105-120x120.jpg";s:13:"attachment_id";s:3:"229";}i:9;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7322-120x120.jpg";s:13:"attachment_id";s:3:"230";}i:10;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7109-120x120.jpg";s:13:"attachment_id";s:3:"231";}i:11;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7110-120x120.jpg";s:13:"attachment_id";s:3:"232";}i:12;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7131-120x120.jpg";s:13:"attachment_id";s:3:"233";}i:13;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7362-120x120.jpg";s:13:"attachment_id";s:3:"234";}i:14;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_6825-120x120.jpg";s:13:"attachment_id";s:3:"235";}i:15;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7381-120x120.jpg";s:13:"attachment_id";s:3:"236";}i:16;a:2:{s:5:"image";s:77:"http://www.papthequestion.com/wp-content/uploads/2011/05/IMG_7398-120x120.jpg";s:13:"attachment_id";s:3:"237";}}}'));

/**
 * Hook into import to pull in legacy Paparazzi blog posts
 */

add_action('import_post_meta', 'paparazzi_legacy_post_importer', 10, 3);

function paparazzi_legacy_post_importer($post_id, $key, $value){

    $hh_thumb = '';
    $hh_gallery = '';
    $proposal = '';

    if($key === 'gall_meta') {


        if(!is_array($value))
        {
            //clean the data from $value
            $galleries = substr($value, strpos($value, '"', strpos($value, '"')));
            $galleries = str_lreplace('";', '', $galleries);
            $galleries = trim($galleries, '"');
            $galleries = unserialize($galleries);
        }
        else
        {
            $galleries = $value;
        }

        if (is_array($galleries)) {

            $hh_gallery = array();

            foreach ($galleries as $images) {

                $count = 0;
                $cachedAspectRemainder = '';
                $targetAspect = 1;

                foreach ($images as $image) {

                    if(isset($image['attachment_id']))
                    {

                        $imageID = $image['attachment_id'];

                        $imageUrl = 'https://www.paparazzi-proposals.com/?p=' . $imageID;

                        $imageOriginal = trim(curl_download($imageUrl));

                        //html_printr($imageOriginal);

                        $media_id = create_media_item($imageOriginal);

                        $hh_gallery['images'][] = array(
                            'title' => '',
                            'image' => $media_id
                        );

                        if($mediaImage = wp_get_attachment_url($media_id))
                        {
                            if($imageSize = getimagesize($mediaImage))
                            {
                                $aspect = $imageSize[0] / $imageSize[1];

                                if($aspect > 1)
                                {
                                    $aspectRemainder = $aspect - $targetAspect;
                                }
                                elseif($aspect < 1)
                                {
                                    $aspectRemainder = $targetAspect - $aspect;
                                }
                                else
                                {
                                    $aspectRemainder = 0;
                                }

                                if(empty($hh_thumb) || $aspectRemainder < $cachedAspectRemainder)
                                {
                                    $hh_thumb = array(
                                        'image' => $media_id
                                    );

                                    $cachedAspectRemainder = $aspectRemainder;

                                }

                            }


                        }
                        
                        $count++;

                    }

                }

            }
        }

        if(has_term('Proposals', 'category', $post_id)) {

            $proposal = array(
                'post_title' => get_the_title($post_id),
                'post_type' => 'proposal',
                'post_status' => 'draft'
            );

        }

        // add _hh_gallery meta
        if(!empty($hh_gallery) && count($hh_gallery) > 0)
        {

            // add new post meta
            update_post_meta($post_id, '_hh_gallery', $hh_gallery);

            // Tidy up post meta we don't want from pp legacy
            delete_post_meta($post_id, 'gall_meta');

            echo '<p><strong>Gallery meta imported</strong> and converted to new format for ' . get_the_title($post_id) .'</p>';

            if(!empty($hh_thumb))
            {
                update_post_meta($post_id, '_hh_thumb', $hh_thumb);

                echo '<p><strong>Thumbnail was converted to _hh_thumb</strong> for ' . get_the_title($post_id) .'</p>';
            }

        }

        // Build a proposal if we have posts in category Proposals
        if(!empty($proposal))
        {
            // Add a proposal for this aswell
            $proposal_id = wp_insert_post( $proposal, $wp_error );

            if(count($hh_gallery) > 0)
            {
                // Add proposal gallery
                update_post_meta($proposal_id, '_hh_gallery', $hh_gallery);
            }

            // Add a proposal_id reference for the new proposal so we can get it later
            update_post_meta($post_id, '_pp_auto_proposal', $proposal_id);

            echo '<p>The post was also in the proposals category so <strong>we added a proposal as well</strong> - ' . get_the_title($post_id) .'</p>';

            if(!empty($hh_thumb))
            {
                // add the _hh_thumb for the proposal
                update_post_meta($proposal_id, '_hh_thumb', $hh_thumb);

                echo '<p><strong>The linked Proposal Thumbnail was converted to _hh_thumbs</strong> for ' . get_the_title($post_id) .'</p>';
            }


        }

        // Finally leave a trace that we just imported this for later
        update_post_meta($post_id, '_paparazzi_legacy_post', 'bones');

    }

}

//add_action('import_end', 'remap_post_thumbnails');

/*function remap_post_thumbnails()
{

    $args = array(
        'post_type' => 'post',
        'meta_key' => '_paparazzi_legacy_post',
        'meta_value' => 'bones',
        'posts_per_page' => -1
    );

    if($posts = get_posts($args))
    {
        foreach($posts as $post)
        {
            $hh_thumb = '';

            if (has_post_thumbnail($post->ID)) {

                $thumbnail_id = get_post_thumbnail_id($post->ID);

                $hh_thumb = array(
                    'image' => $thumbnail_id
                );

                echo '<p><strong>Thumbnail was converted to _hh_thumbs</strong> for ' . $post->post_title .'</p>';

            }

            // Add _hh_thumb meta
            if(!empty($hh_thumb))
            {
                update_post_meta($post->ID, '_hh_thumb', $hh_thumb);

                if($proposal_id = get_post_meta($post->ID, '_pp_auto_proposal_from'))
                {
                    update_post_meta($proposal_id, '_hh_thumb', $hh_thumb);

                    echo '<p><strong>The linked Proposal Thumbnail was converted to _hh_thumbs</strong> for ' . $post->post_title .'</p>';
                }
            }

            // Tidy up post meta we don't want from pp legacy
            delete_post_meta($post->ID, '_paparazzi_legacy_post');

        }

    }

}*/


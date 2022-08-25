<?php

/**
 * A process can be triggered via a GET requests from the admin areas by admins that converts any 300dpi images in the media library to 72dpi
 * @author jstiles <john@hutchhouse.com>
 */

add_action('admin_init', 'run_dpi_convertions');

function run_dpi_convertions()
{
    if(current_user_can('manage_options') && isset($_GET['run_dpi_converter']))
    {
        $currentMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit','512M');

        if($images = get_image_attachments())
        {

            foreach($images as $key => $image)
            {

                $imgNoDomain = str_replace(array('http://', 'https://', $_SERVER['HTTP_HOST']), '', $image->guid);

                $imgAbsolutePath = $_SERVER['DOCUMENT_ROOT'] . $imgNoDomain;

                try
                {
                    $img = new Imagick();

                    $img->readImage($imgAbsolutePath);

                    if($img)
                    {
                        $imgResolution = $img->getImageResolution();

                        if(is_array($imgResolution) && ($imgResolution['x'] == '300' && $imgResolution['y'] == '300'))
                        {
                            $img->setImageResolution(72, 72);
                            $img->setCompression(Imagick::COMPRESSION_JPEG);
                            $img->setImageCompressionQuality(80);
                            $img->writeImage($imgAbsolutePath);

                            echo 'Converted: ' . $imgAbsolutePath;
                        }


                    } else {

                        echo 'Skipped: ' . $imgAbsolutePath;

                    }
                }

                catch(ImagickException $e)
                {

                }


            }

        }

        ini_set('memory_limit',$currentMemoryLimit);

    }
}

function get_image_attachments()
{
    $args = array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'file-type',
                'field'    => 'slug',
                'terms'    => array( 'jpeg' )
            )
        )
    );

    return get_posts($args);

}
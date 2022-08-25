<?php
/**
 * Meta helpers
 */

/**
 *
 * @param $meta - alchemy meta object
 * @param $term
 * @author Peter Ingram <peter.ingram@hutchhouse.com>
 */
function the_modules($meta, $term = '') {

    if(!$term)
    {
        $theParent = '';
    }
    else
    {
        $theParent = $term->term_id;
    }

    if($meta->the_meta($theParent))
    {

        $data = array();
        $stickyMenuItems = '';

        while($meta->have_fields('modules'))
        {

            if($type = $meta->get_the_value('type'))
            {

                if($type === 'hero')
                {
                    $title = $meta->get_the_value('hero_title');
                    $id = slugify($title);

                    $data = array(
                        'id' => $id,
                        'image' => getmediaSizeurl($meta->get_the_value('hero_image'), 'viewport'),
                        'title' => $title,
                        'text' => $meta->get_the_value('hero_text'),
                        'bgAlign' => 'middle-center'
                    );

                    if($bgAlign = $meta->get_the_value('bg_align'))
                    {
                        $data['bgAlign'] = $bgAlign;
                    }

                    if(!$term)
                    {
                        $data['pageTitle'] = get_the_title();
                    }
                    else
                    {
                        $data['pageTitle'] = $term->name;
                    }


                    $stickyMenu = array(
                        'id' => $id,
                        'title' => 'Top',
                        'icon' => 'fa-arrow-up'
                    );

                    //$stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                    render_template('modules/hero', $data);
                }
                elseif($type === 'intro')
                {
                    $title = $meta->get_the_value('intro_title');
                    $id = 'intro';

                    $data = array(
                        'id' => $id,
                        'image' => getmediaSizeurl($meta->get_the_value('intro_image'), 'hero'),
                        'title' => $title,
                        'introText' => nl2br($meta->get_the_value('intro_text'))
                    );

                    if($tag = $meta->get_the_value('tag'))
                    {
                        $data['tag'] = $tag;
                    }
                    else
                    {
                        $data['tag'] = 'h1';
                    }

                    $stickyMenu = array(
                        'id' => $id,
                        'title' => $title,
                        'icon' => 'fa-info'
                    );

                    //$stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                    render_template('modules/intro', $data);
                }
                elseif($type === 'wysiwyg')
                {
                    $title = $meta->get_the_value('intro_title');
                    $id = slugify($title);

                    $data = array(
                        'template' => 'center',
                        'title' => $title,
                        'id' => $id
                    );

                    if($template = $meta->get_the_value('template'))
                    {
                        $data['template'] = $template;
                    }

                    $data['content'] = apply_filters('the_content', $meta->get_the_value('wysiwyg'));
                    $data['sidebarContent'] = apply_filters('the_content', $meta->get_the_value('sidebar_wysiwyg'));
                    $data['sidebarPrimary'] = get_meta_link($meta, 'primary_cta', 'primary_internal_link', 'primary_external_link', 'primary_download_link', 'primary_category_link', 'primary_scroller_link', 'primary_modal_link');
                    $data['sidebarDefault'] = get_meta_link($meta, 'default_cta', 'default_internal_link', 'default_external_link', 'default_download_link', 'default_category_link', 'default_scroller_link', 'default_modal_link');

                    $stickyMenu = array(
                        'id' => $id,
                        'title' => $title,
                        'icon' => 'fa-info'
                    );

                    //$stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                    render_template('modules/wysiwyg/' . $data['template'], $data);

                }
                elseif($type === 'benefits')
                {

                    $data = array(
                        'id' => 'benefits'
                    );

                    $limit = 3;

                    for($i = 0; $i < $limit;)
                    {
                        $i++;
                        $data['benefits'][] = array(
                            'title' => $meta->get_the_value('benefit-title-' . $i)
                        );
                    }

                    $stickyMenu = array(
                        'id' => 'benefits',
                        'title' => 'Benefits',
                        'icon' => 'fa-check'
                    );

                    $stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                    render_template('modules/benefits', $data);
                }
                elseif($type === 'proposals')
                {

                    $data = array(
                        'id' => 'proposals',
                        'icon' => 'fa-heart'
                    );

                    if($titleOverride = $meta->get_the_value('proposals_title_override'))
                    {
                        $data['title'] = $titleOverride;
                    }

                    if(empty($term) && $termID = $meta->get_the_value('location'))
                    {
                        if($term = get_term($termID, 'location'))
                        {
                            $data['term'] = $term;
                        }

                        if(empty($data['title']))
                        {
                            $data['title'] = 'Proposals in ' . $term->name;
                        }
                    }
                    else
                    {
                        $data['term'] = $term;

                        if(empty($data['title']))
                        {
                            $data['title'] = 'Proposals in ' . get_locations_title();
                        }
                    }

                    if(empty($data['title']))
                    {
                        $data['title'] = 'Proposals';
                    }

                    $stickyMenu = array(
                        'id' => 'proposals',
                        'title' => 'Proposals',
                        'icon' => 'fa-heart'
                    );

                    $stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                    render_template('modules/proposals/proposals', $data);
                }
                elseif($type === 'blog')
                {
                    $data = array(
                        'id' => 'blog',
                        'title' => 'Blog',
                        'icon' => 'fa-newspaper-o'
                    );

                    if($term)
                    {
                        $data['term'] = $term;
                    }

                    the_blog_nuggets(7, $data);

                    $stickyMenu = array(
                        'id' => 'blog',
                        'title' => 'Blog',
                        'icon' => 'fa-newspaper-o'
                    );

                    $stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                }
				elseif($type === 'packages')
				{
                    $data = array(
                        'id' => 'packages',
                        'icon' => 'fa-diamond'
                    );

                    if($titleOverride = $meta->get_the_value('packages_title_override'))
                    {
                        $data['title'] = $titleOverride;
                    }

                    if(!isset($data['title']))
                    {
                        $data['title'] = 'Packages';
                    }

                    if(!empty($term))
                    {
                        $data['term'] = $term;
                    }
                    else
                    {
                        $data['term'] = false;
                    }

                    $stickyMenu = array(
                        'id' => 'packages',
                        'title' => 'Packages',
                        'icon' => 'fa-diamond'
                    );

                    $stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

					render_template('modules/packages/packages', $data);
				}
				elseif($type === 'locations')
				{

                    $data = Array(
                        'id' => 'locations',
                        'icon' => 'fa-globe',
                        'lon' => $meta->get_the_value('lon'),
                        'lat' => $meta->get_the_value('lat'),
                        'zoom' => $meta->get_the_value('zoom')
                    );

                    if($titleOverride = $meta->get_the_value('locations_title_override'))
                    {
                        $data['title'] = $titleOverride;
                    }

                    if(!isset($data['title']))
                    {
                        $data['title'] = 'Locations';
                    }

                    if($height = $meta->get_the_value('height'))
                    {
                        if($height == 'viewport')
                        {
                            $height = 'jumbotron-viewport';
                        }
                        else
                        {
                            $height = 'map-canvas-' . $height;
                        }

                        $data['height'] = $height;

                    }

                    $stickyMenu = array(
                        'id' => 'locations',
                        'title' => 'Locations',
                        'icon' => 'fa-globe'
                    );


                    $data = get_network_pins($data);

                    if(isset($data['pins']))
                    {
                        $data['pins'] = json_encode($data['pins']);

                        $stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                        render_template('modules/locations', $data);
                    }


				}
                elseif($type === 'steps')
                {
                    $data = array(
                        'id' => 'steps',
                        'title' => 'How it works',
                        'icon' => 'fa-info'
                    );

                    $limit = 3;

                    for($i = 0; $i < $limit;)
                    {
                        $i++;
                        $data['steps'][] = array(
                            'icon' => $meta->get_the_value('steps-icon-' . $i),
                            'title' => $meta->get_the_value('steps-title-' . $i),
                            'description' => apply_filters('the_content', $meta->get_the_value('steps-content-' . $i))
                        );
                    }

                    $stickyMenu = array(
                        'id' => 'steps',
                        'title' => 'How it works',
                        'icon' => 'fa-info'
                    );

                    $stickyMenuItems .= compile_template('modules/sticky-sidenav/sticky-menu-item', $stickyMenu);

                    render_template('modules/steps/steps', $data);

                }

            }
        }
        render_template('modules/sticky-sidenav/sticky-sidenav', array('stickyMenuItems' => $stickyMenuItems));
    }

}

/**
 *
 */
function the_cart_widgets()
{
    global $post, $cartwidgets;

    if($cartwidgets->the_meta($post))
    {
        while($cartwidgets->have_fields('widgets'))
        {
            $data = array();

            if($title = $cartwidgets->get_the_value('title'))
            {
                $data['title'] = $title;

            }

            if($icon = $cartwidgets->get_the_value('icon'))
            {
                $data['icon'] = $icon;

            }

            if($content = apply_filters('the_content', $cartwidgets->get_the_value('content')))
            {
                $data['content'] = $content;
            }

            render_template('cart-widget', $data);
        }
    }
}

/**
 * Return an image url from meta
 * @author john@hutchhouse.com
 * @param $meta - the meta object your wokring with
 */
function get_image($meta, $size, $meta_id = 'image')
{
    if($image_id = $meta->get_the_value($meta_id))
    {
        if($image_url = getmediaSizeurl($image_id, $size))
        {
            return $image_url;
        }
    }
    return false;
}

/**
 * Get a link from a standard link meta component
 *
 * @param object HH_Alchemy meta object
 * @param string key for the multiradio links
 * @param string key for the internal link
 * @param string key for the external link
 * @param string key for the download link
 * @param string key for the scroller link
 * @param string key for the modal link
 * @param string (optional) default key if not set in admin
 * @return string url
 * @author Simon Holloway
 */
function get_meta_link($meta, $type_key = 'link_type', $internal_key = 'internal_link', $external_key = 'external_link', $download_key = 'download_link', $category_key = 'category_link', $scroller_key = 'scroller_link', $modal_key = 'modal_link', $default = false)
{
    $key = $meta->get_the_value($type_key);

    $data = false;

    if(empty($key) && $default !== false)
    {
        $key = $default;
    }

    if( ! empty($key) )
    {
        if($link = $meta->get_the_value($key))
        {
            $buttonText = $meta->get_the_value($key . '_button_text');

            if($key === $internal_key)
            {
                $data = array(
                    'link' => get_permalink($link),
                    'buttonText' => $buttonText
                );

                if(empty($data['buttonText']))
                {
                    $data['buttonText'] = get_the_title($link);
                }

            }
            elseif($key === $external_key)
            {
                $data = array(
                    'link' => $link,
                    'buttonText' => $buttonText
                );

                if(empty($data['buttonText']))
                {
                    $data['buttonText'] = 'Find out more';
                }
            }
            elseif($key === $download_key)
            {
                $data = array(
                    //'link' => get_download_permalink($link),
                    'buttonText' => $buttonText
                );

                if(empty($data['buttonText']))
                {
                    $data['buttonText'] = get_the_title($link);
                }
            }
            elseif($key === $category_key)
            {

                if($term = get_term($link, 'location'))
                {
                    $data = array(
                        'link' => get_term_link($term, 'location'),
                        'buttonText' => $buttonText
                    );

                    if(empty($data['buttonText']))
                    {
                        $data['buttonText'] = $term->name;
                    }
                }

            }
            elseif($key === $scroller_key)
            {

                $data = array(
                    'link' => $link,
                    'role' => 'scroller',
                    'buttonText' => $buttonText
                );

                if(empty($data['buttonText']))
                {
                    $data['buttonText'] = 'More';
                }

            }
            elseif($key === $modal_key)
            {

                $data = array(
                    'link' => $link,
                    'role' => 'modal',
                    'buttonText' => $buttonText
                );

                if(empty($data['buttonText']))
                {
                    $data['buttonText'] = 'More';
                }

            }
        }
    }

    return $data;
}

/**
 * Build the data-pins object with locations from the network
 * @param $data - The core data object for location module
 * @return mixed - $data updated by function
 */
function get_network_pins($data)
{
    global $siteSettings;

    if ($siteCategory = $siteSettings->get_the_value('site-category')) {

        if ($sites = wp_get_sites()) {

            if ($matchedSites = get_matched_sites($sites, $siteCategory)) {

                global $locationMeta;

                foreach($matchedSites as $site)
                {

                    switch_to_blog($site['blog_id']);

                    if($locations = get_prepared_locations())
                    {

                        foreach($locations as $location) {

                            if($locationMeta->the_meta($location->term_id))
                            {

                                if(($lat = $locationMeta->get_the_value('register-lat')) && ($lon = $locationMeta->get_the_value('register-lon')))
                                {
                                    $data['pins'][] = array(
                                        'title' => $location->name,
                                        'desc' => $location->description,
                                        'url' => get_term_link($location),
                                        'lon' => $lon,
                                        'lat' => $lat
                                    );
                                }

                            }
                        }

                    }

                    restore_current_blog();

                    $siteSettings->the_meta();

                }
            }

        }

    }

    return $data;
}
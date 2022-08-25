<?php
/**
 * helpers.php
 *
 * In this file you can declare helper functions that run the logic that templates need to display dynamic content
 *
 * @version 0.0.2       11-09-2013
 * @author David Barker
 * @internal Versioning authors
 *         - Simon Holloway
 *         - John Stiles
 * @copyright Hutchhouse ltd. 10/01/2013
 */


/**
 * Get pagination markup for this theme using a WP_Query object. feel free to edit the function to return diffrent markup
 *
 * @param WP_Query instance object
 * @return string HTML markup
 */
    function get_theme_pagination($oQuery = null)
    {
        $sHtml = '';

        $big = 999999999; // need an unlikely integer

        if($oQuery === null)
        {
            global $wp_query;
            $oQuery = $wp_query;
        }

        //http://codex.wordpress.org/Function_Reference/paginate_links
        $sHtml = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $oQuery->max_num_pages,
            'type' => 'list'
            //'prev_text' => '&laquo;',
            //'next_text' => '&raquo;'
        ) );

        //return the html string to be echoed
        return $sHtml;
    }

    function hh_archive_title($extra = ''){

        global $posts;

        if(!empty($posts))
        {
            $post = $posts[0]; // Hack. Set $post so that the_date() works.
        }
        else
        {
            $post = '';
        }

        if(is_home())
        {
            $postID = get_option('page_for_posts ');
            echo '<h1 class="text-uppercase weight-light"><i class="fa fa-newspaper-o text-danger"></i> ' . get_the_title($postID) . $extra . '</h1>';
        }
        elseif(is_single())
        {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h1 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h1>';
        }
        elseif (is_category())
        {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h2 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h2>';
            echo '<h1 class="text-capitalize">' . single_cat_title('', false) .'</h1>';
        } elseif( is_search() ) {
            echo '<h1>Search Results for &#8216; '.$_GET['s'].' &#8217;</h1>';
        } elseif( is_tag() ) {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h2 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h2>';
            echo '<h1 class="text-capitalize">' . single_tag_title('', false) . '</h1>';
        } elseif (is_post_type_archive()) {
            echo '<h1>'.post_type_archive_title('', false) . $extra . '</h1>';
        } elseif (is_day()) {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h2 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h2>';
            echo '<h1 class="text-capitalize">Archive for '.get_the_time('F jS, Y').'</h1>';
        } elseif (is_month()) {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h2 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h2>';
            echo '<h1 class="text-capitalize">Archive for '.get_the_time('F, Y').'</h1>';
        } elseif (is_year()) {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h2 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h2>';
            echo '<h1 class="text-capitalize">Archive for '.get_the_time('Y').'</h1>';
        } elseif (is_author()) {
            $postID = get_option('page_for_posts ');
            $title = get_the_title($postID);
            echo '<h2 class="text-uppercase weight-light"><a href="' . get_permalink($postID) . '" title="' . $title . '"><i class="fa fa-newspaper-o text-danger"></i> ' . $title . $extra . '</a></h2>';
            echo '<h1 class="text-capitalize">Posts By '.get_the_author().'</h1>';
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
            echo '<h1 class="text-uppercase weight-light"><i class="fa fa-newspaper text-danger"></i> Blog</h1>';
        } elseif (is_tax()) {
            echo '<h1>'.get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))->name.'</h1>';
        } elseif (is_404()) {
            echo '<h1>404</h1>';
        } else {
            echo '<h1>Locations</h1>';
        }

    }


/**
 * Displays the location title
 */

    function locations_title()
    {
        echo get_locations_title();
    }

    function get_locations_title()
    {
        if(is_tax('location'))
        {
            return get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))->name;
        }
        else
        {
            return __('Locations', 'Paparazzi');
        }
    }

/**
 * Render a template from the templates directory
 *
 * Pass a path (relative to the template directory and without the file extension)
 * along with a context to this function.
 * Then the file is included and the context is extracted in to the templates scope.
 * The contents of the file is then outputted.
 *
 * <example>
 *
 * render_template('my-file', array('var' => 123));
 * // now my-theme/templates/my-file.php will be loaded with access to the $var variable that contains 123
 *
 * </example>
 *
 * @param  string   $path
 * @param  array    $context
 * @return void|string
 */
    function render_template($path, $context = array())
    {
        extract($context);
        include get_template_directory() . '/templates/' . $path . '.php';
    }

/**
 * Compile a template from the templates directory
 *
 * Performs the same functionality as render_template
 * but instead of outputting the template, it is returned as a a string
 *
 * <example>
 *
 * $myView = compile_template('my-file', array('var' => 123));
 * // $myView now contains a string with the output from render_template('my-file', array('var' => 123));
 *
 * </example>
 *
 * @param  string   $path
 * @param  array    $context
 * @return void|string
 */
    function compile_template($path, $context = array())
    {
        ob_start();
        render_template($path, $context);
        return ob_get_clean();
    }

/**
 * Get the site title with the correct tag depending on what page it is on
 * @author anthony.fisher@hutchhouse.com
 * @param string, The URL of the site logo
 * @return string, markup for the site title
 */
    function get_formatted_site_title($logoURL)
    {
        /* Get bloginfo name and description meta, display if found */
        $sitename = get_bloginfo('name');

        $tag = is_front_page() ? 1 : 3 ;

        if(!empty($sitename))
        {
            return '<h' . $tag . ' class="site-title">' .
                '	<a href="' . get_bloginfo('url') . '" title="' . $sitename . '">' .
                '		<img src="' . $logoURL . '" alt="' . $sitename . '" class="site-logo" />' .
                '	</a>' .
                '	<span>' . $sitename . '</span>' .
                '   </h' . $tag . '>';
        }
    }

/**
 * Get the site description with the correct tag depending on what page it is on
 * @author anthony.fisher@hutchhouse.com
 * @return string, markup for site description
 */
    function get_formatted_site_description()
    {
        $sitedescription = get_bloginfo('description');

        $tag = is_front_page() ? 1 : 3 ;

        if( ! empty($sitedescription))
        {
            return '<h' . ($tag + 1) . ' class="site-desc">' . $sitedescription . '</h' . ($tag + 1) . '>';
        }
    }

/**
 * @author john@hutchhouse.com
 * @param string of text
 * @return linkified text as string
 */

function linkify_tweet($text)
{
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    // Check if there is a url in the text
    if(preg_match($reg_exUrl, $text, $url)) {
        //echo '<div style="clear:both;"></div><pre>'; print_r($url); echo '</pre>';
        // make the urls hyper links
        $altered = '<a href=" ' .$url[0] . '" target="_blank">' . $url[0] . '</a>';
        return str_replace($url[0], $altered, $text);

    } else {

        // if no urls in the text just return the text
        return $text;

    }
}

/**
 * Twitter User function
 */
function hh_twitter_user($username, $count) {

    if ($tweets = get_transient('hh_tweet')) {
        //echo '<div style="clear:both;"></div><pre>'; print_r($tweets); echo '</pre>';
        return $tweets;
    } else {
        $tmhOAuth = new tmhOAuth(array(
            'consumer_key'    => '3oFIyQ3EcbU1uyC0BmziKw',
            'consumer_secret' => 'bFP4Omi11GLzaP46NSa54ldivwPyIbEE1Dvn9w0W720',
            'user_token'      => '258945561-JLtkZQJJLKYI3nUEHqen8Kw7auXBIdyuPulcRmy0',
            'user_secret'     => 'OOollUG6Eh2h8kJbzvAwJOIpjS6AmYyYScBwh5ztUE'
        ));

        $code = $tmhOAuth->request(
            'GET',
            $tmhOAuth->url('1.1/statuses/user_timeline'),
            array(
                'screen_name' => $username,
                'count' => $count
            )
        );

        if ($code == 200) {
            $tweets = json_decode($tmhOAuth->response['response']);
        } else {
            $tweets = false;
        }

        set_transient('hh_tweet', $tweets, 60*60*24);

        return $tweets;
    }

}

/**
 * Returns tweet html and the overall tweet count as an array (or false if no HTML)
 * @author Anthony Fisher and john@hutchhouse.com
 * @param JSON
 */

function get_the_tweets($json) {

    $html = '';

    $tweet_count = 0;

    foreach($json as $tweet)
    {
        if($tweet_count < 1)
        {
            $count = $tweet->user->statuses_count;
        }

        if(isset($tweet->text))
        {
            if($tweet->entities->media[0]->type == 'photo')
            {
                $html .= '	<img class="img-responsive" src="' . $tweet->entities->media[0]->media_url_https . '" alt="Tweet image" />' . "\r\n";
            }
            $html .= '	<p>' . linkify_tweet($tweet->text) . '</p>' . "\r\n";
        }

        $tweet_count++;
        //
    }

    if(!empty($html))
    {
        return array($html, $count);
    }

    return false;

}

/**
 * Display proposal nuggets
 * @param array $args - Set various parameters - see function
 * @author John Stiles <john@hutchhouse.com>
 */
function the_proposals($args)
{

    extract($args);

    //Defaults
    extract(
        array(
            'limit' => false, //Limit posts per page
            'term' => false, //Pass a term if there is one to filter by
            'slide' => '', //Is this a slide or not
            'veil' => false, //Does this link to a veil or not
            'wrapper' => true, //Does it require a wrapper
            'pages' => false, //Should we show pagination
            'throttle' => false, //Should we throttle the custom sorted results
            'featured' => true //Is this to include featured items in the filter
        )
    , EXTR_SKIP);


    global $post, $hhthumb, $proposalMeta;

    $args = array(
        'post_type' => 'proposal'
    );

    if($featured)
    {
        $args['meta_query'] = array(
            array(
                'key'     => '_pp_featured',
                'value'   => array(1),
                'compare' => 'IN'
            )
        );
    }

    if($pages)
    {
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args['paged'] = $paged;
    }

    if($limit)
    {
        $args['posts_per_page'] = $limit;
    }

    if(is_object($term) && $featured)
    {
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key'     => '_pp_featured',
                'value'   => array(0,1),
                'compare' => 'IN'
            ),
            array(
                'key'     => '_pp_location',
                'value'   => $term->term_id,
                'compare' => '='
            )
        );
    }
    elseif(is_object($term))
    {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $term->taxonomy,
                'field' => 'slug',
                'terms' => $term->slug
            )
        );
    }
    else
    {
        $args['orderby'] = 'rand';
    }

    $proposals = new WP_Query($args);

    if($proposals->have_posts())
    {
        if(is_object($term) && $featured)
        {
            $proposals->posts = customPostSort($proposals->posts, $term, $throttle);

            if($throttle)
            {
                $proposals->found_posts = $throttle;
                $proposals->post_count = $throttle;
            }
        }

        while($proposals->have_posts())
        {
            $proposals->the_post();

            $data = array(
                'title' => $post->post_title,
                'link' => get_permalink($post->ID),
                'wrapper' => $wrapper,
                'veil' => $veil
            );

	        if(!empty($slide))
	        {
		        $data['slide'] = ' data-slide';
	        }

            if($hhthumb->the_meta())
            {
                if($imageID = $hhthumb->get_the_value('image'))
                {
                    if($image = getmediaSizeurl($imageID, 'xxs-max-square'))
                    {
                        $data['image'] = $image;
                    }
                }

            }

            /**
             * Add the package
             */
            if($proposalsMeta = $proposalMeta->the_meta())
            {
                if($proposalsMeta['package'])
                {
                    $productPost = get_post( $proposalsMeta['package']);
                    $data['tag_package'] = $productPost->post_title;
                }

            }

            $locationObject = wp_get_post_terms($post->ID, 'location');

            if(!is_wp_error($locationObject) && !empty($locationObject)) {
                $locationObject = array_shift($locationObject);
                $data['tag_location'] = $locationObject->name;
            }

            $data['href'] = ' href="' . $data['link'] . '"';

            $data['attributes'] = '';

            if($veil)
            {
                $data['href'] = '';

                $data['attributes'] = ' data-target="proposals" data-content="' . $data['link'] . '"';
            }

            $data['tag'] = 'a';

            if($slide)
            {
                $data['href'] = '';

                $data['tag'] = 'div';
            }

            render_template('modules/proposals/proposal-nugget', $data);

        }

        if($pages)
        {
            $pagination = get_theme_pagination($proposals);

            if(!empty($pagination))
            {
                render_template('pagination', array('pagination' => $pagination));
            }
        }

        wp_reset_postdata();
    }

}

/**
 * Search for key=>value pair in array
 * @param $array
 * @param $key
 * @param $value
 * @return array
 */
function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}

function the_blog_nuggets($limit, $data, $throttle = false)
{
    global $post, $hhthumb;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit
    );

    if(is_object($data['term']))
    {
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key'     => '_pp_featured',
                'value'   => array(0,1),
                'compare' => 'IN'
            ),
            array(
                'key'     => '_pp_location',
                'value'   => $data['term']->term_id,
                'compare' => '='
            )
        );
    }

    $posts = new WP_Query($args);

    $count = 0;

    $blogData = array(
        'id' => $data['id'],
        'title' => $data['title'],
        'icon' => $data['icon']
    );

    if($posts->have_posts())
    {

        if(is_object($data['term']))
        {
            $posts->posts = customPostSort($posts->posts, $term, $throttle);

            if($throttle)
            {
                $proposals->found_posts = $throttle;
                $proposals->post_count = $throttle;
            }

        }

        $blogData['firstPost'] = '';

        $blogData['otherPosts'] = '';

        while($posts->have_posts())
        {
            $posts->the_post();

            $data = array(
                'title' => $post->post_title,
                'link' => get_permalink($post->ID),
                'excerpt' => truncateLimit(strip_tags($post->post_content), 100)
            );

            if($hhthumb->the_meta())
            {
                if($imageID = $hhthumb->get_the_value('image'))
                {
                    if($image = getmediaSizeurl($imageID, 'xs-max-wide'))
                    {
                        $data['image'] = $image;
                    }
                }
            }

            if($count < 1)
            {
                $blogData['firstPost'] = compile_template('modules/blog/first-blog-nugget', $data);
            }
            else
            {
                $blogData['otherPosts'] .= compile_template('modules/blog/blog-nugget', $data);
            }

            $count++;

        }

        wp_reset_postdata();
    }

    render_template('modules/blog/blog', $blogData);
}

/**
 * @param $proposalMeta
 * @param $gallery
 * @param $story
 */
function the_proposal() {

    global $post, $proposalMeta, $gallery, $story, $hhthumb, $firstPosition;

    $data = array(
        'title' => $post->post_title
    );

    if($locations = get_the_terms($post->ID, 'location'))
    {
        $data['location'] = array(
            'title' => $locations[0]->name,
            'link' => get_term_link($locations[0], 'location'),
            'slug' => $locations[0]->slug
        );
    }

    if($proposalMeta->the_meta())
    {
        if($packageID = $proposalMeta->get_the_value('package'))
        {
            $data['package'] = array(
                'id' => $packageID,
                'title' => get_the_title($packageID),
                'link' => get_permalink($packageID)
            );
        }

        $args = array(
            'post_type' => 'product',
            'product_cat' => 'extras',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $extras = get_posts($args);

        foreach($extras as $extra)
        {
            if($proposalMeta->get_the_value($extra->post_name))
            {
                $data['extras'] = array();
                $data['extras'][] = array(
                    'title' => $extra->post_title,
                    'link' => get_permalink($extra->ID)
                );
            }
        }
    }

    if($proposalMeta->get_the_value('proposer_link'))
    {
        $type = $proposalMeta->get_the_value('proposer_link');

        if($type == 'archive')
        {
            $fileID = $proposalMeta->get_the_value('archive');

            $data['proposerLink'] = get_proposer_archive_permalink($fileID);
            $data['proposerLinkText'] = 'Download Pictures';

        }
        else
        {

            $data['proposerLink'] = $proposalMeta->get_the_value('external');
            $data['proposerLinkText'] = 'View Pictures';

        }
    }

    $count = 0;

    /**
     * Create the first slide (different from other slides as its the featured image)
     */
    if($image = get_image($hhthumb, 'viewport'))
    {
        $data['slides'] = array();
        $data['menuItems'] = array();

        $data['slides'][$count] = array(
            'id' => $count,
            'position' => 'bottom-center',
            'content' => $post->post_title,
            'image' => $image,
            'bgAlign' => 'middle-left'
        );

        if($thumb = get_image($hhthumb, 'xxs-max-square'))
        {
            $data['menuItems'][$count] = array(
                'id' => $count,
                'title' => $post->post_title,
                'image' => $thumb
            );
        }

        if($firstPosition->the_meta())
        {
            if($bgAlign = $firstPosition->get_the_value('bg_align'))
            {
                $data['slides'][$count]['bgAlign'] = $bgAlign;
            }
        }

        $count++;

    }
    else
    {
        return;
    }


    while ($story->have_fields('slides'))
    {
        $data['slides'][$count] = array();
        $data['menuItems'][$count] = array();

        if($image = get_image($story, 'viewport')) {

            $data['slides'][$count]['id'] = $count;
            $data['menuItems'][$count]['id'] = $count;

            $data['slides'][$count]['image'] = $image;

            if($title = $story->get_the_value('title'))
            {
                $data['menuItems'][$count]['title'] = $title;
            }

            if($position = $story->get_the_value('position'))
            {
                $data['slides'][$count]['position'] = $position;
            }
            else
            {
                $data['slides'][$count]['position'] = 'bottom-left';
            }

            if($content = apply_filters('the_content', $story->get_the_value('wysiwyg')))
            {
                $data['slides'][$count]['content'] = $content;
            }

            if($bgAlign = $story->get_the_value('bg_align'))
            {
                $data['slides'][$count]['bgAlign'] = $bgAlign;
            }
            else
            {
                $data['slides'][$count]['bgAlign'] = 'middle-left';
            }

            if($thumb = get_image($story, 'carousel-menu-item'))
            {
                $data['menuItems'][$count]['image'] = $thumb;
            }

            $count++;
        }
    }

    if(count($data['slides']) > 0)
    {
        render_template('carousel/carousel', $data);
    }

}

function the_gallery($context = 'gallery')
{
    global $post, $gallery;

    $imgHtml = '';

    if($gallery->the_meta())
    {
        $images = array();

        while($gallery->have_fields('images'))
        {
            $data = array(
                'title' => $gallery->get_the_value('title'),
                'image' => get_image($gallery, 'viewport'),
                'thumb' => get_image($gallery, 'gallery-thumb')
            );

            $images[] = $data;

            $imgHtml .= compile_template('gallery/gallery-item', $data);

        }
    }

    if(!empty($imgHtml))
    {
        render_template($context . '/gallery', array('imgHtml' => $imgHtml, 'images' => $images));
    }

}

/**
 * @return bool
 */
function is_proposer()
{
    if(is_user_logged_in())
    {
        global $post, $current_user, $proposalMeta;
        get_currentuserinfo();

        if($proposalMeta->the_meta())
        {
            global $current_user, $proposalMeta;
            get_currentuserinfo();

            if($proposerID = $proposalMeta->get_the_value('customer'))
            {
                if($current_user->ID === $proposerID)
                {
                    return true;
                }
            }
        }

    }

    return false;
}

/**
 * pass the attachment ID, returns the download link url for it.
 *
 * @author John Stiles
 * @param integer
 * @return string
 */
function get_proposer_archive_permalink($id)
{
    return get_bloginfo('url') . '/proposer-archive/' . $id;
}

/**
 * pass the attachment ID, returns the download link url for it.
 *
 * @author Simon Holloway
 * @param integer
 * @return string
 */
function get_download_permalink($id)
{
    return get_bloginfo('url') . '/download/' . $id;
}

/**
 * Display a button
 * @param string $class
 * @param $data - uses keys 'link', 'buttonText' and 'role' for special buttons (modal and scroller)
 */
function the_button($class='btn-default', $data)
{
    $data['class'] = $class;

    //var_dump($data);

    render_template('button', $data);
}

/**
 * @param $string
 * @return string
 */
function niceify($string)
{
    return ucwords(str_replace(array('-', '_'), ' ' , $string));
}

/**
 * @param $string
 * @return mixed
 */
function slugify($string)
{
    return str_replace(' ', '-', strtolower($string));
}


function the_site_navigation($context = '') {

    global $siteSettings;

    $data = array(
        'siteName' => get_bloginfo('name')
    );

    if($siteSettings->the_meta())
    {

        if($siteName = $siteSettings->get_the_value('site-name'))
        {
            $data['siteName'] = $siteName;
        }

        if($siteNumber = $siteSettings->get_the_value('phone-number'))
        {
            $data['phoneNumber'] = $siteNumber;
        }

        if($siteCategory = $siteSettings->get_the_value('site-category'))
        {
            $data['siteCategory'] = $siteCategory;

            if($sites = wp_get_sites())
            {
                if($matchedSites = get_matched_sites($sites, $siteCategory))
                {
                    if(count($matchedSites) > 1)
                    {
                        $data['matchedSites'] = $matchedSites;
                    }
                }
            }
        }
    }

    $mobileDisplay = false;

    if(!empty($context) && $context == 'mobile')
    {
        $mobileDisplay = true;

    }

    if(!empty($data['matchedSites']))
    {
        if($mobileDisplay)
        {

            render_template('navigation/site-mobile', $data);
        }
        else
        {
            render_template('navigation/site', $data);
        }

    }
    else
    {
        if($mobileDisplay)
        {
            render_template('navigation/no-site-mobile', $data);
        }
        else
        {
            render_template('navigation/no-site', $data);
        }
    }

}

function get_matched_sites($sites, $matchCategory){

    if(is_array($sites))
    {

        global $siteSettings;

        foreach($sites as $key => $site)
        {
            switch_to_blog($site['blog_id']);

            if(get_option('blog_public') != '2')
            {
                if($siteSettings->the_meta())
                {
                    if($siteCategory = $siteSettings->get_the_value('site-category'))
                    {
                        if($siteCategory != $matchCategory)
                        {
                            unset($sites[$key]);
                        }
                        elseif($siteName = $siteSettings->get_the_value('site-name'))
                        {
                            $sites[$key]['siteName'] = $siteName;
                        }
                        else
                        {
                            $sites[$key]['siteName'] = get_bloginfo('name');
                        }
                    }

                }
            }
            else
            {
                unset($sites[$key]);
            }

            restore_current_blog();

            $siteSettings->the_meta();

        }

        return $sites;

    }

    return false;
}

function customPostSort($posts, $term, $limit = false)
{
    $firstPosition = array();
    $secondPosition = array();
    $thirdPosition = array();

    foreach($posts as $post)
    {
        $termMatch = false;
        $promoted = false;

        if(get_post_meta($post->ID, '_pp_location', true) == $term->term_id)
        {
            $termMatch = true;
        }
        if(get_post_meta($post->ID, '_pp_featured', true) == 1)
        {
            $promoted = true;
        }

        if($promoted && $termMatch)
        {
            array_push($firstPosition, $post);
        }
        elseif($termMatch)
        {
            array_push($secondPosition, $post);
        }
        else
        {
            array_push($thirdPosition, $post);
        }

    }

    $posts = array_merge($firstPosition, $secondPosition, $thirdPosition);

    if(is_numeric($limit))
    {
        $posts = array_slice($posts, 0, $limit);
    }

    return $posts;
}

/**
 * Get locations ready to be displayed (they have at least one module)
 */
function get_prepared_locations(){

    global $ppModules;

    $locations = array();

    $args = array(
        'hide_empty' => false
    );

    if($allLocations = get_terms('location', $args))
    {
        foreach($allLocations as $locationCandidate)
        {
            if($ppModules->the_meta($locationCandidate->term_id))
            {
                $locations[] = $locationCandidate;
            }
        }
    }

    return $locations;
}

/**
 * Display the mobile location selector
 */
function the_mobile_location_menu($locations){

    if(is_tax('location'))
    {
        $currLocation = get_queried_object();
    }

    if(count($locations) > 0)
    {
        render_template('navigation/locations-mobile', array('locations' => $locations, 'currLocation' => $currLocation));
    }

}

function the_location_extender_toggle($locations)
{
    if(count($locations) > 0)
    {
        render_template('navigation/extender-toggle');
    }
}

/**
 * @param array $locations from get_terms
 */
function the_locations_extender($locations)
{
    if(count($locations) > 0)
    {
        render_template('navigation/locations-extender', array('locations' => $locations));
    }

}

function html_printr($array)
{
    echo '<p><pre>'; print_r($array); echo '</pre></p>';
}

function get_filter_base()
{
    $requestUri = $_SERVER['REQUEST_URI'];

    $requestUriArr = parse_url($requestUri);

    if(!empty($requestUriArr['query']))
    {
        parse_str($requestUriArr['query'], $query_string);
        if(isset($query_string['filter']))
        {
            unset($query_string['filter']);
            unset($query_string['term']);
        }

        $requestUri = strtok($requestUri,'?');

        $count = 0;

        if(!empty($query_string))
        {
            $count = 1;

            foreach($query_string as $key => $query)
            {
                $separator = '&';

                if($count === 1)
                {
                    $separator = '?';
                }

                $requestUri = $requestUri . $separator . $key . '=' . $query;

                $count++;
            }
        }
    }

    $separator = '?';

    if($count > 0)
    {
        $separator = '&';
    }

    return '//' . $_SERVER['HTTP_HOST'] . $requestUri . $separator;
}

/**
 * @param $var
 */
function vd($var)
{
    var_dump($var);

    die();
}

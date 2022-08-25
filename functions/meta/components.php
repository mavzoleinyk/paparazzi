<?php

function the_modules_component()
{

    return array(
        array(
            'id' => 'modules',
            'type' => 'multi',
            'itemname' => 'Module',
            'children' => array(
                array(
                    'id' => 'type',
                    'type' => 'multiradio',
                    'data' => array(
                        'hero' => 'Hero',
                        'intro' => 'Intro',
                        'wysiwyg' => 'Wysiwyg',
                        'proposals' => 'Proposals',
                        'benefits' => 'Benefits',
                        'blog' => 'Blog',
                        'packages' => 'Packages',
                        'locations' => 'Locations',
                        'steps' => 'Steps'
                    ),
                    'children' => array(
                        'hero' => array(
                            array(
                                'title' => 'Hero Image',
                                'type' => 'image',
                                'id' => 'hero_image'
                            ),
                            the_bg_alignment(),
                            array(
                                'title' => 'Hero Title',
                                'type' => 'text',
                                'id' => 'hero_title'
                            ),
                            array(
                                'title' => 'Hero Text',
                                'type' => 'textarea',
                                'id' => 'hero_text'
                            )
                        ),
                        'intro' => array(
                            array(
                                'title' => 'Intro banner',
                                'type' => 'image',
                                'id' => 'intro_image'
                            ),
                            array(
                                'title' => 'Intro Title',
                                'type' => 'text',
                                'id' => 'intro_title'
                            ),
                            array(
                                'title' => 'Title Tag',
                                'type' => 'select',
                                'id' => 'tag',
                                'data' => array(
                                    'h1' => 'H1',
                                    'h2' => 'H2'
                                )
                            ),
                            array(
                                'title' => 'Intro text',
                                'type' => 'textarea',
                                'id' => 'intro_text'
                            )
                        ),
                        'wysiwyg' => array(
                            array(
                                'type' => 'select',
                                'id' => 'template',
                                'title' => 'Layout',
                                'data' => array(
                                    'center' => 'Center',
                                    'sidebar-left' => 'Sidebar Left',
                                    'sidebar-right' => 'Sidebar Right'
                                )
                            ),
                            array(
                                'type' => 'modal_wysiwyg',
                                'id' => 'wysiwyg',
                                'title' => 'Main content'
                            ),
                            array(
                                'type' => 'modal_wysiwyg',
                                'id' => 'sidebar_wysiwyg',
                                'title' => 'Sidebar content'
                            ),
                            get_meta_link_widget('primary_cta', 'primary_internal_link', 'primary_external_link', 'primary_download_link', 'primary_category_link', 'primary_scroller_link', 'primary_modal_link', 'Primary Call to Action'),
                            get_meta_link_widget('default_cta', 'default_internal_link', 'default_external_link', 'default_download_link', 'default_category_link', 'default_scroller_link', 'default_modal_link', 'Default Call to Action'),

                        ),
                        'benefits' => the_benefits_module(3),
                        'proposals' => array(
                            array(
                                'id' => 'proposals_title_override',
                                'type' => 'text',
                                'title' => 'Title Override',
                                'description' => 'By default this module title is <strong>Proposals</strong> or <strong>Proposals in [Location]</strong>'
                            ),
                            array(
                                'type' => 'select',
                                'id' => 'location',
                                'datatype' => 'terms_via_taxonomy',
                                'data' => array('location'),
                                'title' => 'Optional location filter',
                                'description' => 'This is for landing pages and is unused on location pages'
                            ),
                            array(
                                'type' => 'notice',
                                'id' => 'proposals-notice',
                                'title' => 'The module will display the proposals tagged this order:
                                                <ol>
                                                    <li>Featured proposals tagged by location</li>
                                                    <li>Proposals tagged by the location</li>
                                                    <li>Featured proposals</li>
                                                </ol>
                                    '
                            )
                        ),
                        'blog' => array(
                            array(
                                'type' => 'notice',
                                'id' => 'blog-notice',
                                'title' => 'The module will display news tagged this order:
                                                <ol>
                                                    <li>Featured news tagged by location</li>
                                                    <li>News tagged by the location</li>
                                                    <li>Featured news</li>
                                                </ol>
                                    '
                            )
                        ),
                        'packages' => array(
                            array(
                                'id' => 'packages_title_override',
                                'type' => 'text',
                                'title' => 'Title Override',
                                'description' => 'By default this module title is <strong>Packages</strong>'
                            ),
                            array(
                                'type' => 'notice',
                                'id' => 'packages-notice',
                                'title' => 'The module will display the packages builder.'
                            )
                        ),
                        'locations' => array(
                            array(
                                'id' => 'locations_title_override',
                                'type' => 'text',
                                'title' => 'Title Override',
                                'description' => 'By default this module title is <strong>Locations</strong>'
                            ),
                            array(
                                'type' => 'select',
                                'title' => 'Map Height',
                                'id' => 'height',
                                'description' => 'Viewport will take up the screen size the same as the hero module. Standard is 300px',
                                'data' => array(
                                    'viewport' => 'Viewport',
                                    'standard' => 'Standard'
                                )
                            ),
                            array(
                                'type' => 'select',
                                'title' => 'Map Zoom',
                                'id' => 'zoom',
                                'description' => 'The zoom, higher number the more zoomed into the location.',
                                'data' => array(
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                    '7' => '7',
                                    '8' => '8',
                                    '9' => '9',
                                    '10' => '10',
                                    '11' => '11',
                                    '12' => '12',
                                    '13' => '13',
                                    '14' => '14',
                                    '15' => '15',
                                    '16' => '16',
                                    '17' => '17',
                                    '18' => '18',
                                    '19' => '19'
                                )
                            ),
                            array(
                                'id' => 'location-notice',
                                'type' => 'notice',
                                'width' => 'full',
                                'title' => 'Latitude &amp; Longitude',
                                'description' => 'You can get these coordinates easily from this site: <a target="_blank" href="http://www.doogal.co.uk/LatLong.php" >http://www.doogal.co.uk/LatLong.php</a>'
                            ),
                            array(
                                'type' => 'text',
                                'title' => 'Latitude',
                                'description' => 'When you go to a location page this describes where the map will be positioned, eg. (over USA or over new york)',
                                'id' => 'lat'
                            ),
                            array(
                                'type' => 'text',
                                'title' => 'Longitude',
                                'description' => 'When you go to a location page this describes where the map will be positioned, eg. (over USA or over new york)',
                                'id' => 'lon'
                            )
                        ),
                        'steps' => the_steps_module(3)
                    )
                )
            )
        )

    );

}

function the_benefits_module($limit = 2)
{
    $meta = array();

    for ($i = 0; $i < $limit;) {
        $i++;

        $meta[] = array(
            'id' => 'benefit-notice-' . $i,
            'type' => 'notice',
            'title' => 'Benefit ' . $i,
            'width' => 'full'
        );

        $meta[] = array(
            'type' => 'text',
            'id' => 'benefit-title-' . $i,
            'title' => 'Title'
        );
    }

    return $meta;
}

function the_steps_module($limit = 2)
{
    $meta = array();

    for ($i = 0; $i < $limit;) {
        $i++;

        $meta[] = array(
            'id' => 'steps-notice-' . $i,
            'type' => 'notice',
            'title' => 'Step ' . $i,
            'width' => 'full'
        );

        $meta[] = array(
            'type' => 'text',
            'id' => 'steps-icon-' . $i,
            'title' => 'Font Awesome Icon'
        );

        $meta[] = array(
            'type' => 'text',
            'id' => 'steps-title-' . $i,
            'title' => 'Title'
        );

        $meta[] = array(
            'type' => 'redactor',
            'id' => 'steps-content-' . $i,
            'title' => 'Description'
        );
    }

    return $meta;
}
/**
 * Create a usable list of packages prefixed by location
 * @return array
 */
function the_package_selector()
{
    $args = array(
        'post_type' => 'product',
        'meta_key' => '_pp_location',
        'orderby' => 'meta_value',
        'numberposts' => -1
    );

    $data = array();

    if($products = get_posts($args))
    {
        foreach($products as $product)
        {
            $locationName = '';

            if($locationID = get_post_meta($product->ID, '_pp_location', true))
            {

                if($locationID > 0)
                {
                    if($location = get_term_by('id', $locationID, 'location'))
                    {
                        $locationName = $location->name . ' - ';
                    }

                }

            }

            $data[$product->ID] = $locationName . $product->post_title;
        }
    }

    return array(
        'id' => 'package',
        'title' => 'Package used',
        'type' => 'select',
        'data' => $data
    );
}


add_action('init', 'the_proposal_meta', 99);

/**
 *  Build the mea for a proposal
 */
function the_proposal_meta()
{
    global $proposalMeta;

    $proposalMeta = new HH_Alchemy(array(
        'id' => '_hh_proposalMeta',
        'title' => 'Proposal details',
        'context' => 'side',
        'types' => array('proposal'),
        'controls' => array(
            the_package_selector(),
            array(
                'id' => 'extras',
                'title' => 'Extras',
                'type' => 'checkbox',
                'datatype' => 'posts_via_type',
                'data' => array('product'),
                'get_args' => array(
                    'product_cat' => 'extras'
                )
            ),
            the_user_selector('Customer'),
            array(
                'id' => 'proposer_link',
                'type' => 'multiradio',
                'title' => 'Proposer Link',
                'data' => array(
                    'archive' => 'Upload',
                    'external' => 'Link'
                ),
                'children' => array(
                    'archive' => array(
                        'type' => 'file',
                        'id' => 'archive',
                        'description' => 'This is the file that the Proposer will be able to download if logged in'
                    ),
                    'external' => array(
                        'type' => 'text',
                        'id' => 'external',
                        'description' => 'This is the link that the Proposer will be able to click if logged in'
                    )
                )
            )
        )
    ));
}

/**
 * Grab selector for customers (using role = customer)
 * @return array
 */
function the_user_selector($role = false)
{
    $args = array(
        'orderby' => 'user_email'
    );

    if ($role) {
        $args['role'] = $role;
    }

    $user_query = new WP_User_Query($args);

    $users = array();

    if (!empty($user_query->results)) {

        foreach ($user_query->results as $user) {
            $users[$user->ID] = $user->display_name . ' (' . $user->user_email . ')';
        }

    }

    return array(
        'id' => 'customer',
        'title' => 'Customer',
        'type' => 'select',
        'data' => $users
    );

}

/**
 * Display our link options
 * @param string $type_key
 * @param string $internal_key
 * @param string $external_key
 * @param string $download_key
 * @param string $category_key
 * @param string $scroller_key
 * @param string $modal_key
 * @param string $title
 * @return array
 */
function get_meta_link_widget($type_key = 'link_type', $internal_key = 'internal_link', $external_key = 'external_link', $download_key = 'download_link', $category_key = 'category_link', $scroller_key = 'scroller_link', $modal_key = 'modal_link', $title = 'Link')
{
    return array(
        'id' => $type_key,
        'type' => 'multiradio',
        'title' => $title,
        'data' => array(
            $internal_key => 'Internal Link',
            $external_key => 'External Link',
            $download_key => 'Download Link',
            $category_key => 'Location link',
            $scroller_key => 'Module Scroller',
            $modal_key => 'Modal Link',
        ),
        'children' => array(
            $internal_key => array(
                array(
                    'type' => 'text',
                    'id' => $internal_key . '_button_text'
                ),
                array(
                    'type' => 'select',
                    'id' => $internal_key,
                    'datatype' => 'posts_via_type',
                    'data' => array('page', 'product')
                )
            ),
            $external_key => array(
                array(
                    'type' => 'text',
                    'id' => $external_key . '_button_text'
                ),
                array(
                    'type' => 'text',
                    'id' => $external_key
                )
            ),
            $download_key => array(
                array(
                    'type' => 'text',
                    'id' => $download_key . '_button_text'
                ),
                array(
                    'type' => 'select',
                    'id' => $download_key,
                    'datatype' => 'posts_via_type',
                    'data' => array('attachment'),
                    'get_args' => array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'file-type',
                                'field'    => 'slug',
                                'terms'    => array( 'image' ),
                                'operator' => 'NOT IN',
                            )
                        )
                    )
                )
            ),
            $category_key => array(
                array(
                    'type' => 'text',
                    'id' => $category_key . '_button_text'
                ),
                array(
                    'type' => 'select',
                    'id' => $category_key,
                    'datatype' => 'terms_via_taxonomy',
                    'data' => array('location')
                )
            ),
            $scroller_key => array(
                array(
                    'type' => 'text',
                    'id' => $scroller_key . '_button_text'
                ),
                array(
                    'type' => 'text',
                    'id' => $scroller_key
                )
            ),
            $modal_key => array(
                array(
                    'type' => 'text',
                    'id' => $modal_key . '_button_text'
                ),
                array(
                    'type' => 'select',
                    'id' => $modal_key,
                    'data' => array(
                        'call-me-back-modal' => 'Call back modal'
                    )
                )
            )
        )
    );
}


/**
 * Build the site categories for each site in settings
 * @return array
 */
function the_site_categories()
{
    $site_categories = array(
        '1' => 'Mainstream',
        '2' => 'LGBT'
    );

    return array(
        'type' => 'select',
        'id' => 'site-category',
        'title' => 'Site Category',
        'description' => 'This will determine which menus this site appears in. Leave blank to stop the site appearing in any site menu',
        'data' => $site_categories
    );
}

function the_bg_alignment()
{
    return array(
        'id' => 'bg_align',
        'type' => 'select',
        'title' => 'Image position on small screens',
        'data' => array(
            'top-left' => 'Top Left',
            'top-center' => 'Top Center',
            'top-right' => 'Top Right',
            'middle-left' => 'Middle Left',
            'middle-center' => 'Middle Center',
            'middle-right' => 'Middle Right',
            'bottom-left' => 'Bottom Left',
            'bottom-center' => 'Bottom Center',
            'bottom-right' => 'Bottom Right'
        )
    );
}

<?php
// Create custom post types
if (class_exists('HH_Post_Type')):
    create_my_post_types();
endif;

function create_my_post_types()
{

    $HH_Post_Types = new HH_Post_Type();

    $HH_Post_Types->new_post_types(array(
        array(
            'id' => 'proposal',
            'plural' => 'Proposals',
            'singular' => 'Proposal',
            'group' => 2,
            'args' => array(
                'menu_icon' => 'dashicons-randomize',
                'supports' => array('title'),
                'rewrite' => array('slug' => 'proposals')
            )
        ),
        array(
            'id' => 'offer',
            'plural' => 'Offers',
            'singular' => 'Offer',
            'group' => 2,
            'args' => array(
                'menu_icon' => 'dashicons-carrot',
                'supports' => array('title', 'editor'),
                'rewrite' => array('slug' => 'offers')
            )
        )
        /*array(
            'id' => 'site-link',
            'plural' => 'Site Links',
            'singular' => 'Site Link',
            'group' => 2,
            'args' => array(
                'menu_icon' => 'dashicons-admin-site',
                'supports' => array('title')
            )
        )*/
    ));
}

// Create custom taxonomies
add_action('init', 'create_my_taxonomies', 1);

function create_my_taxonomies()
{

    register_taxonomy(
        'location',
        array('proposal', 'offer', 'post', 'product'),
        array(
            'public' => true,
            'labels' => array(
                'name' => __('Locations'),
                'singular_name' => __('Location'),
                'add_new' => __('Add New Location'),
                'add_new_item' => __('Add Location'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit'),
                'new_item' => __('New Location'),
                'not_found' => __('No Locations Found'),
            ),
            'hierarchical' => true,
            'show_admin_column' => true
        )
    );
}
<?php

/**
 * HH_Alchemy structure
 */

/*************************************************************
 *                         Alchemy                           *
 *************************************************************/

if (class_exists('HH_Alchemy')):

    $hhthumb = new HH_Alchemy(array(
        'id' => '_hh_thumb',
        'title' => 'Featured Image',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('post', 'proposal'),
        'controls' => array(
            array(
                'id' => 'image',
                'type' => 'image'
            )
        )
    ));

    $hhfeatured = new HH_Alchemy(array(
        'id' => '_featured',
        'title' => 'Featured Content',
        'mode' => WPALCHEMY_MODE_EXTRACT,
        'prefix' => '_pp_',
        'types' => array('post', 'proposal'),
        'context' => 'side',
        'controls' => array(
            array(
                'id' => 'feature',
                'type' => 'checkbox',
                'data' => array(
                    'featured' => 'Promote this'
                )
            )
        )
    ));

    $landingPageModules = new HH_Alchemy(array(
        'id' => '_hh_landing_modules',
        'title' => 'Modules',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('page'),
        'include_template' => array('page-landing.php'),
        'controls' => the_modules_component()
    ));


    $cartwidgets = new HH_Alchemy(array(
        'id' => '_hh_cartwidgets',
        'title' => 'Widgets',
        'types' => array('page'),
        'include_template' => array('page-cart.php'),
        'controls' => array(
            array(
                'id' => 'widgets',
                'type' => 'multi',
                'children' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => 'Title'
                    ),
                    array(
                        'id' => 'icon',
                        'type' => 'text',
                        'title' => 'Font Awesome Icon'
                    ),
                    array(
                        'id' => 'content',
                        'type' => 'redactor'
                    )
                )
            )
        )
    ));

    $firstPosition = new HH_Alchemy(array(
        'id' => '_hh_first_position',
        'title' => 'Featured Image alignment',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('proposal'),
        'controls' => array(
            the_bg_alignment()
        )
    ));

    $story = new HH_Alchemy(array(
        'id' => '_hh_story',
        'title' => 'Story',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('proposal'),
        'controls' => array(
            array(
                'id' => 'slides',
                'type' => 'multi',
                'itemname' => 'Slide',
                'children' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'width' => 'full'
                    ),
                    array(
                        'id' => 'position',
                        'type' => 'select',
                        'title' => 'Text Position over the image',
                        'width' => 'full',
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
                    ),
                    array(
                        'id' => 'image',
                        'type' => 'image'
                    ),
                    the_bg_alignment(),
                    array(
                        'id' => 'wysiwyg',
                        'type' => 'modal_wysiwyg'
                    )
                )
            )
        )
    ));

    $gallery = new HH_Alchemy(array(
        'id' => '_hh_gallery',
        'title' => 'Gallery',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('proposal', 'post'),
        'controls' => array(
            array(
                'id' => 'images',
                'type' => 'multi',
                'itemname' => 'Photo',
                'children' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'width' => 'full'
                    ),
                    array(
                        'id' => 'image',
                        'type' => 'image',
                        'width' => 'full'
                    )
                )
            )
        )
    ));

    /**
     * Will return a list of sites names per ID
     * @author Peter Ingram <peter.ingram@hutchhouse.com>
     */
    function site_names_per_id() {
        $sites = [];
        foreach(wp_get_sites() as $site) {
            $sites[$site['blog_id']] = get_blog_option($site['blog_id'], 'blogname');
        }
        return $sites;
    }

    $ppSiteLinks = new HH_Alchemy(array(
        'id' => '_pp_site_links',
        'title' => 'Site Links',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('site-link'),
        'controls' => array(
            array(
                'type' => 'select',
                'title' => 'Sites',
                'description' => 'Select the site to link to this title (the title will display within the uber nav)',
                'id' => 'site-list',
                'data' => site_names_per_id()
            )
        )
    ));


endif;

if (class_exists('HH_Settings')):

    $oCallMeBackSettings = new HH_Settings(array(
        'id' => '_hh_call_me_back_settings',
        'title' => 'Call Me Back Settings',
        'controls' => array(
            array(
                'type' => 'text',
                'id' => 'title',
                'title' => 'Title'
            ),
            array(
                'id' => 'wysiwyg',
                'type' => 'wysiwyg',
                'title' => 'Content'
            )
        )
    ));

    $siteSettings = new HH_Settings(array(
        'id' => '_hh_site_settings',
        'title' => 'Site Settings',
        'controls' => array(
            array(
                'type' => 'text',
                'id' => 'phone-number',
                'title' => 'Site Contact Number',
                'description' => 'This contact number is set per site'
            ),
            array(
                'type' => 'text',
                'id' => 'site-name',
                'title' => 'Site Name',
                'description' => 'This name will be displayed within the Uber Navigation site menu (e.g. USA)'
            ),
            the_site_categories()
        )
    ));

endif;

if (class_exists('HH_Tax_Meta')):

    $locationMeta = new HH_Tax_Meta(array(
        'id' => '_pp_locationMeta',
        'title' => 'Map details',
        'types' => array('location'),
        'controls' => array(
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
                'description' => 'This is the pin point of this location to put the pin onto the map',
                'id' => 'register-lat'
            ),
            array(
                'type' => 'text',
                'title' => 'Longitude',
                'description' => 'This is the pin point of this location to put the pin onto the map',
                'id' => 'register-lon'
            )
        )

    ));

    $ppModules = new HH_Tax_Meta(array(
        'id' => '_pp_modules',
        'title' => 'Modules',
        'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
        'types' => array('location'),
        'controls' => the_modules_component()
    ));


endif;

if (class_exists('HH_User_Meta')):

    /*
    $oUsermeta = new HH_User_Meta(array(
        'id' => '_hh_usermeta',
        'title' => 'Extra User Meta',
        'sectionHeight' => 150,
        'mode' => WPALCHEMY_MODE_EXTRACT,
        'prefix' => '_hh_',
        'controls' => $aTestcontrols
    ));
    */

endif;

?>
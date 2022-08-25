<footer class="page-footer margin-top-reg">

    <div class="container">

        <div class="row">

            <div class="col-xxs-12 col-xs-6 col-sm-3">
                <h3>Useful Links</h3>
                <?php
                // Load footer nav
                wp_nav_menu(array(
                    'theme_location'  => 'useful_links_nav',
                    'container'       => false,
                    'menu_class'      => 'footer-menu',
                    'fallback_cb'     => false
                ));
                ?>
            </div>

            <div class="col-xxs-12 col-xs-6 col-sm-3">
                <?php echo FrmFormsController::show_form(false, 'wkhh95', true, true); ?>
            </div>

            <div class="col-xxs-12 col-xs-6 col-sm-3">
                <h3>Follow Us</h3>
                <?php
                // Load footer nav
                wp_nav_menu(array(
                    'theme_location'  => 'social_nav',
                    'container'       => false,
                    'fallback_cb'     => false
                ));
                ?>
            </div>

            <div class="col-xxs-12 col-xs-6 col-sm-3">
                <h3>Latest Tweets</h3>
                <?php
                if($tweets = hh_twitter_user('proposalpics', 1))
                {
                    if($tweetinfo = get_the_tweets($tweets))
                    {
                        echo $tweetinfo[0];
                    }
                }
                ?>
            </div>


        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-8 copyright text-center">

                <p class="text-left pull-left">&copy; Copyright <?php echo date('Y'); ?> Paparazzi Proposals

                    <?php
                    $args = array(
                        'container' => false,
                        'echo'  => false,
                        'items_wrap'    => '%3$s',
                        'before'    => ' | ',
                        'theme_location'  => 'footer_nav'
                    );

                    if($footerMenu = wp_nav_menu($args))
                    {
                        echo strip_tags($footerMenu, '<a>' );
                    }
                    ?>

                </p>

            </div>
            
            <div class="col-xs-12 col-sm-4 text-right endorsement">
                
                <a href="http://www.hutchhouse.com" target="_blank" title="Website User Experience, Interface Design and Development">
                    
                    <h6>Site made by</h6>
                    
                    <figure>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/web-design-and-development-by-hutchhouse.png" alt="Web design and development by Hutchhouse"/>
                    </figure>

                </a>
                
                
            </div>

        </div>

    </div>

</footer>
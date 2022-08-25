<!-- Uber Nav Non-mobile -->
<nav class="navbar navbar-default navbar-uber text-uppercase hidden-xs small" role="navigation">
    <div class="container">
        <?php the_site_navigation(); ?>
        <?php wp_nav_menu(array(
            'theme_location' => 'main_nav',
            'container' => false,
            'menu_class' => 'nav navbar-nav navbar-right hidden-xs',
            'fallback_cb' => false,
            'walker' => new wp_bootstrap_navwalker()
        ));
        ?>
    </div>
</nav>
<!-- /.Uber Nav Non-mobile -->


<!-- Uber Nav Mobile -->
<nav class="navbar navbar-default navbar-uber navbar-uber-mobile hidden-lg hidden-md hidden-sm text-uppercase" role="navigation">

    <div class="container">

        <?php the_site_navigation('mobile'); ?>

    </div>

</nav>
<!-- /.Uber Nav -->

<?php $locations = get_prepared_locations(); ?>

<div data-role="affix-container" class="affix-container">

    <!-- Main Nav -->
    <nav id="main-nav-wrapper" data-spy="affix" data-offset-top class="navbar navbar-default text-uppercase small" role="navigation">

        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="btn btn-action navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <?php echo get_formatted_site_title(get_template_directory_uri() . '/assets/img/pp-logo-small.png'); ?>
                </div>

                <?php the_location_extender_toggle($locations); ?>

                <?php the_mobile_location_menu($locations); ?>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-nav">

                <?php if (!is_user_logged_in()): ?>

                    <?php wp_nav_menu(array(
                        'theme_location' => 'logged_out_nav',
                        'container' => false,
                        'menu_class' => 'nav navbar-nav navbar-right hidden-xs account-menu-nav',
                        'fallback_cb' => false
                    ));
                    ?>

                <?php endif; ?>

                <?php
                /**
                 * If the user is logged in
                 */
                if (is_user_logged_in()):
                    global $current_user;
                    get_currentuserinfo();
                    ?>

                    <ul class="nav navbar-nav navbar-right hidden-xs">
                        <li class="dropdown dropdown-small text-center">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <?php print $current_user->display_name; ?>
                                <button class="btn btn-action btn-sm btn-caret"><span class="caret"></span></button>
                            </a>

                            <?php wp_nav_menu(array(
                                'theme_location' => 'logged_in_nav',
                                'container' => false,
                                'menu_class' => 'dropdown-menu',
                                'fallback_cb' => false
                            ));
                            ?>

                        </li>
                    </ul>

                    <?php

                    wp_nav_menu(array(
                        'theme_location' => 'logged_in_nav',
                        'container' => false,
                        'menu_class' => 'nav navbar-nav hidden-lg hidden-md hidden-sm account-menu-nav',
                        'fallback_cb' => false
                    ));
                    ?>


                <?php endif; ?>

                <?php

                global $woocommerce;

                if ($woocommerce->cart->cart_contents_count > 0):$cartPageUrl = $woocommerce->cart->get_cart_url();

                    ?>

                    <a href="<?php echo $cartPageUrl; ?>" class="btn btn-primary navbar-btn btn-sm menu-item btn-margin-right pull-right hidden-xs">My Proposal</a>

                    <a href="<?php echo $cartPageUrl; ?>" class="btn btn-primary navbar-btn btn-sm pull-right visible-xs">My Proposal</a>


                <?php endif; ?>

                <!--	add navbar     -->

                <?php wp_nav_menu(array(
                    'theme_location' => 'main_nav',
                    'container' => false,
                    'menu_class' => 'nav navbar-nav hidden-lg hidden-md hidden-sm site-menu-nav',
                    'fallback_cb' => false,
                ));
                ?>

                <?php /*php endif; */?>

            </div>

            <?php the_locations_extender($locations); ?>

        </div>

    </nav>

</div>
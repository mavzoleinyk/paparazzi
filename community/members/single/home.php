<div id="buddypress">

	<?php do_action( 'bp_before_member_home_content' ); ?>

    <div class="row">

        <div class="col-xs-12">

            <h1><?php b4_bp_title(); ?></h1>

        </div>

    </div>

	<!--<div id="item-nav" class="row">

        <div class="col-xs-12">

            <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">

                <ul class="nav nav-tabs">

                    <?php // Alternative bp_nav_menu(); ?>

                    <?php b4_bp_get_displayed_user_nav(); ?>

                    <?php do_action( 'bp_member_options_nav' ); ?>

                </ul>
            </div>

        </div>

	</div><!-- #item-nav -->

    <!--<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#b4-member-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="b4-member-nav">
                <ul class="nav navbar-nav">
                    <?php b4_bp_get_displayed_user_nav(); ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Options <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php do_action( 'bp_member_options_nav' ); ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>-->

	<div id="item-body" class="row" role="main">

        <div class="col-xs-12">

            <?php do_action( 'bp_before_member_body' );

            if ( b4_is_view_profile() ) :

                the_member_profile();
                the_member_content();


            elseif ( bp_is_user_blogs() ) :
                bp_get_template_part( 'members/single/blogs'    );

            elseif ( bp_is_user_friends() ) :
                bp_get_template_part( 'members/single/friends'  );

            elseif ( bp_is_user_groups() ) :
                bp_get_template_part( 'members/single/groups'   );

            elseif ( bp_is_user_messages() ) :
                bp_get_template_part( 'members/single/messages' );

            elseif ( bp_is_user_profile() ) :
                bp_get_template_part( 'members/single/profile'  );

            elseif ( bp_is_user_forums() ) :
                bp_get_template_part( 'members/single/forums'   );

            elseif ( bp_is_user_notifications() ) :
                bp_get_template_part( 'members/single/notifications' );

            elseif ( bp_is_user_settings() ) :
                bp_get_template_part( 'members/single/settings' );

            // If nothing sticks, load a generic template
            else :
                bp_get_template_part( 'members/single/plugins'  );

            endif;

            do_action( 'bp_after_member_body' ); ?>

        </div>



	</div><!-- #item-body -->

	<?php do_action( 'bp_after_member_home_content' ); ?>

</div><!-- #buddypress -->

<?php

/**
 * BuddyPress - Users Activity
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="row">

    <div class="col-xs-12">

        <div class="item-list-tabs no-ajax" id="subnav" role="navigation">

            <ul class="nav nav-pills">

                <?php bp_get_options_nav(); ?>

                <li id="activity-filter-select" class="last">
                    <label for="activity-filter-by"><?php _e( 'Show:', 'buddypress' ); ?></label>
                    <select id="activity-filter-by">
                        <option value="-1"><?php _e( '&mdash; Everything &mdash;', 'buddypress' ); ?></option>

                        <?php b4_bp_activity_show_filters(); ?>

                        <?php do_action( 'bp_member_activity_filter_options' ); ?>

                    </select>
                </li>
            </ul>
        </div><!-- .item-list-tabs -->

    </div>
</div>


<?php do_action( 'bp_before_member_activity_post_form' ); ?>

<?php
if ( is_user_logged_in() && bp_is_my_profile() && ( !bp_current_action() || bp_is_current_action( 'just-me' ) ) )
	bp_get_template_part( 'activity/post-form' );

do_action( 'bp_after_member_activity_post_form' );
do_action( 'bp_before_member_activity_content' ); ?>

<div class="activity" role="main">

	<?php bp_get_template_part( 'activity/activity-loop' ) ?>

</div><!-- .activity -->

<?php do_action( 'bp_after_member_activity_content' ); ?>

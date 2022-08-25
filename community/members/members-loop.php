<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<div id="pag-top" class="row">

        <div class="col-xs-12">

            <div class="pagination">

                <div class="pag-count" id="member-dir-count-top">

                    <?php bp_members_pagination_count(); ?>

                </div>

                <div class="pagination-links" id="member-dir-pag-top">

                    <?php bp_members_pagination_links(); ?>

                </div>

            </div>

        </div>

	</div>

	<?php do_action( 'bp_before_directory_members_list' ); ?>

    <div class="row">

        <div class="col-xs-12">

            <ul id="members-list" class="item-list item-list-connections list-group" role="main">

                <?php while ( bp_members() ) : bp_the_member(); ?>

                    <li class="clearfix list-group-item">

                        <div class="item-avatar pull-left">
                            <a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a>
                        </div>

                        <div class="item pull-left">

                            <div class="list-group-item-heading">
                                <a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>

                                <?php if ( bp_get_member_latest_update() ) : ?>

                                    <span class="update"> <?php bp_member_latest_update(); ?></span>

                                <?php endif; ?>

                            </div>

                            <div class="item-meta list-group-item-text"><span class="activity"><?php bp_member_last_active(); ?></span></div>

                            <?php do_action( 'bp_directory_members_item' ); ?>

                            <?php
                            /***
                             * If you want to show specific profile fields here you can,
                             * but it'll add an extra query for each member in the loop
                             * (only one regardless of the number of fields you show):
                             *
                             * bp_member_profile_data( 'field=the field name' );
                             */
                            ?>
                        </div>

                        <div class="action pull-right">

                            <?php do_action( 'bp_directory_members_actions' ); ?>

                        </div>

                    </li>

                <?php endwhile; ?>

            </ul>

        </div>
    </div>



	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>

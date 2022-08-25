<?php do_action( 'bp_before_group_invites_content' ); ?>

<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_loggedin_user_id() ) ) : ?>

	<ul id="group-list" class="invites item-list list-group" role="main">

		<?php while ( bp_groups() ) : bp_the_group(); ?>

			<li class="clearfix list-group-item">

				<div class="item-avatar pull-left">
					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?></a>
				</div>

                <div class="item pull-left">
                    <h4 class="list-group-item-heading"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a><span class="small"> - <?php printf( _nx( '1 member', '%d members', bp_get_group_total_members( false ),'Group member count', 'buddypress' ), bp_get_group_total_members( false )  ); ?></span></h4>

                    <p class="desc list-group-item-text">
                        <?php bp_group_description_excerpt(); ?>
                    </p>
                </div>



				<?php do_action( 'bp_group_invites_item' ); ?>

				<div class="action pull-right">
					<a class="button accept" href="<?php bp_group_accept_invite_link(); ?>"><?php _e( 'Accept', 'buddypress' ); ?></a> &nbsp;
					<a class="button reject confirm" href="<?php bp_group_reject_invite_link(); ?>"><?php _e( 'Reject', 'buddypress' ); ?></a>

					<?php do_action( 'bp_group_invites_item_action' ); ?>

				</div>
			</li>

		<?php endwhile; ?>
	</ul>

<?php else: ?>

	<div id="message" class="info" role="main">
		<p><?php _e( 'You have no outstanding group invites.', 'buddypress' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_group_invites_content' ); ?>
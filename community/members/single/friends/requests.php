<?php do_action( 'bp_before_member_friend_requests_content' ); ?>

<?php if ( bp_has_members( 'type=alphabetical&include=' . bp_get_friendship_requests() ) ) : ?>

	<div id="pag-top" class="pagination no-ajax">

		<div class="pag-count" id="member-dir-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<ul id="friend-list" class="item-list list-group" role="main">
		<?php while ( bp_members() ) : bp_the_member(); ?>

			<li id="friendship-<?php bp_friend_friendship_id(); ?>" class="clearfix list-group-item">

				<div class="item-avatar pull-left">
					<a href="<?php bp_member_link(); ?>"><?php bp_member_avatar(); ?></a>
				</div>

				<div class="item pull-left">
					<div class="list-group-item-heading"><a href="<?php bp_member_link(); ?>"><?php bp_member_name(); ?></a></div>
					<div class="list-group-item-text"><span class="activity"><?php bp_member_last_active(); ?></span></div>
				</div>

				<?php do_action( 'bp_friend_requests_item' ); ?>

				<div class="action pull-right">

					<a class="button btn btn-success accept" href="<?php bp_friend_accept_request_link(); ?>"><i class="fa fa-check"></i> <?php _e( 'Accept', 'buddypress' ); ?></a> &nbsp;
					<a class="button btn btn-danger reject" href="<?php bp_friend_reject_request_link(); ?>"><i class="fa fa-times"></i> <?php _e( 'Reject', 'buddypress' ); ?></a>

					<?php do_action( 'bp_friend_requests_item_action' ); ?>
				</div>
			</li>

		<?php endwhile; ?>
	</ul>

	<?php do_action( 'bp_friend_requests_content' ); ?>

	<div id="pag-bottom" class="pagination no-ajax">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info alert alert-info">
		<p><?php _e( 'You have no pending friendship requests.', 'buddypress' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_friend_requests_content' ); ?>

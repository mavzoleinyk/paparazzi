<div id="message" class="alert alert-info">

	<?php if ( bp_is_current_action( 'unread' ) ) : ?>

		<?php if ( bp_is_my_profile() ) : ?>

			<p><i class="fa fa-info"></i> <?php _e( 'You have no unread notifications.', 'buddypress' ); ?></p>

		<?php else : ?>

			<p><i class="fa fa-info"></i> <?php _e( 'This member has no unread notifications.', 'buddypress' ); ?></p>

		<?php endif; ?>
			
	<?php else : ?>
			
		<?php if ( bp_is_my_profile() ) : ?>

			<p><i class="fa fa-info"></i> <?php _e( 'You have no notifications.', 'buddypress' ); ?></p>

		<?php else : ?>

			<p><i class="fa fa-info"></i> <?php _e( 'This member has no notifications.', 'buddypress' ); ?></p>

		<?php endif; ?>

	<?php endif; ?>

</div>

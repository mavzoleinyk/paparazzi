<?php

/**
 * BuddyPress - Users Messages
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs no-ajax" id="subnav" role="navigation">

	<ul class="nav nav-pills">

		<?php b4_bp_get_options_nav(); ?>

	</ul>

</div><!-- .item-list-tabs -->

<div class="row">

    <div class="col-xs-12">

        <?php if ( bp_is_messages_inbox() || bp_is_messages_sentbox() ) : ?>

            <?php b4_bp_message_search_form(); ?>

        <?php endif; ?>

    </div>

</div>

<?php
switch ( bp_current_action() ) :

	// Inbox/Sentbox
	case 'inbox'   :
	case 'sentbox' :
		do_action( 'bp_before_member_messages_content' ); ?>

		<div class="messages" role="main">
			<?php bp_get_template_part( 'members/single/messages/messages-loop' ); ?>
		</div><!-- .messages -->

		<?php do_action( 'bp_after_member_messages_content' );
		break;

	// Single Message View
	case 'view' :
		bp_get_template_part( 'members/single/messages/single' );
		break;

	// Compose
	case 'compose' :
		bp_get_template_part( 'members/single/messages/compose' );
		break;

	// Sitewide Notices
	case 'notices' :
		do_action( 'bp_before_member_messages_content' ); ?>

		<div class="messages" role="main">
			<?php bp_get_template_part( 'members/single/messages/notices-loop' ); ?>
		</div><!-- .messages -->

		<?php do_action( 'bp_after_member_messages_content' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;

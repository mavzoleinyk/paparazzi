<form action="<?php bp_messages_form_action('compose' ); ?>" method="post" id="send_message_form" class="standard-form" role="main" enctype="multipart/form-data">

	<?php do_action( 'bp_before_messages_compose_content' ); ?>


    <div class="form-group">

        <label for="send-to-input"><?php _e("Send To (Username or Friend's Name)", 'buddypress' ); ?></label>

        <ul class="first acfb-holder">
            <li>
                <?php bp_message_get_recipient_tabs(); ?>
                <input type="text" name="send-to-input" class="form-control send-to-input" id="send-to-input" />
            </li>
        </ul>

    </div>

	<?php if ( bp_current_user_can( 'bp_moderate' ) ) : ?>
    <div class="form-group">

        <div class="checkbox">

            <label for="send-notice">

                <input type="checkbox" id="send-notice" name="send-notice" value="1" /> <?php _e( "This is a notice to all users.", "buddypress" ); ?>

            </label>

        </div>

    </div>
	<?php endif; ?>

    <div class="form-group">

        <label for="subject"><?php _e( 'Subject', 'buddypress' ); ?></label>
        <input type="text" name="subject" id="subject" value="<?php bp_messages_subject_value(); ?>" />

    </div>

    <div class="form-group">


        <label for="content"><?php _e( 'Message', 'buddypress' ); ?></label>
        <textarea name="content" id="message_content" rows="15" cols="40"><?php bp_messages_content_value(); ?></textarea>

    </div>

	<input type="hidden" name="send_to_usernames" id="send-to-usernames" value="<?php bp_message_get_recipient_usernames(); ?>" class="<?php bp_message_get_recipient_usernames(); ?>" />

	<?php do_action( 'bp_after_messages_compose_content' ); ?>

    <div class="form-group">

        <div class="submit">
            <input type="submit" value="<?php esc_attr_e( "Send Message", 'buddypress' ); ?>" name="send" id="send" class="btn btn-primary"/>
        </div>

    </div>

	<?php wp_nonce_field( 'messages_send_message' ); ?>
</form>

<script type="text/javascript">
	document.getElementById("send-to-input").focus();
</script>


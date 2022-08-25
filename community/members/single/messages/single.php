<div id="message-thread" role="main" class="row">

    <div class="col-xs-12">

        <?php do_action( 'bp_before_message_thread_content' ); ?>

        <?php if ( bp_thread_has_messages() ) : ?>

        <div class="panel panel-info">

            <div class="panel-heading">

                <h3 id="message-subject">
                    <?php bp_the_thread_subject(); ?>
                    <a class="button btn btn-danger confirm pull-right" href="<?php bp_the_thread_delete_link(); ?>" title="<?php esc_attr_e( "Delete Conversation", "buddypress" ); ?>"><i class="fa fa-times"></i> <?php _e( 'Delete', 'buddypress' ); ?></a>
                </h3>

            </div>

            <div id="message-recipients" class="panel-body">

                    <p class="highlight">

                        <?php if ( bp_get_thread_recipients_count() <= 1 ) : ?>

                            <?php _e( 'You are alone in this conversation.', 'buddypress' ); ?>

                        <?php elseif ( 5 <= bp_get_thread_recipients_count() ) : ?>

                            <?php printf( __( 'Conversation between %s recipients.', 'buddypress' ), number_format_i18n( bp_get_thread_recipients_count() ) ); ?>

                        <?php else : ?>

                            <?php printf( __( 'Conversation between %s and you.', 'buddypress' ), bp_get_thread_recipients_list() ); ?>

                        <?php endif; ?>

                    </p>

                <?php do_action( 'bp_before_message_thread_list' ); ?>

                <?php while ( bp_thread_messages() ) : bp_thread_the_message(); ?>

                    <div class="well message-box <?php bp_the_thread_message_css_class(); ?>">

                        <div class="message-metadata">

                            <?php do_action( 'bp_before_message_meta' ); ?>

                            <?php bp_the_thread_message_sender_avatar( 'type=thumb&width=30&height=30' ); ?>

                            <?php if ( bp_get_the_thread_message_sender_link() ) : ?>

                                <strong><a href="<?php bp_the_thread_message_sender_link(); ?>" title="<?php bp_the_thread_message_sender_name(); ?>"><?php bp_the_thread_message_sender_name(); ?></a></strong>

                            <?php else : ?>

                                <strong><?php bp_the_thread_message_sender_name(); ?></strong>

                            <?php endif; ?>

                            <span class="activity pull-right"><?php bp_the_thread_message_time_since(); ?></span>

                            <?php do_action( 'bp_after_message_meta' ); ?>

                        </div><!-- .message-metadata -->

                        <?php do_action( 'bp_before_message_content' ); ?>

                        <p class="message-content">

                            <?php bp_the_thread_message_content(); ?>

                        </p><!-- .message-content -->

                        <?php do_action( 'bp_after_message_content' ); ?>

                        <div class="clear"></div>

                    </div><!-- .message-box -->

                <?php endwhile; ?>

                <?php do_action( 'bp_after_message_thread_list' ); ?>

            </div>

            <div class="panel-footer">

                <?php do_action( 'bp_before_message_thread_reply' ); ?>

                <form id="send-reply" action="<?php bp_messages_form_action(); ?>" method="post" class="standard-form">

                    <div class="message-box">

                        <div class="message-metadata">

                            <?php do_action( 'bp_before_message_meta' ); ?>

                            <div class="avatar-box form-group">
                                <?php bp_loggedin_user_avatar( 'type=thumb&height=30&width=30' ); ?>

                                <strong><?php _e( 'Send a Reply', 'buddypress' ); ?></strong>
                            </div>

                            <?php do_action( 'bp_after_message_meta' ); ?>

                        </div><!-- .message-metadata -->

                        <div class="message-content">

                            <div class="form-group">

                                <?php do_action( 'bp_before_message_reply_box' ); ?>

                                <textarea name="content" id="message_content" rows="15" cols="40" class="form-control"></textarea>

                                <?php do_action( 'bp_after_message_reply_box' ); ?>

                            </div>



                            <div class="form-group">

                                <div class="submit">
                                    <input type="submit" name="send" value="<?php esc_attr_e( 'Send Reply', 'buddypress' ); ?>" id="send_reply_button" class="btn btn-primary"/>
                                </div>

                            </div>

                            <input type="hidden" id="thread_id" name="thread_id" value="<?php bp_the_thread_id(); ?>" />
                            <input type="hidden" id="messages_order" name="messages_order" value="<?php bp_thread_messages_order(); ?>" />
                            <?php wp_nonce_field( 'messages_send_message', 'send_message_nonce' ); ?>

                        </div><!-- .message-content -->

                    </div><!-- .message-box -->

                </form><!-- #send-reply -->

                <?php do_action( 'bp_after_message_thread_reply' ); ?>

            </div>

        </div>

        <?php endif; ?>

        <?php do_action( 'bp_after_message_thread_content' ); ?>

    </div>



</div>
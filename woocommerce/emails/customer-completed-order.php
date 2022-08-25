<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

    <p><?php printf( __( "Hi there. Your recent order on %s has been completed. Your order details are shown below for your reference:", 'woocommerce' ), get_option( 'blogname' ) ); ?></p>

<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" id="promotion_section">
    <tr>
        <td align="center" valign="top">
            <!-- Header -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="promotion_info">
                <tr>
                    <td align="center" style="padding-left: 25px">
                        <h3 style="text-align: center">
                            <a href="http://jewelersmutual.com/Personal-Jewelry-Insurance">Is Your Ring Safe?</a>
                        </h3>
                        <p>We've got your proposal. You've got the ring. Now all that's left is making sure it's protected. Insure your ring with Jewelers Mutual. There world-wide coverage protects your ring against loss, theft, damage, and even mysterious disappearance. Get your quote today</p>
                        <a href="http://jewelersmutual.com/Personal-Jewelry-Insurance">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/emails/jewelers-mutual.jpg" />
                        </a>
                    </td>
                </tr>
            </table>
            <!-- End Header -->
        </td>
    </tr>
</table>

<?php

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );

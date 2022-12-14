<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>

<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert-info woocommerce-info">
        <p class="clearfix"><?php echo wp_kses_post( $message ); ?></p>
    </div>
<?php endforeach; ?>

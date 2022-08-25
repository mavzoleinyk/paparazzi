<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

$parent_product_post = $post;

?>

<?php if(is_woocommerce_subscription($grouped_products[0])): ?>
    <div class="row">
    <?php
    foreach ( $grouped_products as $product_id ):
        $product = wc_get_product( $product_id );
        $post    = $product->post;
        setup_postdata( $post );
        $title = get_the_title();
        $panel_class = 'primary';
        if(strpos($title, 'Platinum') !== false)
        {
            $panel_class = 'warning';
        }
        elseif(strpos($title, 'Ambassador') !== false)
        {
            $panel_class = 'success';
        }

        $buttonLabel = 'from &pound;' .$product->subscription_price . ' per ' .$product->subscription_period;
        ?>
        <div class="col-xs-12 col-sm-4">

            <div class="panel panel-<?php echo $panel_class; ?> text-center">

                <div class="panel-heading">

                    <h2><?php echo $product->is_visible() ? '<a href="' . get_permalink() . '">' . $title . '</a>' : $title; ?></h2>

                </div>

                <div class="panel-body">

                    <?php the_content(); ?>

                </div>

                <div class="panel-footer">

                    <?php
                    if(isset($_REQUEST['switch-subscription']))
                    {
                        $query_addon = '?switch-subscription=' . $_REQUEST['switch-subscription'];
                    }
                    ?>

                    <a class="btn btn-lg btn-<?php echo $panel_class; ?> btn-block" href="<?php the_permalink(); ?><?php echo $query_addon; ?>" title="<?php the_title(); ?>"><?php echo $buttonLabel; ?></a>

                </div>

            </div>

        </div>
    <?php endforeach; ?>

    </div>

    <?php
    // Reset to parent grouped product
    $post    = $parent_product_post;
    $product = wc_get_product( $parent_product_post->ID );
    setup_postdata( $parent_product_post );
    ?>

<?php else: ?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="group_table">
		<tbody>
			<?php
				foreach ( $grouped_products as $product_id ) :
					$product = wc_get_product( $product_id );
					$post    = $product->post;
					setup_postdata( $post );
					?>
					<tr>
						<td>
							<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
								<?php woocommerce_template_loop_add_to_cart(); ?>
							<?php else : ?>
								<?php
									$quantites_required = true;
									woocommerce_quantity_input( array( 'input_name' => 'quantity[' . $product_id . ']', 'input_value' => '0' ) );
								?>
							<?php endif; ?>
						</td>

						<td class="label">
							<label for="product-<?php echo $product_id; ?>">
								<?php echo $product->is_visible() ? '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' : get_the_title(); ?>
							</label>
						</td>

						<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

						<td class="price">
							<?php
								echo $product->get_price_html();

								if ( $availability = $product->get_availability() ) {
									$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
									echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
								}
							?>
						</td>
					</tr>
					<?php
				endforeach;

				// Reset to parent grouped product
				$post    = $parent_product_post;
				$product = wc_get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );


			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>

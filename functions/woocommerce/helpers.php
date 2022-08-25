<?php

/**
 * Check if a product is a subscription
 * @param $productID
 */
function is_woocommerce_subscription($productID)
{

    $product = wc_get_product( $productID );
    if($product->is_type('subscription'))
    {
        return true;
    }
    return false;

}

function merchandise()
{
    global $post, $woocommerce;

    $html = '';

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'global',
            ),
        )
    );

    $merchandise = new WP_Query($args);

    if($merchandise->have_posts())
    {
        $html .= '<div class="row">';

        $html .= '<div class="col-xs-12">';

        $html .= '<h2>Add some of our popular extras</h2>';

        $html .= '</div>';

        $html .= '</div>';

        $html .= '<div class="row" data-equal="height">';

        while($merchandise->have_posts())
        {

            $merchandise->the_post();

            $product = new WC_Product( $post->ID );

            if(!product_already_in_cart($product))
            {
                $data = array(
                    'title' => $post->post_title,
                    'link' => get_permalink(),
                    'price' => $product->get_price_html(),
                    'product' => $product
                );

                if(has_post_thumbnail())
                {
                    $imageID = get_post_thumbnail_id();

                    $image = getmediaSizeurl($imageID, 'medium');

                    $data['image'] = $image;

                }

                $html .= compile_template('merchandise', $data);
            }

        }

        $html .= '</div>';
        $html .= '<h2 class="margin-top-reg">' . __('My Proposal so far', 'Paparazzi') . '</h2>';

        wp_reset_postdata();
    }

    if(!empty($html))
    {
        echo $html;
    }

}

function get_the_packages($category = 'core', $term = false, $slide = '')
{
    global $post;

    $packageHTML = '';

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        )

    );


    if($term)
    {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 10,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $category,
                ),
                array(
                    'taxonomy' => 'location',
                    'field'    => 'slug',
                    'terms'    => $term->slug,
                ),
            )

        );
    }

    $packages = new WP_Query($args);

    if($packages->have_posts())
    {
        while($packages->have_posts())
        {
            $packages->the_post();

            $product = new WC_Product( $post->ID );

            $data = array(
                'title' => $post->post_title,
                'desc' => $post->post_excerpt,
                'link' => get_permalink($post->ID),
                'price' => $product->get_price_html(),
                'category' => $category
            );

	        if(!empty($slide))
	        {
		        $data['slide'] = ' data-slide';
	        }

            if(has_post_thumbnail())
            {
                $imageID = get_post_thumbnail_id();

                $image = getmediaSizeurl($imageID, 'xs-max-wide');

                $data['image'] = $image;

            }

            $packageHTML .= compile_template('modules/packages/package-nugget', $data);
        }

        wp_reset_postdata();
    }

    return $packageHTML;

}

function get_the_module_packages($term = false, $slide = '')
{
    global $post;

    $packageHTML = '';

    $taxQuery = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => array('core', 'popular')
            )
        );

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'meta_key' => '_price',
        'orderby' => 'meta_value_num meta_value',
        'order' => 'ASC',
        'tax_query' => $taxQuery
    );

    if($term)
    {
        $taxQuery = array(
                'relation' => 'OR',
                array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => array('popular'),
                    ),
                    array(
                        'taxonomy' => 'location',
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    )
                ),
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => array('core')
                )
            );

        $args['tax_query'] = $taxQuery;
    }

    $packages = new WP_Query($args);

    if($packages->have_posts())
    {
        while($packages->have_posts())
        {
            $packages->the_post();

            $product = new WC_Product( $post->ID );

            $data = array(
                'title' => $post->post_title,
                'desc' => $post->post_excerpt,
                'link' => get_permalink($post->ID),
                'price' => $product->get_price_html(),
                'category' => $category
            );

	        if(!empty($slide))
	        {
		        $data['slide'] = ' data-slide';
	        }

            if(has_post_thumbnail())
            {
                $imageID = get_post_thumbnail_id();

                $image = getmediaSizeurl($imageID, 'xs-max-wide');

                $data['image'] = $image;

            }

            $packageHTML .= compile_template('modules/packages/package-nugget', $data);
        }

        wp_reset_postdata();
    }

    return $packageHTML;

}

function show_cart_button($product){

    global $woocommerce;

    $packages = array('popular', 'core');
    $isPackage = false;

    if(has_term($packages, 'product_cat', $product->id))
    {
        $isPackage = true;
    }

    foreach($woocommerce->cart->get_cart() as $cart_item_key => $values )
    {
        $cartProduct = $values['data'];

        if( $product->id == $cartProduct->id )
        {
            return array(
                'validation' => 'same_package',
                'product' => $cartProduct
            );
        }

        if($isPackage && has_term($packages, 'product_cat', $cartProduct->id))
        {
            return array(
                'validation' => 'other_package',
                'product' => $cartProduct
            );
        }

    }

    return true;
}

/**
 * Check of a product is in the cart already
 * @param $product
 * @return bool
 */
function product_already_in_cart($product)
{
    global $woocommerce;

    foreach($woocommerce->cart->get_cart() as $cart_item_key => $values )
    {
        $cartProduct = $values['data'];

        if( $product->id == $cartProduct->id )
        {
            return true;
        }

    }
}

/**
 * Change Proceed To Checkout Text in WooCommerce
 * Place this in your Functions.php file
 **/

function woocommerce_button_proceed_to_checkout() {
    $checkout_url = WC()->cart->get_checkout_url();
    ?>
    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#call-me-back-modal"><?php _e( 'Call me back', 'Paparazzi' ); ?></a>
    <a href="<?php echo $checkout_url; ?>" class="btn btn-primary checkout-button btn-margin-left button alt wc-forward"><?php _e( 'Book Now', 'woocommerce' ); ?></a>

<?php
}

/**
 * Display the product location
 * @param $productID
 */
function the_location($productID, $tag = 'h3', $link = false)
{
    $html = '';

    if($locations = wp_get_post_terms( $productID, 'location'))
    {
        if($link)
        {
            $permalink = get_term_link($locations[0]);
        }

        if(!empty($permalink))
        {
            $html .= '<a href="' . $permalink .'">';
        }

        $html .= '<' . $tag .'>' . $locations[0]->name . '</' . $tag .'>';

        if(!empty($permalink))
        {
            $html .= '</a>';
        }
    }

    echo $html;

}

/**
 * @param $productID
 * @return bool
 */
function is_other_location_product_in_cart() {

	global $woocommerce;

    foreach ($woocommerce->cart->cart_contents as $cart_key => $cart_item) {

        if(isset($cart_item['variation']['attribute_pa_location']) && $cart_item['variation']['attribute_pa_location'] == 'other')
        {
            return true;
        }

    }

	return false;

}
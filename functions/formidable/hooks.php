<?php
add_filter('frm_setup_new_fields_vars', 'frm_add_cart_content', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_add_cart_content', 20, 2); //use this function on edit too
function frm_add_cart_content($values, $field){

    if($field->field_key == 'myproposal') {

        global $woocommerce;

        $cart_contents = '';

        if($woocommerce->cart->cart_contents_count > 0)
        {
            $count = 0;
            foreach ($woocommerce->cart->cart_contents as $cart_key => $cart_item) {

                //var_dump($cart_item['data']->post);

                $separator = ' | ';

                if($count === 0) {

                    $separator = '';

                }

                $cart_contents .= $separator . $cart_item['data']->post->post_title . ' (ID ' . $cart_item['data']->post->ID . ')';

                if($locations = get_the_terms( $cart_item['data']->post->ID, 'location' ))
                {
                    $cart_contents .= ' in ' . $locations[0]->name;
                }
                $count++;

            }

            $values['value'] = $cart_contents;
            $values['default_value'] = $cart_contents;
            //var_dump($values);
        }
    }

    return $values;

}


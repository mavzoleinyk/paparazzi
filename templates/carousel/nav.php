<nav id="proposal-nav" class="navbar navbar-default navbar-footer" role="navigation">

    <div class="container-fluid">

        <div class="row">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header veil-hidden col-xs-3 col-sm-2 col-md-2 col-lg-2">
                <div class="navbar-brand navbar-brand-no-scale">
                    <?php echo get_formatted_site_title(get_template_directory_uri() . '/assets/img/pp-logo-small.png'); ?>
                </div>
            </div>

            <div class="col-md-5 hidden-sm hidden-xs text-uppercase text-left">

                <dl>

                    <?php $data = array(); ?>

                    <?php if(!empty($location)): $data['location']['link'] = $location['link']; $data['location']['title'] = $location['title'];?>

                        <dt>Location:</dt>

                        <dd><a href="<?php echo $location['link']; ?>" title="View details of Proposals in <?php echo $location['title']; ?>"><?php echo $location['title']; ?></a></dd>

                    <?php endif; ?>

                    <?php if(!empty($package)): $data['package']['link'] = $package['link']; $data['package']['title'] = $package['title']; ?>

                        <?php $product = wc_get_product( $package['id'] ); ?>

                        <dt>Package:</dt>

                        <dd><a href="<?php echo $package['link']; ?>" title="View the <?php echo $package['title']; ?> package"><?php echo $package['title']; ?></a></dd>

                    <?php endif; ?>

                    <?php $extras = false; if(is_array($extras)): ?>

                        <dt>Extras:</dt>

                        <?php foreach($extras as $extra): ?>

                            <dd><a href="<?php echo $extra['link']; ?>" title="View the <?php echo $extra['title']; ?> proposal extra"><?php echo $extra['title']; ?></a></dd>

                        <?php endforeach; ?>

                    <?php endif; ?>



                </dl>

            </div>

            <div class="col-xs-3 col-sm-1 hidden-md hidden-lg">

                <?php if(count($data) > 0): ?>

                <a class="btn btn-link lead pull-left" href="#" data-toggle="popover" data-placement="top" data-title="Information" data-content="<?php render_template('carousel/info-popover',  $data); ?>"><i class="fa fa-info-circle"></i></a>

                <?php endif; ?>

            </div>

            <div class="col-xs-6 col-sm-9 col-md-5 col-lg-5 veil-xs-9 veil-sm-11 veil-md-7 veil-lg-7">

                <div class="pull-right">

                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="pull-left hidden-xs hidden-sm addthis_sharing_toolbox" data-url="<?php echo get_permalink(); ?>"></div>

                    <?php if(is_proposer()): ?>

                        <?php if(!empty($proposerLink)): ?>

                            <a href="<?php echo $proposerLink; ?>" type="button" class="btn btn-inline-xs btn-primary navbar-btn"><i class="fa fa-download"></i><?php echo $proposerLinkText; ?></a>

                        <?php endif; ?>

                    <?php else: ?>

                        <button type="button" class="btn btn-inline-xs btn-default navbar-btn" data-toggle="modal" data-target="#call-me-back-modal">Callback</button>

                        <?php if(!empty($product) && show_cart_button($product)): ?>

                            <?php

                            global $woocommerce;
                            $cartPageUrl = $woocommerce->cart->get_cart_url();

                            $variations = '';

                            if($product->is_type('variable') && !empty($location))
                            {
                                $availableVariations = $product->get_available_variations();

                                if ( ! empty( $availableVariations ) ){
                                    $variationID = $availableVariations[0]['variation_id'];
                                    $variations = '&product_id=' . $product->id . '&variation_id=' . $variationID . '&attribute_pa_location=' . apply_filters( 'woocommerce_variation_option_name', $location['slug']);
                                }
                            }

                            ?>

                            <?php $showButton = show_cart_button($product); ?>

                            <?php if(is_array($showButton)): ?>

                                <a href="<?php echo $cartPageUrl; ?>" class="btn btn-inline-xs btn-primary navbar-btn hidden-xs">My Proposal</a>

                            <?php elseif($showButton): ?>

                                <a href="<?php echo $cartPageUrl; ?>?add-to-cart=<?php echo $product->id; ?><?php echo $variations; ?>" class="btn btn-inline-xs btn-primary navbar-btn">Book this</a>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</nav>
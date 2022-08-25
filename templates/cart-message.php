<?php

global $woocommerce;
$cartPageUrl = $woocommerce->cart->get_cart_url();
$col = 8;
$extraAlertClass = ' alert-info ';
$showCta = true;

if($loop)
{
    $message = __('You have already added a package', 'Paparazzi');
    $col = 12;
    $extraAlertClass = ' alert-btn-lg alert-info alert-table alert-block ';
    $showCta = false;
}
elseif($extra)
{
    // $message = __('Added', 'Paparazzi');
    $message = __('<span class="text-primary">Has been added to your proposal</span>', 'Paparazzi');
    $col = 12;
    // $extraAlertClass = ' alert-btn-lg alert-success alert-table alert-block ';
    $extraAlertClass = 'text-primary';
    $showCta = false;
}
elseif($validation == 'same_package')
{
    $message = __('This package is already added to your proposal', 'Paparazzi');
    $action = 'View';
}
elseif($validation == 'other_package')
{
    $message = __('You can only have one package in your proposal. The package <strong>' . $product->get_title() . '</strong> is already added to your proposal.', 'Paparazzi');
    $action = 'Manage';
}
?>

<div class="alert<?php echo $extraAlertClass; ?>clearfix">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-<?php echo $col; ?>">

                <p class="small"><i class="fa fa-info"></i> <?php echo $message; ?></p>

            </div>

            <?php if($showCta): ?>

            <div class="col-sm-4">

                <a href="<?php echo $cartPageUrl; ?>" class="btn btn-primary btn-sm pull-right"><?php echo $action; ?> Your Proposal</a>

            </div>

            <?php endif; ?>

        </div>

    </div>

</div>
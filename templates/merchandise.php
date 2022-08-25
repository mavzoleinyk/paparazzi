<div class="col-xxs-12 col-xs-6 col-sm-4">

    <div class="panel panel-thumbnail text-center">

        <?php if(!empty($image)): ?>

        <div class="panel-heading">

            <a href="<?php echo $link; ?>">

                <img src="<?php echo $image; ?>" />

            </a>

        </div>

        <?php endif; ?>

        <div class="panel-body">

            <h4 data-compare><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h4>
            <p><span><?php echo $price; ?></span></p>

        </div>

        <div class="panel-footer" data-action="merchandise">

            <?php woocommerce_template_loop_add_to_cart(); ?>

        </div>


    </div>




</div>

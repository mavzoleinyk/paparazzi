<div class="col-xs-12 col-md-4" <?php echo $slide; ?>>
    <div class="panel panel-thumbnail panel-lightest-grey" data-compare>

	    <div class="panel-heading">

		    <?php if(!empty($image)): ?>

			    <img src="<?php echo $image; ?>" />

		    <?php endif; ?>

	    </div>

        <div class="panel-body text-center panel-body-fixed-button">

            <div class="caption">
                <h3><?php echo $title; ?></h3>
                <p><?php echo $desc; ?></p>
                <p><span><?php echo $price; ?></span></p>

            </div>

            <div class="fixed-button">
            
                <button class="btn btn-info" package-name="<?php echo $title; ?>" data-target="packages" data-content="<?php echo $link; ?>">View Package Details</button>
            
            </div>

        </div>
    </div>

</div>
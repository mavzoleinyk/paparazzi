<a href="<?php echo $link; ?>" class="display-block col-sm-6 hidden-xs">
    <div class="overlay-nugget overlay-xs-normalise relative margin-bottom-sm" data-compare>

        <?php if(!empty($image)): ?>

           <div class="image-overlay-wrapper">

	           <img src="<?php echo $image; ?>" class="img-responsive hidden-xs"/>

           </div>

        <?php endif; ?>


        <div class="absolute display-table">

            <div class="display-table-cell">

	            <h4><?php echo $title; ?></h4>

            </div>

        </div>

    </div>
</a>
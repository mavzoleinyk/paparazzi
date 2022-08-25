<div id="locations" data-section="locations" class="margin-top-reg margin-bottom-negative-reg text-center">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-8 col-sm-offset-2">

	            <?php render_template('modules/module-heading', array('icon' => $icon, 'title' => $title)); ?>

            </div>

        </div>

    </div>

	<div id="map-locations" class="map-canvas <?php echo $height; ?>" map-lon="<?php echo $lon ?>" map-lat="<?php echo $lat ?>" map-zoom="<?php echo $zoom ?>" data-pins='<?php echo $pins ?>'>
    </div>

</div>
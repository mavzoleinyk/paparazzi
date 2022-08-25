<div id="<?php echo $id; ?>" data-section="<?php echo $id; ?>" class="margin-top-reg margin-bottom-negative-reg next-prev-full-bars text-center">


	<div class="bg-primary"><div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                    <?php render_template('modules/module-heading', array('icon' => $icon, 'title' => $title)); ?>

                </div>

            </div>

        </div>

	</div>

    <div class="frame bg-primary" data-frame="proposals" data-extender="viewport">


        <div data-slider="proposals" class="bg-primary">

            <?php

            $args = array(
                'limit' => 8,
                'featured' => true,
                'slide' => true,
                'wrapper' => false,
                'veil' => true
            );

            if($term)
            {
                $args['term'] = $term;
                $args['limit'] = -1;
                $args['throttle'] = 6;
            }

            the_proposals($args);

            ?>

        </div>

    </div>

</div>

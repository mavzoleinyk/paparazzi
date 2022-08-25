<div id="<?php echo $id; ?>" data-section="<?php echo $id; ?>" class="margin-top-reg packages">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                <?php render_template('modules/module-heading', array('icon' => $icon, 'title' => $title)); ?>

            </div>

        </div>

    </div>

    <?php $popularHTML = get_the_module_packages($term, true); ?>

    <?php if(!empty($popularHTML)): ?>

    <div data-show-group>

        <div class="bg-info">

            <div class="container">

                <div data-section="popular">

                    <h4 class="lead text-center margin-top-reg">Our most popular <?php locations_title(); ?> packages</h4>

                    <div data-slider="packages" data-frame="packages" data-extender="self" class="frame row margin-top-reg" data-equal="height">

                        <?php echo $popularHTML; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php endif; ?>

</div>

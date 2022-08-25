<div id="<?php echo $id; ?>" data-section="<?php echo $id; ?>" class="container margin-top-reg text-center">

    <?php render_template('modules/module-heading', array('icon' => $icon, 'title' => $title)); ?>

    <div class="row">

        <?php foreach ($steps as $step): ?>
            <div class="col-xs-12 col-sm-4 margin-bottom-xs">
                <?php if($step['title']) render_template('modules/steps/steps-nugget', $step); ?>
            </div>
        <?php endforeach; ?>

    </div>

</div>
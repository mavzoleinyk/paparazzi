<div class="col-xs-12 col-sm-6">

    <a href="<?php echo $link; ?>" class="display-block">

        <?php if(!empty($image)): ?>

            <img src="<?php echo $image; ?>" class="img-responsive"/>

        <?php endif; ?>

        <h3 class="margin-top-sm"><?php echo $title; ?></h3>

    </a>

    <?php if(!empty($excerpt)): ?>

        <p><?php echo $excerpt; ?></p>

    <?php endif; ?>

    <a href="<?php echo $link; ?>" title="<?php echo $title; ?>" class="btn btn-info">Read more</a>

</div>
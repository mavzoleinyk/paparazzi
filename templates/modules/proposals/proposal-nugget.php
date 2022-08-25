<?php if($wrapper): ?>

<<?php echo $tag; ?> class="col-xxs-12 col-xs-6 col-sm-6 col-md-4"<?php echo $href; ?>>

<?php elseif(!$veil): ?>

<<?php echo $tag; ?><?php echo $href; ?>>

<?php endif; ?>

    <div class="panel panel-thumbnail-overlay bg-primary"<?php echo $attributes; ?><?php echo $slide; ?>>

        <div class="panel-heading">

            <?php if(!empty($image)): ?>
                <span class="text-uppercase">View this proposal</span>
                <img class="img-circle" src="<?php echo $image; ?>" />
            <?php endif; ?>

        </div>

        <div class="panel-body text-center" data-compare>
            <?php if(!empty($title)): ?>
                <h3><?php echo $title; ?></h3>
            <?php endif ?>

            <p class="text-muted text-uppercase small">
                <?php echo ((!empty($tag_package)) ? $tag_package : ''); ?>
                <?php echo ((!empty($tag_package) && !empty($tag_package))? 'in' : '')?>
                <?php echo ((!empty($tag_location)) ? $tag_location : ''); ?>
            </p>
        </div>

    </div>

<?php if($wrapper || !$veil): ?>

</<?php echo $tag; ?>>

<?php endif; ?>
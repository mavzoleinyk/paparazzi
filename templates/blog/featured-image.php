
<div class="margin-bottom-sm">

    <?php global $hhthumb;  if($hhthumb->the_meta() && $image = get_image($hhthumb, 'xs-max')): ?>

        <?php echo '<img src="' . $image . '" />'; ?>

    <?php elseif(has_post_thumbnail()): ?>

        <?php the_post_thumbnail('xs-max'); ?>

    <?php endif; ?>

</div>

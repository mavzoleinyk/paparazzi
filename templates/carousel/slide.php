<?php
$activeClass = '';
if($id < 1)
{
    $activeClass = ' active';
}
?>
<div class="item item-<?php echo $id; ?><?php echo $activeClass; ?>">
    <div class="jumbotron jumbotron-viewport jumbotron-single jumbotron-xs-<?php echo $bgAlign; ?>" style="background-image: url('<?php echo $image; ?>')">
        <div class="hentry carousel-caption carousel-position carousel-position-<?php echo $position; ?>">
        <?php if($id < 1): ?>
            <h1><?php echo $content; ?></h1>
        <?php else: ?>
            <?php echo $content; ?>
        <?php endif; ?>
        </div>
    </div>
</div>
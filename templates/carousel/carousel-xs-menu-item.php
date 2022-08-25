<?php
$activeClass = '';
if($id < 1)
{
    $activeClass = ' active';
}
?>
<li data-target="#single-proposal-carousel" data-slide-to="<?php echo $id; ?>" class="<?php echo $activeClass; ?>"></li>
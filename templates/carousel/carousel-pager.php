<?php

$smMenuItems = '';
$xsMenuItems = '';

foreach($menuItems as $key => $menuItem)
{
    $menuItem['itemClass'] = '';
    $menuItem['roundClass'] = '';

    if($key == 0)
    {
        $menuItem['itemClass'] = 'active';
        $menuItem['roundClass'] = 'img-circle';
    }
    $smMenuItems .= compile_template('carousel/carousel-menu-item', $menuItem);
    //$xsMenuItems .= compile_template('carousel/carousel-xs-menu-item', $menuItem);
}

?>

<div class="carousel-menu">

    <div class="carousel-menu-inner">

        <nav class="image-selector" data-role="active-states">

            <ul>

                <?php

                echo $smMenuItems;

                ?>
            </ul>

        </nav>

    </div>

    <div class="carousel-menu-inner">

        <ul>
            <?php the_gallery(); ?>
        </ul>

    </div>

</div>


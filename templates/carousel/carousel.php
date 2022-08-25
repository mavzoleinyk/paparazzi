<div id="single-proposal-carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="30000">

    <?php render_template('carousel/carousel-pager', array('menuItems' => $menuItems)); ?>


    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        <?php

        foreach($slides as $key => $slide)
        {
            $data = array(
                'id' => $slide['id'],
                'content' => $slide['content'],
                'image' => $slide['image'],
                'position' => $slide['position'],
                'bgAlign' => $slide['bgAlign']
            );

            render_template('carousel/slide',$data);
        }

        ?>

    </div>

    <?php

    $data = array();

    if(is_array($location))
    {
        $data['location'] = $location;
    }

    if(is_array($package))
    {
        $data['package'] = $package;
    }

    if(is_array($extras))
    {
        $data['extras'] = $extras;
    }

    render_template('carousel/nav', $data);

    ?>

</div>
<aside class="widget">

    <div class="bg-primary">

        <div class="text-center module-heading">

            <h4><i class="fa fa-heart"></i></h4>

            <p class="text-uppercase">Congratulations!</p>

        </div>

    </div>
    <?php

    $args = array(
        'limit' => 1,
        'wrapper' => false,
        'before_title'  => '<p class="widget__title">',
        'after_title'   => '</p>\n',
    );

    the_proposals($args);

    ?>

</aside>
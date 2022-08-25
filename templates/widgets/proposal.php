<aside class="widget">

    <div class="bg-primary">

        <div class="text-center module-heading">

            <h4><i class="fa fa-heart"></i></h4>

            <h3 class="text-uppercase">Congratulations!</h3>

        </div>

    </div>
    <?php

    $args = array(
        'limit' => 1,
        'wrapper' => false
    );

    the_proposals($args);

    ?>

</aside>
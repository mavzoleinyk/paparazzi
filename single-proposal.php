<?php include('header.php'); ?>

    <div id="single-proposal" data-framed>

        <?php if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false): ?>

            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="veil-hidden btn-back btn-carousel" title="Go back"><i class="fa fa-arrow-circle-o-left"></i></a>
        <?php endif; ?>

    <?php

    if(have_posts())
    {
        while(have_posts())
        {
            the_post();
            the_proposal();
        }

    }

    ?>

    </div>

<?php include('footer.php'); ?>
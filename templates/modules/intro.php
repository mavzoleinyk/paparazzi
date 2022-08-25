<div id="<?php echo $id; ?>" data-section="<?php echo $id; ?>" class="container">

    <div class="row margin-top-reg">

        <div class="col-xs-12 text-center">

        <?php if(!empty($image)): ?>
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-responsive img-lead"/>
        <?php endif; ?>

            <div class="row">

                <div class="col-xxs-12 col-xxs-offset-clear col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">

                <?php if(!empty($title)): ?>
                    <<?php echo $tag; ?>><?php echo $title; ?></<?php echo $tag; ?>>
                <?php endif; ?>

                <?php if(!empty($introText)): ?>
                    <h3 class="lead weight-light"><?php echo $introText; ?></h3>
                <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

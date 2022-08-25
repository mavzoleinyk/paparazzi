<div id="<?php echo $id; ?>" data-section="<?php echo $id; ?>" class="container">

    <div class="row margin-top-reg">

        <div class="col-md-12 col-lg-10 col-lg-offset-1 text-center text-uppercase text-info">

            <ul class="border border-horizontal">

                <p class="hidden-sm hidden-md hidden-lg lead">

                    <i class="fa fa fa-check"></i>

                </p>

                <?php foreach($benefits as $benefit): ?>

                    <li class="display-inline inline-list inline-list-spaced display-block-xs small">

                        <span class="hidden-xs">

                            <i class="fa fa-check"></i>

                        </span>

                        <?php echo $benefit['title']; ?>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    </div>

</div>

